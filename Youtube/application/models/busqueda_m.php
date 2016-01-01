<?php

class Busqueda_m extends CI_Model {
	
	//Para ver las consultas SQL: $this->output->enable_profiler(TRUE);
	
	/* Obtenemos todos los videos según la búsqueda */
	function get_search_all($buscado) {
		$this->db->select('video.id, user.id, title, url, description, duration, visits, user, userName');
		$this->db->from('video');
		$this->db->join('user', 'user.id = video.user');
		if($buscado!="") {
			$this->db->like('description', $buscado);
			$this->db->or_like('title', $buscado);
			$this->db->or_like('userName', $buscado);	
		}
		$this->db->order_by('visits');
		return $this->db->get()->result();
	}
	
	/* Numero de items que aparecen en total */
	function count_search_all($buscado) {
		$this->db->select('video.id, user.id, title, url, description, duration, visits, user, userName');
		$this->db->from('video');
		$this->db->join('user', 'user.id = video.user');
		if($buscado!="") {
			$this->db->like('description', $buscado);
			$this->db->or_like('title', $buscado);
			$this->db->or_like('userName', $buscado);	
		}
		$this->db->order_by('visits');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	/* Si paginamos con peticiones por página */
	
	/* Si hacemos paginación con php necesitaríamos este método */
	function get_search_offset_limit($desde, $hasta) {
		$this->db->select('video.id, user.id, title, url, description, duration, visits, user, userName');
		$this->db->from('video');
		$this->db->join('user', 'user.id = video.user');
		$this->db->order_by('visits');
		$this->db->limit($hasta, $desde);
		return $this->db->get()->result();
	}
	
	/* Numero de items que aparecen en cada pag */
	function count_search_pag($desde, $hasta) {
		$this->db->select('id');
		$this->db->limit($desde, $hasta);		
		$query = $this->db->get('video');
		return $query->num_rows();
	}
}