<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	//Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
	function __construct() {
		parent::__construct();
		$this->load->model("Login_m", '', TRUE);
	}

	//Por defecto, si no ay index error
	public function index()
	{
		$data['titulo']="Iniciar sesión";
		$data['usuarios']=$this->Login_m->get_all();
		$data['cuantos']=$this->Login_m->count_all();
        $data['css_files'] = ["css/inicio.css", "css/cabecera.css", "css/login.css"];
        $data['js_files'] = ["js/cabecera.js"];
		$this->load->view('youtube/login', $data);
	}

}
