<?php

class Submission extends CI_Model
{
	

	public function insertcode($data)
	{
		$query = $this->db->insert('submission',$data);
		return $query;
	}
}