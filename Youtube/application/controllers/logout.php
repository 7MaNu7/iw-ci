<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	//Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
	function __construct() {
		parent::__construct();

		$this->load->library('session');
		$this->load->model("Inicio_m", '', TRUE);
	}

	//Por defecto, si no ay index error
	public function index()
	{
		$this->session->sess_destroy();

		$this->load->helper('url');
		redirect("inicio?msg=Se+ha+cerrado+sesion+correctamente", 'refresh');
	}



}
