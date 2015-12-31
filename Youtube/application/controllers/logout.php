<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	//Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
	function __construct() {
		parent::__construct();
		$this->load->model("Inicio_m", '', TRUE);
	}

	//Por defecto, si no ay index error
	public function index()
	{
		if (session_status() == PHP_SESSION_NONE)
			session_start();
		
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
		session_destroy();
		
		$this->load->helper('url');
		redirect("inicio", 'refresh');
	}
	
	

}
