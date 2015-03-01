<?php

class Admin_model extends CI_Model
{
	public function is_admin_email()
	{
		$email = $this->input->post('email');
		
		$email = $this->db->escape($email);

		$password = md5($this->input->post('password'));
		
		$password = $this->db->escape($password);// SQL injection and returns string
		$query = $this->db->query("SELECT * from admin WHERE 
						email=".$email." AND password=".$password."");
		if($query->num_rows())
		{
			return TRUE;
		}
		return FALSE;
	}
}