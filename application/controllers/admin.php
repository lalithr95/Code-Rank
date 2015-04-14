<?php if(! defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends CI_Controller
{
	public $contestid;
	public function index()
	{
		if(!$this->session->userdata('admin_loggedin'))
		{
			//when admin is not loggedin
			$this->load->view('admin/index');

		}
		else
		{
			$this->contests();
			//$this->load->view('admin/test');
			//$this->load->view('admin/test_body');
		}
		
	}

	public function login()
	{
		$this->form_validation->set_rules('email','Email','required|trim|valid_email|callback_is_email');
		$this->form_validation->set_rules('password','Password','required|trim|md5|min_length[4]');
		$this->form_validation->set_error_delimiters('<div class="alert alert-success" style="font-size:15px">', '</div>');
		if($this->form_validation->run())
		{


			$admindata = array
			(
				'email' => $this->input->post('email'),
				'admin_loggedin' => 1
			);
			$this->session->set_userdata($admindata);
			// for success login we set session data and redirect to admin interface
			
			redirect('admin/contests');

		}
		else
		{
			$this->index();

			// for invalid email and password
		}
	}

	public function is_email()
	{
		if($this->Admin_model->is_admin_email())
		{
			return TRUE;
		}
		else
		{
			// if email is not admin email and password for invalid details
			$this->form_validation->set_message('is_email','Invalid Login details');
			return FALSE;
		}
	}

	public function logout()
	{
		if($this->session->userdata('admin_loggedin'))
		{
			$this->session->sess_destroy();
			redirect('admin');
		}
		else
		{
			redirect('admin');
		}
	}
	public function contests()
	{
		if($this->session->userdata('admin_loggedin'))
		{
			$this->load->view('admin/test');
			//$this->load->view('admin/test_body');
			// for now contest is home page so loading admin contests

			$config['base_url'] = base_url()."index.php/admin/contests";
			$config['per_page'] = 5;
			$config['total_rows'] = $this->Admin_contests->getcontestcount();
			//echo $config['total_rows'];
			$config['num_links'] = 5;
			$config['full_tag_open'] = '<nav><ul class="pagination">';// for bootstrap pagination tag
  			$config['full_tag_close'] = '</ul> </nav>';
  			$config['num_tag_open'] = '<li>';
  			$config['num_tag_close'] = '</li>';
  			$config['next_tag_open'] = '<li>';
  			$config['next_tag_close'] = '</li>';
  			$config['prev_tag_open'] = '<li>';
  			$config['prev_tag_close'] = '</li>';
  			$config['cur_tag_open'] = '<li class="active" ><a href="#">';
  			$config['cur_tag_close'] = '</a></li>';

  			$config['records'] = $this->Admin_contests->getrecords($config['per_page']);
  			$this->pagination->initialize($config);
  			//$data['records'] = $this->Admin_contests->getrecords($config['per_page']);
  			$config['links'] = $this->pagination->create_links();
  			$this->load->view('admin/test_body',$config);

		}
		else
		{
			redirect('admin');
			//redirect to login page of admin
		}
	}
	public function add()
	{
		$this->load->view('admin/test');
		$this->load->view('admin/add');
	}

	public function addcontest()
	{
		$this->form_validation->set_rules('code','code','required|trim|callback_is_code|xss_clean');
		$this->form_validation->set_rules('name','Name','required|trim|callback_is_name|xss_clean');
		$this->form_validation->set_rules('starttime','Start time','required|xss_clean');
		$this->form_validation->set_rules('endtime','End time','required|xss_clean');
		$this->form_validation->set_rules('content','Description','required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" style="font-size:15px;width:30%">','</div>');

		if($this->form_validation->run())
		{
			
			$cdata = array
			(
				'code'	=>	$this->input->post('code'),
				'name'	=>	$this->input->post('name'),
				'starttime'	=>	$this->input->post('starttime'),
				'endtime'	=>	$this->input->post('endtime'),
				'content'	=>	$this->input->post('content')
			);
			if($this->Admin_contests->addcontest($cdata))
			{
				$this->session->set_flashdata('contest','Contest has been successfully added');
				echo "Inserted";
			}
			else
			{
				$this->add();
			}
		}
		else
		{
			$this->add();

		}
	}

	public function edit($id)
	{
		if($this->session->userdata('admin_loggedin'))
		{
			$this->contestid = $id;// for temporary purpose of id of contest
			$this->session->set_userdata('id',$id);
			if($this->Admin_contests->is_cid($id))
			{
				$this->load->view('admin/test');
				$data['cdata'] = $this->Admin_contests->getcontest($id);
				$this->load->view('admin/edit',$data);
			}// for validation the id of contest 
			else
			{
				$this->load->view('restricted');
			}
		}
	}

	public function update()
	{

		if($this->session->userdata('admin_loggedin'))
		{
			$this->form_validation->set_rules('code','code','required|trim|callback_is_code|xss_clean');
		$this->form_validation->set_rules('name','Name','required|trim|callback_is_name|xss_clean');
		$this->form_validation->set_rules('starttime','Start time','required|xss_clean');
		$this->form_validation->set_rules('endtime','End time','required|xss_clean');
		$this->form_validation->set_rules('content','Description','required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		$id = $this->session->userdata('id');// id of the contest
		if($this->form_validation->run())
		{
			//echo $this->contestid;

			$cdata = array
			(
				
				'code'	=>	$this->input->post('code'),
				'name'	=>	$this->input->post('name'),
				'starttime'	=>	$this->input->post('starttime'),
				'endtime'	=>	$this->input->post('endtime'),
				'content'	=>	$this->input->post('content')
			);
			
			//echo $this->contestid;
			if($this->Admin_contests->is_cid($id))
			{
				if($this->Admin_contests->update($cdata,$id))
				{
					
					$this->session->set_flashdata('cedit','Contest Updated Successfully');
					redirect('admin/contests');

				}
				else
				{
					redirect('admin/edit'.$this->contestid);
				}
			}
			else
			{
				$this->load->view('restricted');
			}
			
		}
		else
		{
			$data['cdata'] = $this->Admin_contests->getcontest($id);
			$this->load->view('admin/test');
			$this->load->view('admin/edit',$data);
		}


		}
	}

	public function is_code()
	{
		$code = $this->input->post('code');
		if($this->Admin_contests->is_codeexist($code,$this->session->userdata('id')))// code exists
		{
			$this->form_validation->set_message('is_code','Code Already Exists');
			return FALSE;
		}
		else
		{
			// if code doesnot exist no problem
			return TRUE;
		}
	}

	public function is_name()
	{
		$code = $this->input->post('name');
		if($this->Admin_contests->is_nameexist($code,$this->session->userdata('id')))// code exists
		{
			$this->form_validation->set_message('is_name','Name Already Exists');
			return FALSE;
		}
		else
		{
			// if code doesnot exist no problem
			return TRUE;
		}
	}


	public function challenge($name)
	{
		if($this->Admin_contests->is_code($name))
		{
			//$name = $this->db->escape($name);
			

			$data = array
			(
				
				'cname'	=>	$this->Admin_contests->getcontestname($name),
				'name'	=>	$name,
				'problems'	=>	$this->Admin_contests->getprobinfo($name)
			);
			
			$this->load->view('admin/test');
			//$this->load->view('admin/test_body');
			$this->load->view('admin/challenge',$data);
		}
		else
		{
			$this->load->view('users/restricted');
		}
	}
	
	public function addproblem($code)
	{
		if($this->session->userdata('admin_loggedin'))
		{
			$data = array
			(
				'code'	=>	$code
			);
			$this->load->view('admin/test');
			$this->load->view('admin/addprob',$data);
		}
		else
		{
			redirect('/users/restricted');
		}
	}
	
	public function addprob($c)
	{
		if($this->session->userdata('admin_loggedin'))
		{
			$code = $c;
			$data = array
			(
				'code'	=> $code
			);

			
			$this->form_validation->set_rules('pcode','code','required|xss_clean|min_length[4]');
			$this->form_validation->set_rules('pname','Name','required|xss_clean|trim');
			$this->form_validation->set_rules('pauthor','Author','xss_clean|trim');
			
			$this->form_validation->set_rules('pstat','Statement','xss_clean|required');
			$this->form_validation->set_rules('pinput','Input','xss_clean|required');
			$this->form_validation->set_rules('poutput','Output','xss_clean|required');
			$this->form_validation->set_rules('pconstraint','Constraint','xss_clean|required');
			$this->form_validation->set_rules('pexample','Example','xss_clean|required');
			$this->form_validation->set_rules('plang','Language','xss_clean|required');

			$this->form_validation->set_error_delimiters('<div class="alert alert-success" style="font-size:15px;width:30%" >','</div>');
			if($this->form_validation->run())
			{
				$data = array
				(
					'prb_code'		=>	$this->input->post('pcode'),
					'code'			=>	$code,
					'name'			=>	$this->input->post('pname'),
					'statement'		=>	$this->input->post('pstat'),
					'input'			=>	$this->input->post('pinput'),
					'output'		=>	$this->input->post('poutput'),
					'constraint'		=>	$this->input->post('pconstraint'),
					'example'		=>	$this->input->post('pexample'),
					'author'		=>	$this->input->post('pauthor'),
					'lang'			=>	$this->input->post('plang')
				);
				if($this->Admin_contests->insertproblem($data))
				{
					// success
					redirect('/admin/contests');
				}
				else
				{
					// failure load views
					$this->load->view('admin/test');
					$this->load->view('admin/addprob',$data);
				}
			}
			else
			{
				$this->load->view('admin/test');
				$this->load->view('admin/addprob',$data);
			}


		}
		else
		{
			$this->load->view('users/restricted');
		}
	}

	public function problems()
	{
		if($this->session->userdata('is_loggedin'))
		{
			$this->load->view('users/user_header');
			// loading user authenticated view
		}
		else if($this->session->userdata('admin_loggedin'))
		{
			$this->load->view('admin/auth_admin');
			//loading admin authenticated view
		}
		else
		{
			$this->load->view('users/test');
		}
		// function to list all the problems in all contests
		$config['base_url'] = base_url()."index.php/admin/problems";
		$config['total_rows'] = $this->Admin_contests->getproblemcount();
		$config['per_page'] = 5;
		$config['num_links'] = 5;
		$config['num_links'] = 5;
		$config['full_tag_open'] = '<nav><ul class="pagination">';// for bootstrap pagination tag
  		$config['full_tag_close'] = '</ul> </nav>';
  		$config['num_tag_open'] = '<li>';
  		$config['num_tag_close'] = '</li>';
  		$config['next_tag_open'] = '<li>';
  		$config['next_tag_close'] = '</li>';
  		$config['prev_tag_open'] = '<li>';
  		$config['prev_tag_close'] = '</li>';
  		$config['cur_tag_open'] = '<li class="active" ><a href="#">';
  		$config['cur_tag_close'] = '</a></li>';
		
		$config['records'] = $this->Admin_contests->getprobrecords($config['per_page']);
		$this->pagination->initialize($config); 
		$config['links'] = $this->pagination->create_links();
		$this->load->view('problems',$config);
		// problems view used to list a list of problems


	}

}