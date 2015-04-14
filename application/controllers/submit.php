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
				$language = $this->input->post('lang');
				if($this->Submission->insertcode($prob_data))
				{
					$usercode = $this->input->post('code');
					$this->load->view('admin/test');
				
					$this->run($code,$usercode,$timestamp,$language);
					

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

	public function run($code, $usercode,$timestamp,$language)
	{
		//used for executing and testing code in sandbox
		//step 1 : load the code from the DB into sandbox prob
		$result = $this->Submission->getsid($timestamp);
		$sid = $result->sid;
		$basepath = "/opt/lampp/htdocs/coderank/sandbox/";
		$language = strtolower($language);
		switch($language)
		{
			case 'c':
				$ext = '.c';
				break;
			case 'c++':
				$ext = '.cpp';
				break;
			case 'java':
				$ext = '.java';
				break;
			case 'python':
				$ext = '.py';
				break;
		}
		// Switch case used to get extension while creating source file for usercode
		shell_exec("mkdir ".$basepath."code/".$sid);// creates a directory for each problem
		//shell_exec("chmod 777 ".$basepath."code/".$sid);
		if($language!='java')
		{
			$fp = fopen($basepath."code/".$sid."/".$sid.$ext,"w");
		}
		else
		{
			$fp = fopen($basepath."code/".$sid."/"."program".$ext,"w");
		}
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
			$contest_code = $contest_code->code;
			switch($lang)
			{
				case 'c' :
					// execution should begin with ./prog.out <input.txt 1>output.txt 2>error.txt
					// Also we need to traverse to the current directory
					// loop for 10 test cases
					//@testcounter is $i
					$i = 1;
					for($i=1;$i<=10;$i++)
					{
						$current = "cd ".$basepath."code/".$sid." ";
						$current = $current."&& ./".$sid;
						$current = $current." <".$basepath."testcases/".$contest_code."/".$prb_code."/input/".$i.".txt 1>".$i.".out 2>error".$i;
					
						$exec_output = shell_exec($current);
					}
					$this->evaluate($contest_code,$prb_code,$sid);
					// works need to change the path with local variables  
					break;
				case 'c++':
				// for executing c++ program
					// same as C program execution case
					$i = 1;
					for($i=1;$i<=10;$i++)
					{
						$current = "cd ".$basepath."code/".$sid." ";
						$current = $current."&& ./".$sid;
						$current = $current." <".$basepath."testcases/".$contest_code."/".$prb_code."/input/".$i.".txt 1>".$i.".out 2>error".$i;
					
						$exec_output = shell_exec($current);
					}
					$this->evaluate($contest_code,$prb_code,$sid);
					break;
				case 'java':
					// for executing java program
					$i =1;
					for($i=1;$i<=10;$i++)
					{
						$current = "cd ".$basepath."code/".$sid." ";
						$current = $current."&& java program";
						$current = $current." <".$basepath."testcases/".$contest_code."/".$prb_code."/input/".$i.".txt 1>".$i.".out 2>error".$i;
						$exec_output = shell_exec($current);
					}
					$this->evaluate($contest_code,$prb_code,$sid);
					break;
			}
		}

	}

	// function for evalutation
	public function evaluate($contest_code,$prb_code,$sid)
	{
		$code_result = array
		(
			
		);
		$output = "";
		$code_out = "";
		$testcase_out = "";
		// get the details of problem
		for($i=1;$i<=10;$i++)
		{
			$basepath = "/opt/lampp/htdocs/coderank/sandbox/";
			$code_path = $basepath."code/".$sid."/error".$i;
			$fp = fopen($code_path,"r");
			if($fp)
			{
				// file descriptor had a success
				fwrite($fp, $output);
			}
			else
			{
				die("Unable to open Files! Please check permissions");
			}
			if($output)
			{
				// Run time error
				// upon further developement each of array should contain time executed
				$case = "case";
				$case = $case.$i;
				$code_result['result_table'][$i-1] = array
				(
					'result' => 'RTE',
					'score'	=> 0,
					'error' => 1
				);


			}
			else
			{
				// if executed properly ...checking outputs
				$code_path = $basepath."code/".$sid."/".$i.".out";
				$code_fp = fopen($code_path,"r");
				fwrite($code_fp,$code_out);
				// For getting actual output
				$case_path = $basepath."testcases/".$contest_code."/".$prb_code."/output/";
				$case_path = $case_path.$i.".out";
				$testcase_fp = fopen($case_path,"r");
				fwrite($testcase_fp,$testcase_out);
				// perform a match operation
				if(strcmp($code_out,$testcase_out) == 0)
				{
					$case = "case";
					$case = $case.$i;
					$code_result['result_table'][$i-1] = array
					(
						'result' => 'AC',
						'score'	=> 10,
						'error' => 0
					);
				}
				else
				{
					// wrong answer
					$case = "case";
					$case = $case.$i;
					$code_result['result_table'][$i-1] = array
					(
						'result' => 'WA',
						'score'	=> 0,
						'error' => 0
					);
				}
			}
		}

		$this->load->view('submit/results_table',$code_result);
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