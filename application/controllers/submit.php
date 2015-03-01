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

				//echo $contest_code;
				$prob_data = array
				(
					'prb_code'	=>	$code,
					'code'		=>	$contest_code,
					'uid'		=>	$uid,
					'lang'		=>	$this->input->post('lang'),
					'usercode'		=>	$this->input->post('code')
				);

				if($this->Submission->insertcode($prob_data))
				{
					redirect('admin/contests');
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
}