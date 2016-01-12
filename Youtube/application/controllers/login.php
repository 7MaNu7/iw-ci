<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	//Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
	function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model("Login_m", '', TRUE);
	}

	private function data()
	{
		$data['titulo']="Iniciar sesión";
		$data['page_title'] = 'Log in';
		$data['session']=$this->session->userdata('logged_in');
		$data['css_files'] = [base_url("assets/css/inicio.css"), base_url("assets/css/cabecera.css"), base_url("assets/css/login.css")];
		$data['js_files'] = [base_url("assets/js/cabecera.js"), base_url("assets/js/validacion-login.js")];
		return $data;
	}

	//Por defecto, si no ay index error
	public function index()
	{
		$this->load->view('youtube/login_view', $this->data());
	}

	public function verifylogin()
	{
	   	$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
	   	$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

		if($this->form_validation->run() == FALSE)
		{
			//Field validation failed.  User redirected to login page
			$this->load->view('youtube/login_view', $this->data());
		}
		else
		{
			//Go to private area
			redirect('inicio', 'refresh');
		}
	}

	public function check_database()
	{
		$email = $_POST['email'];
		$password = $_POST['password'];

		$result = $this->Login_m->login($email, $password);

		if ($result) {
			$sess_array = array();
			foreach($result as $row)
			{
				$sess_array = array(
					'id' => $row->id,
					'username' => $row->userName,
					'email' => $row->email,
					'admin' => $row->admin
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return true;
		} else {
			$this->form_validation->set_message('check_database', 'Invalid email or password');
     		return false;
		}
	}
}
