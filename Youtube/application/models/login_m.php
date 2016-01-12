<?php

class Login_m extends CI_Model {

	function get_all() {
		$this->db->select('id, email, password, userName, admin');
		return $this->db->get("user")->result();
	}

	function get_one($email, $password) {
		$this->db->select('id, email, password, userName');
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		return $this->db->count_all_results("user");
	}


	function count_all() {
		return $this->db->count_all("user");
	}

	function login($email, $password)
	{
		$this -> db -> select('id, email, password, userName, admin');
		$this -> db -> from('user');
		$this -> db -> where('email', $email);
		$this -> db -> where('password', $password);
		$this -> db -> limit(1);

		$query = $this -> db -> get();

   		if($query -> num_rows() == 1)
   		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
}
