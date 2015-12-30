<?php

class Video_m extends CI_Model {

	function get($id) {
		$query = $this->db->query('SELECT id, title, url, description, visits, numLikes likes, numDislikes dislikes, user FROM video WHERE id='. $id);
		return $query->row();
	}

    function get_comments($id) {
        $query = $this->db->query('SELECT c.id, c.comment, u.username, c.date FROM comment c, user u WHERE u.id=c.user AND c.video=' . $id);
        return $query->result();
    }
}
