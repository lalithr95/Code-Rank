<?php 

class User_model extends CI_Model
{
	public function register($data)
	{
		$query = $this->db->insert('users',$data);

		return $query;

	}
	public function is_user($data)
	{
		$query = $this->db->query("SELECT username from users WHERE username=".$this->db->escape($data)."");

		if($query->num_rows() >0)
		{
			return TRUE;
		}
		return FALSE;
	}
	public function is_emailid($data)
	{
		$query = $this->db->query("SELECT email from users WHERE email=".$this->db->escape($data)."");

		if($query->num_rows() >0)
		{
			return TRUE;
		}
		return FALSE;
	}

	public function validate_user($data)
	{
		$query = $this->db->query("SELECT * FROM users 
				WHERE email=".$this->db->escape($data['email'])."");
		if($query->num_rows() == 1)
		{
			if($query->row()->password == $data['password'])
			{
				// Success Login
				return TRUE;
			}
		}
		else
		{
			return FALSE;
		}
		
		
		
	}

	public function can_login()
	{
		$this->db->where('email',$this->input->post('lemail'));
		$this->db->where('password',md5($this->input->post('lpassword')));

		$query = $this->db->get('users');
		if($query->num_rows() == 1)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function userdata($data)
	{
		$query = $this->db->query("SELECT * FROM users WHERE email=".$this->db->escape($data)."");

		$udata = array
		(
			'id' 		=> $query->row()->id,
			'username' 	=> $query->row()->username,
			'email' 	=> $query->row()->email,
			'password'  => $query->row()->password,
			'image'		=> $query->row()->image

		);
		return $udata;
	}

	public function getuserid($email)
	{
		$this->db->select('id');
		$this->db->where('email',$email);
		$query = $this->db->get('users');
		return $query->row();
	}
}