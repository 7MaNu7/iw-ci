<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

	//Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
	function __construct() {
		parent::__construct();
		
		$this->load->model("Inicio_m", '', TRUE); 
	}
	
	
	//Por defecto, si no ay index error
	public function index()
	{
		$data['titulo']="Vídeos más populares";
		$data['cuantos']=$this->Inicio_m->count_all();
		$data['videos']=$this->Inicio_m->get_all();
		$this->load->view('youtube/index', $data);
	}
}