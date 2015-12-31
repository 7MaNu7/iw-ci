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
        $data['css_files'] = ["assets/css/canal.css", "assets/css/cabecera.css"];
        $data['js_files'] = ["assets/js/cabecera.js"];
		$data['user'] = $this->Usuario_m->get($id);
		$data['videos'] = $this->Usuario_m->get_videos($id);
		$data['last_video'] = $data['videos'][0];
		$data['related'] = [];
        $this->load->view('youtube/canal', $data);
    }
}
