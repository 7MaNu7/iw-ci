<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	//Por defecto, si no ay index error
	public function index()
	{
		$data['titulo']="Hola mundo (desde el controlador)";
		$this->load->view('home/index', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */