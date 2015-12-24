<?php

class Agenda_m extends CI_Model {
	
	function get_all() {
		$this->db->select('id, nombre, telefono, email');
		$this->db->order_by('nombre');
		return $this->db->get("agenda")->result();
	}
	
	function count_all() {
		return $this->db->count_all("agenda");
	}
}