<?php 

class Admin_contests extends CI_Model
{
	public function getcontestcount()
	{
		$query = "SELECT * from contest";
		$count = $this->db->query($query);
		return $count->num_rows();
		
	}
	public function getrecords($count)
	{
		$query = $this->db->get('contest',$count,$this->uri->segment(3));
		return $query->result();
	}
	public function addcontest($data)
	{
		$query = $this->db->insert('contest',$data);
		return $query;
	}
	public function getcontest($id)
	{
		$query = $this->db->query('SELECT * FROM contest WHERE id='.$this->db->escape($id));
		return $query->row_array();
	}
	public function getcontestname($code)
	{
		$this->db->select('name');
		$this->db->where('code',$code);
		$query = $this->db->get('contest');
	}
	public function update($data,$id)
	{
		
		
		$query = $this->db->where('id',$id);
		$query = $this->db->update('contest',$data);
		if($query)
		{
			return TRUE;
		}
		return FALSE;
		
	}

	public function is_codeexist($code,$cid)
	{
		$query = $this->db->query('SELECT * FROM contest WHERE code='.$this->db->escape($code).' AND id!='.$this->db->escape($cid));
		if($query->num_rows()>0)
		{
			return TRUE;// if code exists
		}
		return FALSE;
	}
	public function is_nameexist($code,$cid)
	{
		$query = $this->db->query('SELECT * FROM contest WHERE name='.$this->db->escape($code).' AND id!='.$this->db->escape($cid));
		if($query->num_rows()>0)
		{
			return TRUE;// if name exists
		}
		return FALSE;
	}

	public function is_cid($id)
	{
		
		$query = $this->db->where('id',$id);
		$query = $this->db->get('contest');

		if($query->result())
		{
			return TRUE;
		}
		
		return FALSE;
	}

	public function is_code($code)
	{
		$code = $this->db->escape($code);
		$query = $this->db->query('SELECT * FROM contest WHERE code='.$code);

		if($query->num_rows())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	// for validating code in Add problem controller
	

	public function insertproblem($data)
	{
		$query = $this->db->insert('problem',$data);
		//echo $query->result();
		return $query;
	}

	public function getprobinfo($code)
	{
		$this->db->select('name ,prb_code ,submission ,author');
		//$this->db->from('problem');
		$this->db->where('code',$code);
		$query = $this->db->get('problem');

		return $query->result();

	}

	public function is_probcode($code)
	{
		$this->db->where('prb_code',$code);
		$query = $this->db->get('problem');
		if($query->num_rows())
		{
			return TRUE;
		}
		return FALSE;
	}

	public function getproblem($code)
	{
		$this->db->where('prb_code',$code);
		$query = $this->db->get('problem');
		return $query->row();
	}

	public function getlanguages($prob)
	{
		$this->db->select('lang');
		$this->db->where('prb_code',$prob);
		$query = $this->db->get('problem');
		$prob = $query->row();
		$prob = $prob->lang;
		return $prob;
	}
	

	public function getcontestcode($prb_code)
	{
		$this->db->select('code');	
		$this->db->where('prb_code',$prb_code);
		$query = $this->db->get('problem');
		//missing validation for incorrect prb_code
		return $query->row();

	}

	public function getproblemcount()
	{
		$query = $this->db->get('problem');
		return $query->num_rows();
	}
}