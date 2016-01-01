<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Busqueda extends CI_Controller {

	//Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
	function __construct() {
		parent::__construct();

		$this->load->model("Busqueda_m", '', TRUE);
	}


	//Por defecto, si no ay index error
	public function index()
	{
		$data['titulo']="Resultados de la búsqueda";
		$data['videos']=$this->Busqueda_m->get_search_all();
		$data['cuantosvideos']=$this->Busqueda_m->count_search_all();
		
		/* Si paginamos haciendo peticiones por cada pagina */
		$data['tamdescription'] = 112;
		$data['videosporpagina']=20;
		$data['cuantosvideospag']=$this->Busqueda_m->count_search_pag(0, 20);		
		
		$data['css_files'] = ["assets/css/busqueda.css", "assets/css/cabecera.css"];
		$data['js_files'] = ["assets/js/cabecera.js"];
		$this->load->view('youtube/busqueda', $data);
	}
}
