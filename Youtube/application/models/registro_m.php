<?php

class registro_m extends CI_Model {
    
	function get_all() {
		$this->db->select('id, email, password, userName');
		return $this->db->get("user")->result();
	}

	function count_all() {
		return $this->db->count_all("user");
	}

	function nueva_cuenta($userName, $email, $password) {
		$data = array(
			'userName'	=> $userName,
			'email' => $email,
			'password' => $password
		);
		
		//Lo insertamos en la BD
		$this->db->insert('user',$data);
		
		$insert_id = $this->db->insert_id();
		return  $insert_id;
		
	}
}
