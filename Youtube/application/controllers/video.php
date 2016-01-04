<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {

	//Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
	function __construct() {
		parent::__construct();

		$this->load->model("Video_m", '', TRUE);
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
			$data['css_files'] = ["assets/css/404.css", "assets/css/cabecera.css"];
	        $data['js_files'] = ["assets/js/cabecera.js"];
			$this->load->view('error/404', $data);
		}
		else {
			$data['comentarios']=$this->Video_m->get_comments($id);
	        $data['related'] = $this->Video_m->get_search_related_videos($this->Video_m->get($id));
	        $data['css_files'] = ["assets/css/video.css", "assets/css/cabecera.css"];
	        $data['js_files'] = ["assets/js/cabecera.js"];
			$this->load->view('youtube/video', $data);
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
}
