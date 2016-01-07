<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	//Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
	function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->model("Login_m", '', TRUE);
	}

	//Por defecto, si no ay index error
	public function index()
	{
		$data['titulo']="Iniciar sesión";
		$data['usuarios']=$this->Login_m->get_all();
		$data['cuantos']=$this->Login_m->count_all();
		$data['css_files'] = [base_url("assets/css/inicio.css"), base_url("assets/css/cabecera.css"), base_url("assets/css/login.css")];
		$data['js_files'] = [base_url("assets/js/cabecera.js"), base_url("assets/js/validacion-login.js")];
		$this->load->view('youtube/login', $data);
	}

}
