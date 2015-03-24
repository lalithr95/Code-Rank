<?php

class Submit extends CI_Controller
{
	// for submitted code and judging the code
	public function send($code)
	{
		if($this->session->userdata('is_loggedin'))
		{
			$this->form_validation->set_rules('lang','Lang','xss_clean|required');
			$this->form_validation->set_rules('code','code','xss_clean|required');

			$this->form_validation->set_error_delimiters('<div class="alert alert-success" style="font-size:30px;width:30%">','</div>');
			if($this->form_validation->run())
			{
				$email = $this->session->userdata('email');
				//echo $code;
				$contest_code = $this->Admin_contests->getcontestcode($code);
				$contest_code = $contest_code->code;
				$uid = $this->User_model->getuserid($email);
				$uid = $uid->id;
				$timestamp = now();
				//echo $contest_code;
				$err = 0;
				$prob_data = array
				(
					'prb_code'	=>	$code,
					'code'		=>	$contest_code,
					'uid'		=>	$uid,
					'lang'		=>	$this->input->post('lang'),
					'usercode'		=>	$this->input->post('code'),
					'timestamp'		=> 	$timestamp,
					'error'			=>  $err
				);
				// updating submissions for particular problem
				$this->Submission->setsubmission($code);
				
				if($this->Submission->insertcode($prob_data))
				{
					$usercode = $this->input->post('code');
					$this->load->view('admin/test');
				
					$this->run($code,$usercode,$timestamp);
					

				}
				else
				{
					redirect('restricted');
				}
			}
			else
			{
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		else
		{
			redirect('home');
		}
	}

	public function run($code, $usercode,$timestamp)
	{
		//used for executing and testing code in sandbox
		//step 1 : load the code from the DB into sandbox prob
		$result = $this->Submission->getsid($timestamp);
		$sid = $result->sid;
		$basepath = "/opt/lampp/htdocs/coderank/sandbox/";
		
		shell_exec("mkdir ".$basepath."code/".$sid);// creates a directory for each problem
		//shell_exec("chmod 777 ".$basepath."code/".$sid);
		$fp = fopen($basepath."code/".$sid."/".$sid.".c","w");
		if($fp)
		{
			fwrite($fp,$usercode);
			fclose($fp);
		}
		else
		{
			die("Cannot open ! Please check access permissions");
		}

		// Ends the process of creating a new file
		// step 2: Compile code
		// need to check the language and assign compiler
		$lang = $this->Submission->getlang($timestamp);
		$lang = $lang->lang;
		$lang = strtolower($lang);
		// set compiler paths
		$compiler	=	array
		(
			"c"			=>	"gcc -o ",
			"cpp"		=>	"g++ -o ",
			"java"		=>	"javac ",
			"python"	=>	"python "
		);

		switch($lang)
		{
			case 'c' :
				// run c code
				$extension = '.c';
				$output = shell_exec("chmod 555 ".$basepath."code/".$sid."/".$sid.$extension);
				// for changin file to read and execute by group , user , other
				$command = $compiler['c'];
				$command = $command.$basepath."code/".$sid."/".$sid." ";
				$command = $command.$basepath."code/".$sid."/".$sid.$extension." 2>&1";
				//$command = $command." >error.txt";
				//echo shell_exec("ls");
				//echo $command;
				$output = shell_exec($command);
				break;
			case 'c++' :
				// run c++
				$extension = '.cpp';
				$output = shell_exec("chmod 555 ".$basepath."code/".$sid."/".$sid.$extension);
				// for changin file to read and execute by group , user , other
				$command = $compiler['cpp'];
				$command = $command.$basepath."code/".$sid."/".$sid." ";
				$command = $command.$basepath."code/".$sid."/".$sid.$extension." 2>&1";


				$output = shell_exec($command);
				break;

			case 'java' :
				$extension = '.java';

				$output = shell_exec("chmod 555 ".$basepath."code/".$sid."/".$sid.$extension);
				// for changin file to read and execute by group , user , other
				$command = $compiler['java'];
				$command = $command.$basepath."code/".$sid."/program".$extension." 2>&1";
				$output = shell_exec($command);
				break;
			case 'python' :
				$extension = '.py';
				$output = shell_exec("chmod 555 ".$basepath."code/".$sid."/".$sid.$extension);
				// for changin file to read and execute by group , user , other
				$command = $compiler['python'];
				$command = $command.$basepath."code/".$sid."/".$sid.$extension." 2>&1";
				$output = shell_exec($command);
				break;
		}

		if($output)
		{

			$error = $output;
			//@ for displaying path
			$output = "<br>prog".$extension;
			$debug_path = $basepath."code/".$sid."/".$sid.$extension;
			$error = str_replace($debug_path,$output,$error);
			$error_data = array
			(
				'sid'	=>	$sid,
				'error'	=>	$error,
				'compile_error'	=> 1
			);
			// if any compile time error
			$this->load->view('submit/run',$error_data);
			// insert error into db table @$error contains error
			$err_data = array(
				'error' => $error
			);
			if($this->Submission->update_error($sid,$err_data))
			{
				// successfully updated error field in submission
				
			}
			else
			{
				die("Problem with updating error to database");
			}

		}
		else
		{
			//proceed to run the program
			// run program with test cases
			// create a folder with problem code and keep test cases in it 
			//use 2 folder input and output 
			$prb_code = $code;
			$contest_code = $this->Admin_contests->getcontestcode($prb_code);
			switch($lang)
			{
				case 'c' :
					// execution should begin with ./prog.out <input.txt 1>output.txt 2>error.txt
					// Also we need to traverse to the current directory
					$current = "cd ".$basepath."code/".$sid." ";
					$current = $current."&& ./".$sid;
					$current = $current." <".$basepath."testcases/".$contest_code."/".$prb_code."/input/1.txt 1>output 2>error";
					//echo $current;
					$exec_output = shell_exec($current);
					// works need to change the path with local variables  
					break;
				case 'c++':
				// for executing c++ program
					$current = "cd ".$basepath."code/".$sid." ";
					$current = $current."&& ./".$sid;
					$current = $current." <".$basepath."testcases/".$contest_code."/".$prb_code."/input/1.txt 1>output 2>error";
					//echo $current;
					$exec_output = shell_exec($current);
					break;
				case 'java':
					// for executing java program
					$current = "cd ".$basepath."code/".$sid." ";
					$current = $current."&& java program";
					$current = $current." <".$basepath."testcases/".$contest_code."/".$prb_code."/input/1.txt 1>output 2>error";
					//echo $current;
					$exec_output = shell_exec($current);
					break;
			}
		}

	}

	public function view($sid = NULL)
	{
		if($sid!=NULL)
		{
			$this->load->view('admin/test');
			$data = $this->Submission->getcode($sid);
			$this->load->view('admin/view',$data);

		}
		else
		{
			redirect('restricted');
		}
	}


}