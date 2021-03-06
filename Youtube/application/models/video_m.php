<?php

class Video_m extends CI_Model {

	function get_all() {
		$query = $this->db->query('SELECT v.id, v.title, v.url, v.description, u.username, u.id userid FROM video v, user u WHERE v.user=u.id ORDER BY v.visits DESC LIMIT 21');
		return $query->result();
	}

	function count_all() {
		return $this->db->count_all("video");
	}

	function get($id) {

		$query = $this->db->query('SELECT v.id, v.title, v.url, v.description, v.visits, v.numLikes likes, v.numDislikes dislikes, v.license, v.category, v.language, v.visibility, u.id userid, u.username FROM video v, user u WHERE v.user=u.id AND v.id='. $id);

		return $query->row();
	}

	function count_likes() {
		return $this->db->count_all("videolikes");
	}

	function count_dislikes() {
		return $this->db->count_all("videodislikes");
	}

	function increment_visit($id)
	{
		$this->db->where('id', $id);
		$this->db->set('visits', 'visits+1', false);
		$this->db->update('video');
	}

	function increment_likes($id)
	{
		$this->db->where('id', $id);
		$this->db->set('numLikes', 'numLikes+1', false);
		$this->db->update('video');
	}

	function increment_dislikes($id)
	{
		$this->db->where('id', $id);
		$this->db->set('numDislikes', 'numDislikes+1', false);
		$this->db->update('video');
	}

	function decrement_likes($id)
	{
		$this->db->where('id', $id);
		$this->db->set('numLikes', 'numLikes-1', false);
		$this->db->update('video');
	}

	function decrement_dislikes($id)
	{
		$this->db->where('id', $id);
		$this->db->set('numDislikes', 'numDislikes-1', false);
		$this->db->update('video');
	}

	function user_likes_it($video, $user)
	{
		$data = array(
			'user' => $user,
			'video' => $video
		);
		$this->db->insert('videolikes', $data);
	}

	function user_dislikes_it($video, $user)
	{
		$data = array(
			'user' => $user,
			'video' => $video
		);
		$this->db->insert('videodislikes', $data);
	}

	function delete_like($video, $user)
	{
		$this->db->where('video', $video);
		$this->db->where('user', $user);
		$this->db->delete('videolikes');
	}

	function delete_dislike($video, $user)
	{
		$this->db->where('video', $video);
		$this->db->where('user', $user);
		$this->db->delete('videodislikes');
	}

	function video_editado($id, $user, $title, $url, $description, $visibility, $license, $category, $language)
	{
		$data = array(
			'user'	=> $user,
			'title' => $title,
			'url' => $url,
			'description' => $description,
			'visibility' => $visibility,
			'license' => $license,
			'category' => $category,
			'language' => $language
		);

		$this->db->where('id', $id);
		$this->db->update('video', $data);

		return $id;

	}

	function get_all_videovisibility() {
		$this->db->select('id, name');
		return $this->db->get("videovisibility")->result();
	}

	function get_all_licenses() {
		$this->db->select('id, name');
		return $this->db->get("license")->result();
	}

	function get_all_categories() {
		$this->db->select('id, name');
		return $this->db->get("category")->result();
	}

	function get_all_languages() {
		$this->db->select('id, name');
		return $this->db->get("language")->result();
	}

	function get_all_qualities() {
		$this->db->select('id, name');
		return $this->db->get("quality")->result();
	}

	function get_video_qualities($id) {
		$this->db->select('videoquality.video, quality.id, quality.name');
		$this->db->from('videoquality');
		$this->db->join('quality', 'videoquality.quality = quality.id');
		$this->db->where('videoquality.video', $id);

		return $this->db->get()->result();
	}

	function get_video_tags($id) {
		$this->db->select('videotag.video, tag.id, tag.name');
		$this->db->from('videotag');
		$this->db->join('tag', 'videotag.tag = tag.id');
		$this->db->where('videotag.video', $id);

		return $this->db->get()->result();
	}

	function get_tag_name($name) {
		$this->db->select('id, name');
		$this->db->where('name', $name);
		return $this->db->get("tag")->result();
	}

	function insert_tag($name) {
		$data = array(
			'name'	=> $name
		);
		$this->db->insert('tag',$data);
	}

	function insert_videotag($idvideo, $idtag) {
		$data = array(
			'video'	=> $idvideo,
			'tag'	=> $idtag
		);
		$this->db->insert('videotag',$data);
	}

	function delete_videotag($id, $video_editado)
	{
		$this->db->where('tag', $id);
		$this->db->where('video', $video_editado);
		$this->db->delete('videotag');
	}

	function delete_videoquality($id, $video_editado)
	{
		$this->db->where('quality', $id);
		$this->db->where('video', $video_editado);
		$this->db->delete('videoquality');
	}

	function insert_videoquality($idvideo, $idquality) {
		$data = array(
			'video'	=> $idvideo,
			'quality'	=> $idquality
		);
		$this->db->insert('videoquality',$data);
	}

    function get_comments($id) {
        $query = $this->db->query('SELECT c.id, u.id userid, c.comment, u.username, c.user, c.date FROM comment c, user u WHERE u.id=c.user AND c.video=' . $id);
        return $query->result();
    }

	function new_comment($video_id, $user_id, $comment)
	{
		$data = array(
			'comment' => $comment,
			'user' => $user_id,
			'video' => $video_id,
		);
		$this->db->insert('comment', $data);
	}

	function delete_comment($comment_id)
	{
		$this->db->where('id', $comment_id);
		$this->db->delete('comment');
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


	//buscamos los videos relacionados a un video concreto
	function get_search_related_videos($video) {


		//obtenemos los datos del video y del usuario
		$this->db->select('video.id, user.id userid, title, url, description, duration, visits, user, userName');
		$this->db->from('video');
		$this->db->join('user', 'user.id = video.user');


		if($video!="" && $video!=null)
		{
			//buscamos videos que tengan el mismo autor
			$this->db->like('userName', $video->username);

			//separamos las palabras del titulo del video
			$titlewords = explode(" ", $video->title);

			//para cada palabra
			foreach($titlewords as $word)
			{
				//si es significativa (mas de 3 letras)
				if(strlen($word)>3)
				{
					//buscamos titulos que tenga palabras similares o iguales
					$this->db->or_like('title', $word);
				}
			}

		}
		//ordenado por visitas
		$this->db->order_by('visits');

		//obtenemos los videos resultantes
		$videosquery = $this->db->get()->result();

		//aqui guardaremos todos los videos, buscando por autor/titulo y posteriormente por etiquetas
		$todoslosvideos = array();

		$i=0;
		foreach($videosquery as $vid)
		{

			//quitamos el propio video (buscamos videos diferentes al nuestro)
			if($vid->id==$video->id)
			{
				unset($videosquery[$i]);
			}
			else
			{
				//añadimos el video a la lista definitiva si no es el mismo video que el de la pagina
				$todoslosvideos[] = $vid;
			}
			$i++;
		}

		//funcion de apoyo para usort de modo que ordenaremos por visitas
		function my_sort_function($a, $b)
		{
		    return $a->visits > $b->visits;
		}

		usort($todoslosvideos, 'my_sort_function');

		//nos interesan solo los 12 mas vistos (no tenemos paginacion en la columna)
		//en caso de que no haya etiquetas en el video no se podran buscar videos relacionados por etiquetas
		//en ese caso particular esta sera ya la lista definitiva, en caso contrario se machacara
		$docevideosmasvistos = array_slice($todoslosvideos, 0, 12);

		//obtener las etiquetas del video
		$this->db->select('video.id, tag.id, videotag.tag, videotag.video, name');
		$this->db->from('video');
		$this->db->join('videotag', 'videotag.video = video.id');
		$this->db->join('tag', 'tag.id = videotag.tag');
		$this->db->where('videotag.video', $video->id);

		$etiquetasquery = $this->db->get()->result();

		//si tiene etiquetas obtenemos los videos con dichas etiquetas
		if(sizeof($etiquetasquery)!=0)
		{
			//obtenemos la info de los videos y sus usuarios
			$this->db->select('video.id,  user.id userid, title, url, description, duration, visits, user, tag.id tagid, videotag.tag, videotag.video, name, user, userName');
			$this->db->from('video');
			$this->db->join('videotag', 'videotag.video = video.id');
			$this->db->join('tag', 'tag.id = videotag.tag');
			$this->db->join('user', 'user.id = video.user');

			//el primer where va sin 'or', buscamos la primera etiqueta
			$this->db->where('tag.id', $etiquetasquery[0]->id);

			//añadimos 'or_where' a partir de la segunda etiqueta a buscar (si la hubiese)
			for($j=1; $j<sizeof($etiquetasquery); $j++)
			{
				$this->db->or_where('tag.id', $etiquetasquery[$j]->id);
			}

			//obtenemos los videos relacionados por etiquetas
			$videotagsquery = $this->db->get()->result();

			//recorremos los videos buscados por etiqueta para quitar nuestro propio video y almacenar el resto
			$k=0;
			foreach($videotagsquery as $vidtag)
			{

				//quitamos el propio video
				if($vidtag->id==$video->id)
				{
					unset($videotagsquery[$k]);
				}
				else
				{
					//añadimos el video a la lista definitiva si no es el mismo video que el de la pagina
					$todoslosvideos[] = $vidtag;
				}

				$k++;
			}

			//En este punto tenemos en 'todoslosvideos' los videos de las dos busquedas realizadas
			//puede haber duplicados entre ellos, por ello quitaremos los videos que tengan la misma id que otro

			//este es el array temporal que sirve de apoyo para quitar duplicados
			$sin_duplicados = array();

			//nos quedamos los id (sera lo que usaremos para buscar duplicados)
			foreach($todoslosvideos as $k => $v)
			    $sin_duplicados[$k] = $v->id;

			// Find duplicates in temporary array
			$sin_duplicados = array_unique($sin_duplicados);

			// Remove the duplicates from original array
			foreach($todoslosvideos as $k => $v)
			{
			    if (!array_key_exists($k, $sin_duplicados))
			        unset($todoslosvideos[$k]);
			}

			//En este punto tenemos en 'todoslosvideos' los videos de ambas busquedas y sin duplicados

			//como la lista ha cambiado al tener etiquetas que buscar (ahora hay mas videos), volvemos a ordenar por visitas
			usort($todoslosvideos, 'my_sort_function');

			//Nos interesan solo los 12 mas vistos porque es una columna sin paginacion
			$docevideosmasvistos = array_slice($todoslosvideos, 0, 12);

		}

		return $docevideosmasvistos;
	}

}
