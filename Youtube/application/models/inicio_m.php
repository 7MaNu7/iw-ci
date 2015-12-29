<?php

class Inicio_m extends CI_Model {
	
	function get_all() {
		$this->db->select('id, title, url, description, duration, user');
		$this->db->order_by('visits');
		$this->db->limit(15, 0);
		return $this->db->get("video")->result();
	}
	
	function count_all() {
		return $this->db->count_all("video");
	}
}