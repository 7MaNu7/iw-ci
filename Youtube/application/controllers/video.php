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
        $data['related'] = [];
		$this->load->view('youtube/video', $data);
	}

    public function watch($id) {
        $data['video']=$this->Video_m->get($id);
		$data['comentarios']=$this->Video_m->get_comments($id);
        $data['related'] = [];
        $data['css_files'] = ["css/video.css", "css/cabecera.css"];
        $data['js_files'] = ["js/cabecera.js"];
		$this->load->view('youtube/video', $data);

    }
}
