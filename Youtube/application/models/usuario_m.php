<?php

class Usuario_m extends CI_Model {

	function get($id) {
		$query = $this->db->query('SELECT id, username FROM user WHERE id='. $id);
		return $query->row();
	}

    function get_videos($id) {
        $query = $this->db->query('SELECT id, title, description, url, visits FROM video WHERE user=' . $id);
        return $query->result();
    }
}
