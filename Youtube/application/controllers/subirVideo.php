<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class subirVideo extends CI_Controller {

	//Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
	function __construct() {
		parent::__construct();		
		$this->load->model("subirVideo_m", '', TRUE); 
	}
	
	//Por defecto, si no ay index error
	public function index()
	{
		$data['titulo']="Subir nuevo vídeo";
		$data['usuarios']=$this->subirVideo_m->get_all();
		$data['cuantos']=$this->subirVideo_m->count_all();
		$this->load->view('youtube/subirvideo', $data);
	}
	
}