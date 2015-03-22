<?php

class Submission extends CI_Model
{
	

	public function insertcode($data)
	{
		$query = $this->db->insert('submission',$data);
		return $query;
	}
	public function getsid($timestamp)
	{
		$this->db->where('timestamp',$timestamp);
		$query = $this->db->get('submission');

		return $query->row();//missing validation for wrong timestamp

	}
	public function getlang($timestamp)
	{
		$this->db->select('lang');
		$this->db->where('timestamp',$timestamp);
		$query = $this->db->get('submission');

		return $query->row();

	}
	public function update_error($sid,$data)
	{
		$this->db->where('sid',$sid);
		$query = $this->db->update('submission',$data);
		return $query;
	}

	public function getcode($sid)
	{
		$this->db->where('sid',$sid);
		$query = $this->db->get('submission');
		return $query->row();
	}

	public function setsubmission($prb_code)
	{
		$this->db->where('prb_code',$prb_code);
		$query = $this->db->get('submission');
		$count = $query->num_rows();
		$this->db->where('prb_code',$prb_code);
		$data = array(
			'submission' 	=>		$count
		);
		$query = $this->db->update('problem',$data);
		
	}

	// Now setting the submission count
	
}