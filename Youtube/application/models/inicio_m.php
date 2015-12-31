<?php

class Inicio_m extends CI_Model {

	function get_all() {
		$this->db->select('id, title, url, description, duration, user');
		$this->db->order_by('visits');
		$this->db->limit(15, 0);
		$query = $this->db->query('SELECT v.id, v.title, v.url, v.description, u.username, u.id userid FROM video v, user u WHERE v.user=u.id ORDER BY v.visits');
		return $query->result();
	}

	function count_all() {
		return $this->db->count_all("video");
	}
}
