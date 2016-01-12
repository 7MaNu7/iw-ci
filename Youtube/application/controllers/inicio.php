<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

	//Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
	function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model("Inicio_m", '', TRUE);
	}


	//Por defecto, si no ay index error
	public function index()
	{
		$data['titulo']="Vídeos más populares";
		$data['page_title'] = 'Inicio';
		$data['cuantos']=$this->Inicio_m->count_all();
		$data['videos']=$this->Inicio_m->get_all();
		$data['session']=$this->session->userdata('logged_in');
        $data['css_files'] = [base_url("assets/css/inicio.css"), base_url("assets/css/cabecera.css")];
        $data['js_files'] = [base_url("assets/js/cabecera.js")];
		$this->load->view('youtube/index', $data);
	}
}
