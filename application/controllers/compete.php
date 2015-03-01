<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Compete extends CI_Controller
{
	public function index()
	{
		redirect('admin/contests');	
	}

	public function prob($code=NULL)
	{
		if($this->Admin_contests->is_probcode($code))
		{
			$lang = $this->Admin_contests->getlanguages($code);
			$lang = explode(',',$lang);
			for ($i=0 ; $i<count($lang);$i++)
			{
				$lang[$i] = trim($lang[$i]);
				$lang[$i] = strtolower($lang[$i]);
			}
			
			$data = array
			(
				'lang'	=>	$lang,
				'prob'	=>	$this->Admin_contests->getproblem($code)
			);
			$this->load->view('admin/test');
			$this->load->view('admin/problem',$data);
		}
		else
		{
			$this->load->view('restricted');
		}
	}
}