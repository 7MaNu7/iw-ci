<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Busqueda extends CI_Controller {

	//Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
	function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->model("Busqueda_m", '', TRUE);
	}


	//Por defecto, si no ay index error
	public function index()
	{
		//Obtenemos que se quiere buscar
		$buscado = "";
		if(isset($_GET['search_query'])) {
			$buscado = $_GET['search_query'];
		}

		$data['titulo']="Resultados de la búsqueda";
		$data['videos']=$this->Busqueda_m->get_search_all($buscado);
		$data['cuantosvideos']=$this->Busqueda_m->count_search_all($buscado);

		// Si paginamos haciendo peticiones por cada pagina
		$data['tamdescription'] = 112;
		$data['videosporpagina']=20;
		$data['cuantosvideospag']=$this->Busqueda_m->count_search_pag(0, 20);

		$data['page_title'] = "Buscar";
		$data['css_files'] = [base_url("assets/css/busqueda.css"), base_url("assets/css/cabecera.css")];
		$data['js_files'] = [base_url("assets/js/cabecera.js")];
		$this->load->view('youtube/busqueda', $data);
	}
}
