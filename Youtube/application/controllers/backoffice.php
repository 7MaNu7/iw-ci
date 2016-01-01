<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backoffice extends CI_Controller {

	//Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
	function __construct() {
		parent::__construct();

	}


	//Por defecto, si no ay index error
	public function index()
	{
		$data['titulo'] = "Gestión/Back-office";
		$data['css_files'] = ["assets/css/busqueda.css", "assets/css/cabecera.css"];
		$data['js_files'] = ["assets/js/cabecera.js"];
		$this->load->view('youtube/backoffice', $data);
	}
}
