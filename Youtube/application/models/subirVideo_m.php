<?php

class subirVideo_m extends CI_Model {
	
	function get_all_videovisibility() {
		$this->db->select('id, name');
		return $this->db->get("videovisibility")->result();
	}	
	
	function get_all_licenses() {
		$this->db->select('id, name');
		return $this->db->get("license")->result();
	}	
	
	function get_all_categories() {
		$this->db->select('id, name');
		return $this->db->get("category")->result();
	}	
	
	function count_all() {
		return $this->db->count_all("user");
	}
}