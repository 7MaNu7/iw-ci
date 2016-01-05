<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Canal extends CI_Controller {

	//Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
	function __construct() {
		parent::__construct();

		$this->load->model("Usuario_m", '', TRUE);
	}


	public function index()
	{

	}

    public function ver($id)
    {

		$data['user'] = $this->Usuario_m->get($id);
		if(!$data['user']) {
			$data['page'] = "canal";
			$data['css_files'] = ["assets/css/404.css", "assets/css/cabecera.css"];
			$data['js_files'] = ["assets/js/cabecera.js"];
			$this->load->view('error/404', $data);
		}
		else {
			$data['videos'] = $this->Usuario_m->get_videos($id);
			if (count($data['videos']) > 0){
				$data['last_video'] = $data['videos'][0];
			}
			else {
				$data['last_video'] = false;
			}
			$data['related'] = $this->Usuario_m->get_related($id);
			$data['comentarios'] = $this->Usuario_m->get_comments($id);
			$data['css_files'] = ["assets/css/canal.css", "assets/css/cabecera.css"];
			$data['js_files'] = ["assets/js/cabecera.js"];
			$this->load->view('youtube/canal', $data);
		}

    }

	public function nuevo_comentario()
	{
		$comment = $_POST['comment'];
		$channel = $_POST['channel'];
		$user = $_POST['user'];

		$this->Usuario_m->new_comment($channel, $user, $comment);
	}

	public function borrar_comentario()
	{
		$comment = $_POST['comment'];
		$channel = $_POST['channel'];

		$this->Usuario_m->delete_comment($comment);
		$this->watch($channel);
	}


	public function borrar_video()
	{
		$user = $_POST['user'];
		$video = $_POST['video'];

		$this->Usuario_m->delete_comments_video($video);
		$this->Usuario_m->delete_tags_video($video);
		$this->Usuario_m->delete_qualities_video($video);
		$this->Usuario_m->delete_video($video);

		$this->ver($user);

	}

	public function nuevo_relacionado()
	{
		$user = $_POST['user'];
		$new_user = $_POST['newuser'];

		$this->Usuario_m->new_related($user, $new_user);
		$this->ver($user);
	}
}
