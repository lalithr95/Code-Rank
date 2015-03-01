<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
	//public $flag = 0;
	function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{
		if($this->session->userdata('is_loggedin'))
		{
			$this->load->view('users/index');
		}
		else
		{
			$this->load->view("header");
			$this->load->view("main");
			$this->load->view("footer");
		}
		
	}

	public function register()
	{

		//$this->load->library("form_validation");


		$this->form_validation->set_rules("username","Username","required|trim|minlenth[4]|xss_clean|callback_is_username");
		$this->form_validation->set_rules("email","Email","required|trim|valid_email|xss_clean|callback_is_email");
		$this->form_validation->set_rules("password","Password","required|min_length[6]|trim");
		$this->form_validation->set_rules("confirm","Confirm","required|min_length[6]|trim|matches[confirm]");
		$this->form_validation->set_error_delimiters('<div class="alert alert-success" style="font-size:15px">', '</div>');

		if($this->form_validation->run())
		{
			// success
			// register user
			$pass = md5($this->input->post("password"));// encrypting password
			$gravatar = md5($this->input->post("email"));// encrypting email
			//$gravatar = "http://www.gravatar.com/avatar/".$gravatar; Resulting in link in database
			$data = array
			(
				'username' 	=> $this->input->post('username'),
				'email'		=> $this->input->post('email'),
				'password'	=> $pass,
				'image' 	=> $gravatar

			);
			$this->load->model("User_model");
			$query = $this->User_model->register($data);
			if($query)
			{
				// registered
				$this->session->set_flashdata("registered","Registration successfull");
				$this->index();
			}
			else
			{
				$this->index();
			}
			

		}
		else
		{
			// redirect user to home view
			$this->load->view("header");
			$this->load->view("main");
			$this->load->view("footer");
		}
	}

	public function is_username()
	{
		$uname = $this->input->post('username');
		$this->load->model('User_model');
		$result = $this->User_model->is_user($uname);

		if($result)
		{
			$this->form_validation->set_message('is_username','Username already exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function is_email()
	{
		$email = $this->input->post('email');
		$this->load->model('User_model');
		$result = $this->User_model->is_emailid($email);

		if($result)
		{
			$this->form_validation->set_message('is_email','Email already Exists');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function login()
	{

		$this->form_validation->set_rules('lemail','Email','required|xss_clean|trim|callback_invalid');
		$this->form_validation->set_rules('lpassword','Password','required|trim');
		$this->form_validation->set_error_delimiters('<div class="alert alert-success" style="font-size:15px">', '</div>');
		if($this->form_validation->run())
		{
			// login user
			// redirect to Users area
			$udata = array
			(
				'email' 	=> $this->input->post('lemail'),
				'is_loggedin' => 1,
				
			);
			$this->session->set_userdata($udata);
			//$result = $this->User_model->validate_user($udata);
			redirect('/home/compete');
			
		}
		else
		{
			$this->index();
		}
	}


	public function invalid()
	{
		if($this->User_model->can_login())
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('invalid','Invalid Login details');
			return FALSE;
		}
	}

	

	public function compete()
	{
		// for only registered users
		if($this->session->userdata('is_loggedin'))
		{	
			$this->load->view('/users/user_body');


		}
		else
		{
			$this->load->view('restricted');
		}

	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home/index');
	}
}