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
        $query = $this->db->query('SELECT c.id, c.comment, u.username, c.user, c.date FROM channelcomment c, user u WHERE u.id=c.user AND c.channel=' . $id);
        return $query->result();
    }

	function get_related($id) {
        $query = $this->db->query('SELECT u.id, u.username FROM channelrelated c, user u WHERE u.id=c.user AND c.channel=' . $id);
        return $query->result();
    }

	function new_comment($channel_id, $user_id, $comment)
	{
		$data = array(
			'comment' => $comment,
			'user' => $user_id,
			'channel' => $channel_id,
		);
		$this->db->insert('channelcomment', $data);
	}

	function delete_comment($comment_id)
	{
		$this->db->where('id', $comment_id);
		$this->db->delete('channelcomment');
	}


	function delete_video($video_id)
	{
		$this->db->where('id', $video_id);
		$this->db->delete('video');
	}

	function delete_comments_video($video)
	{
		$this->db->where('video', $video);
		$this->db->delete('comment');
	}

	function delete_tags_video($video)
	{
		$this->db->where('video', $video);
		$this->db->delete('videotag');
	}

	function delete_qualities_video($video)
	{
		$this->db->where('video', $video);
		$this->db->delete('videoquality');
	}


	function new_related($user, $new_user)
	{
		$data = array(
			'channel' => $user,
			'user' => $new_user
		);
		$this->db->insert('channelrelated', $data);
	}

	function likes_video($user, $video)
	{
		$where = array('user' => $user, 'video' => $video);
		$this->db->select('video', 'user');
		$this->db->where($where);
		return $this->db->count_all_results('videolikes');
	}

	function dislikes_video($user, $video)
	{
		$where = array('user' => $user, 'video' => $video);
		$this->db->select('video', 'user');
		$this->db->where($where);
		return $this->db->count_all_results('videodislikes');
	}
}
