<?php

class subirVideo_m extends CI_Model {
	
	function get_all() {
		$this->db->select('id, email, password, userName');
		return $this->db->get("user")->result();
	}	
	
	function count_all() {
		return $this->db->count_all("user");
	}
}