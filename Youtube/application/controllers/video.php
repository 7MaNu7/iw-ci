<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {

	//Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
	function __construct() {
		parent::__construct();

		$this->load->model("Video_m", '', TRUE);
		$this->load->model("subirVideo_m", '', TRUE);
		$this->load->helper('url');
		//$this->load->model("Usuario_m", '', TRUE);
		//$this->load->library('session');
	}


	public function index()
	{
		$data['video']=$this->Video_m->get(1);
		$data['comentarios']=$this->Video_m->get_comments(1);
        $data['related'] = $this->Video_m->get_search_related_videos($this->Video_m->get(1));
		$this->load->view('youtube/video', $data);
	}

    public function watch($id) {
			$data['video']=$this->Video_m->get($id);

			if(!$data['video']) {
				$data['page'] = 'video';
				$data['css_files'] = [base_url("assets/css/404.css"), base_url("assets/css/cabecera.css")];
				$data['js_files'] = [base_url("assets/js/cabecera.js")];
				$this->load->view('error/404', $data);
			}
			else {
				$this->Video_m->increment_visit($id);
				$data['comentarios']=$this->Video_m->get_comments($id);
				$data['related'] = $this->Video_m->get_search_related_videos($this->Video_m->get($id));
				$data['page_title'] = $data['video']->title;
				$data['css_files'] = [base_url("assets/css/video.css"), base_url("assets/css/cabecera.css")];
				$data['js_files'] = [base_url("assets/js/cabecera.js")];
				$this->load->view('youtube/video', $data);
			}
    }


    public function editar($id)
    {
		$data['video']=$this->Video_m->get($id);
		if(!$data['video']) {
			$data['page'] = 'video';
			$data['css_files'] = [base_url("assets/css/404.css"), base_url("assets/css/cabecera.css")];
	        $data['js_files'] = [base_url("assets/js/cabecera.js")];
			$this->load->view('error/404', $data);
		}
		else {

	 		if (session_status() == PHP_SESSION_NONE)
            	session_start();

			$data['titulo'] = "Editar video";
			$data['videovisibilidades']=$this->Video_m->get_all_videovisibility();
			$data['licenses']=$this->Video_m->get_all_licenses();
			$data['categories']=$this->Video_m->get_all_categories();
			$data['languages']=$this->Video_m->get_all_languages();
			$data['qualities']=$this->Video_m->get_all_qualities();
			$data['videoqualities']=$this->Video_m->get_video_qualities($id);
			$data['videotags']=$this->Video_m->get_video_tags($id);
			$data['tags'] = $this->subirVideo_m->get_all_tags();
			$data['comentarios']=$this->Video_m->get_comments($id);
	        $data['related'] = $this->Video_m->get_search_related_videos($this->Video_m->get($id));
	        $data['css_files'] = [base_url("assets/css/video.css"), base_url("assets/css/cabecera.css")];
	        $data['js_files'] = [base_url("assets/js/cabecera.js")];
			$this->load->view('youtube/editarvideo', $data);
		}

    }

	public function nuevo_comentario()
	{
		$comment = $_POST['comment'];
		$video = $_POST['video'];
		$user = $_POST['user'];

		$this->Video_m->new_comment($video, $user, $comment);
		$this->watch($video);
	}


	public function borrar_comentario()
	{
		$comment = $_POST['comment'];
		$video = $_POST['video'];

		$this->Video_m->delete_comment($comment);
		$this->watch($video);
	}


	public function dar_like()
	{
		$video = $_POST['video'];
		$user = $_POST['user'];

		$dislikesBefore = $this->Video_m->count_dislikes();

		$this->Video_m->user_likes_it($video, $user);

		//si dio dislike y ahora like se borra el dislike
		$this->Video_m->delete_dislike($video, $user);

		$dislikesAfter = $this->Video_m->count_dislikes();

		//solo en ese caso sera cuando haya que decrementar los dislikes
		if($dislikesBefore!=$dislikesAfter)
		{
			$this->Video_m->decrement_dislikes($video);
		}

		$this->Video_m->increment_likes($video);

		$this->watch($video);
	}

	public function quitar_like()
	{
		$video = $_POST['video'];
		$user = $_POST['user'];

		$likesBefore = $this->Video_m->count_likes();

		//si dio dislike y ahora like se borra el dislike
		$this->Video_m->delete_like($video, $user);

		$likesAfter = $this->Video_m->count_likes();

		//solo en ese caso sera cuando haya que decrementar los dislikes
		if($likesBefore!=$likesAfter)
		{
			$this->Video_m->decrement_likes($video);
		}

		$this->watch($video);
	}


	public function dar_dislike()
	{
		$video = $_POST['video'];
		$user = $_POST['user'];


		$likesBefore = $this->Video_m->count_likes();

		$this->Video_m->user_dislikes_it($video, $user);

		//si dio like y ahora dislike se borra el like
		$this->Video_m->delete_like($video, $user);

		$likesAfter = $this->Video_m->count_likes();

		//solo en ese caso sera cuando haya que decrementar los likes
		if($likesBefore!=$likesAfter)
		{
			$this->Video_m->decrement_likes($video);
		}

		$this->Video_m->increment_dislikes($video);

		$this->watch($video);
	}

	public function quitar_dislike()
	{
		$video = $_POST['video'];
		$user = $_POST['user'];

		$likesBefore = $this->Video_m->count_dislikes();

		//si dio dislike y ahora like se borra el dislike
		$this->Video_m->delete_dislike($video, $user);

		$likesAfter = $this->Video_m->count_dislikes();

		//solo en ese caso sera cuando haya que decrementar los dislikes
		if($likesBefore!=$likesAfter)
		{
			$this->Video_m->decrement_dislikes($video);
		}

		$this->watch($video);
	}

	public function borrar_video()
	{
		$video = $_POST['video'];

		$this->Video_m->delete_comments_video($video);
		$this->Video_m->delete_tags_video($video);
		$this->Video_m->delete_qualities_video($video);
		$this->Video_m->delete_video($video);

		$data['titulo']="Vídeos más populares";
		$data['cuantos']=$this->Video_m->count_all();
		$data['videos']=$this->Video_m->get_all();
		$data['css_files'] = [base_url("assets/css/inicio.css"), base_url("assets/css/cabecera.css")];
		$data['js_files'] = [base_url("assets/js/cabecera.js")];
		$this->load->view('youtube/index', $data);

	}

	function modificar_video() {

    	//si se ha pulsado el botón submit validamos el formulario con codeIgniter
		if($this->input->post('submit')) {
			//hacemos las comprobaciones que deseemos en nuestro formulario
			$this->form_validation->set_rules('title','titulo','trim|required|xss_clean');
			$this->form_validation->set_rules('url','url','trim|required|xss_clean');

			//validamos que se introduzcan los campos requeridos con la función de ci required
			$this->form_validation->set_message('required', 'El campo %s es obligatorio');

			if (session_status() == PHP_SESSION_NONE)
				session_start();

			if (!$this->form_validation->run() || (!isset($_SESSION['email']) || !isset($_SESSION['password'])))
			{

                //si no pasamos la validación volvemos al formulario mostrando los errores y sin borrar inputs
                $this->editar($_SESSION["videoId"]);

			}
			//si pasamos la validación correctamente pasamos a hacer la inserción en la base de datos
			else {
				$id = $_SESSION["videoId"];
				$title = $this->input->post('title');
				$url = $this->input->post('url');
				$description = $this->input->post('description');
				$visibility = $this->input->post('visibility');
				$visibility = $this->input->post('visibility');
				$license = $this->input->post('license');
				$category = $this->input->post('category');
				$language = $this->input->post('language');

				$qualities = array();
				if(!empty($this->input->post('qualities'))) {
					if($this->input->post('qualities')) {
						$qualities = $_POST['qualities'];
					} else {
						$qualities = array();
					}
				}

				/* Obtenemos array de etiquetas separadas por comas */
				$arrayetiquetas = $_POST['etiquetas'];

				/* Obtenemos el id de los usuarios */
				$user = $_SESSION["id"];

				//ahora procesamos los datos hacía el modelo que debemos crear
				$video_editado = $this->Video_m->video_editado(
					$id,
					$user,
					$title,
					$url,
					$description,
					$visibility,
					$license,
					$category,
					$language
				);

				//tags del video antes de editar
				$antiguastags = $this->Video_m->get_video_tags($id);

				for($cont=0; $cont<sizeof($antiguastags); $cont++)
				{
					$encontrado = false;

					for($pos=0; $pos<sizeof($arrayetiquetas); $pos++)
					{

						//este video tenia una etiqueta que coincide con una etiqueta al modificar
						if($antiguastags[$cont]->name == $arrayetiquetas[$pos])
						{

							//si la etiqueta ya estaba antes no hace falta insertarla de nuevo
							//dejaremos en el array solo los que se van a insertar
							unset($arrayetiquetas[$pos]);
							$arrayetiquetas = array_values($arrayetiquetas);
							$pos--;
							$encontrado=true;
						}
					}

					//una etiqueta que tenia el video no la tiene tras editar
					if($encontrado==false)
					{
						//borramos la relacion de ese video con ese tag
						$this->Video_m->delete_videotag($antiguastags[$cont]->id, $video_editado);
					}
				}

				$tam = sizeof($arrayetiquetas);

				/* Si la etiqueta no existe la creamos. Relacionamos la etiqueta con el video */
				for ($i=0;$i<$tam;$i++) {
					$tags='';
					$idtag='';

					$tags = $this->Video_m->get_tag_name($arrayetiquetas[$i]);
					foreach ($tags as $t) { $idtag = $t->id; }

					if(empty($idtag) || $idtag=='') {
						$nueva_tag = $this->Video_m->insert_tag($arrayetiquetas[$i]);
					}

					$tags = $this->Video_m->get_tag_name($arrayetiquetas[$i]);
					foreach ($tags as $t) { $idtag = $t->id; }
					$this->Video_m->insert_videotag($video_editado, $idtag);
				}

				$antiguasqualities = $this->Video_m->get_video_qualities($id);

				for($cont=0; $cont<sizeof($antiguasqualities); $cont++)
				{
					$encontrado = false;

					for($pos=0; $pos<sizeof($qualities); $pos++)
					{
						//este video tenia una calidad que coincide con una calidad al modificar
						if($antiguasqualities[$cont]->id == $qualities[$pos])
						{
							//si la calidad ya estaba antes no hace falta insertarla de nuevo
							//dejaremos en el array solo los que se van a insertar
							unset($qualities[$pos]);
							$qualities = array_values($qualities);
							$pos--;
							$encontrado=true;
						}

					}

					//una calidad que tenia el video no la tiene tras editar
					if($encontrado==false)
					{
						//borramos la relacion de ese video con esa calidad
						$this->Video_m->delete_videoquality($antiguasqualities[$cont]->id, $video_editado);
					}

				}

				/* Relacionamos las calidades seleccionadas con el video */
				if(!empty($this->input->post('qualities'))) {
					for ($j=0;$j<count($qualities);$j++) {
						$this->Video_m->insert_videoquality($video_editado, $qualities[$j]);
					}
				}
				$this->load->helper('url');
				redirect("video/watch/" . $_SESSION["videoId"], 'refresh');
			}
		}
  }
}
