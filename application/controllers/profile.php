<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function index()
	{
		if($this->session->userdata('is_loggedin'))
		{

			$userdata = $this->User_model->userdata($this->session->userdata('email'));
			$this->load->view('users/user_header');
			$this->load->view('users/user_body');
			//print_r($userdata);
			$this->load->view('users/profile',$userdata);
		}
		else
		{
			redirect('home/');
		}
	}

	public function edit()
	{
		if($this->session->userdata('is_loggedin'))
		{
			$userdata = $this->User_model->userdata($this->session->userdata('email'));
			$this->load->view('users/user_header');
			$this->load->view('users/user_body');
			$this->load->view('users/edit',$userdata);
		}
	}

	public function update()
	{
		if($this->session->userdata('is_loggedin'))
		{
			$this->form_validation->set_rules('email','Email','required|trim|xss_clean|valid_email|callback_');
			$this->form_validation->set_rules('username','Username','required|trim|xss_clean');
			$this->form_validation->set_rules('password','Password','required|trim|min_length[6]');
			$this->form_validation->set_rules('newpass','New Password','required|trim|min_length[6]');
			$this->form_validation->set_rules('confpass','Confirm Password','required|trim|min_length[6]|matches[newpass]');
			$this->form_validation->set_error_delimiters('<div class="alert alert-success" style="font-size:15px">', '</div>');
			
			if($this->form_validation->run())
			{
				// successfully update details
			}
			else
			{

			}

		}
	}

}