<?php

class registro_m extends CI_Model {
    


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
