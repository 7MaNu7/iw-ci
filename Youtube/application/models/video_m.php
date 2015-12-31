<?php

class Video_m extends CI_Model {

	function get($id) {
		$query = $this->db->query('SELECT v.id, v.title, v.url, v.description, v.visits, v.numLikes likes, v.numDislikes dislikes, u.id userid, u.username FROM video v, user u WHERE v.user=u.id AND v.id='. $id);
		return $query->row();
	}

    function get_comments($id) {
        $query = $this->db->query('SELECT c.id, c.comment, u.username, c.date FROM comment c, user u WHERE u.id=c.user AND c.video=' . $id);
        return $query->result();
    }
}
