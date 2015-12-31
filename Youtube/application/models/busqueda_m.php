<?php

class Busqueda_m extends CI_Model {
	
	function get_search_all() {
		$this->db->select('video.id, user.id, title, url, description, duration, visits, user, userName');
		$this->db->from('video');
		$this->db->join('user', 'user.id = video.user');
		$this->db->order_by('visits');
		$this->db->limit(15, 0);
		return $this->db->get()->result();
	}
	
	function count_search_all() {
		$this->db->select('id');
		return $this->db->count_all("video");;
	}
	
	function count_all() {
		return $this->db->count_all("video");
	}
}