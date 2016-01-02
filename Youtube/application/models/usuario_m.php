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

	function get_comments($id) {
        $query = $this->db->query('SELECT c.id, c.comment, u.username, c.date FROM channelcomment c, user u WHERE u.id=c.user AND c.channel=' . $id);
        return $query->result();
    }
}
