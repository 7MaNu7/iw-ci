<?php

class Busqueda_m extends CI_Model {
	
	function get_search_all() {
		$this->db->select('video.id, user.id, title, url, description, duration, visits, user, userName');
		$this->db->from('video');
		$this->db->join('user', 'user.id = video.user');
		$this->db->order_by('visits');
		$this->db->limit(50, 0);
		return $this->db->get()->result();
	}
	
	function get_search_offset_limit($desde, $hasta) {
		$this->db->select('video.id, user.id, title, url, description, duration, visits, user, userName');
		$this->db->from('video');
		$this->db->join('user', 'user.id = video.user');
		$this->db->order_by('visits');
		$this->db->limit($hasta, $desde);
		return $this->db->get()->result();
	}	
	
	function count_search_all() {
		$this->db->select('id');
		$this->db->limit(5, 0);
		return $this->db->count_all("video");;
	}
	
	function count_search_pag() {
		$this->db->select('id');
		$this->db->limit(50, 0);		
		$query = $this->db->get('video');
		return $query->num_rows();
	}
	
	function count_all() {
		return $this->db->count_all("video");
	}
}