<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*class Backoffice extends CI_Controller {

	//Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('grocery_CRUD');
	}


	//Por defecto, si no ay index error
	public function index()
	{		
		$data['titulo'] = "Gestión/Back-office";
		$data['css_files'] = ["assets/css/busqueda.css", "assets/css/cabecera.css"];
		$data['js_files'] = ["assets/js/cabecera.js"];
		$data['css_grocery_files'] = ["assets/grocery_crud/themes/datatables/css/datatables.css"];
		
		try {
			$crud = new grocery_CRUD();
			// Seleccionamos el tema
			$crud->set_theme('datatables');
			// Nombre de la tabla en nuestra BD
			$crud->set_table('license');
			// Nombre
			$crud->set_subject('Licencias');
			// Lenguaje
			$crud->set_language('spanish');
			// Campos que son obligatorios
			$crud->required_fields(
				'id',
				'name'
			);
			// Campos que apareceran en la vista (por ej, tlf no aparecerá)
			$crud->columns(
				'id',
				'name'
			);
			$output = $crud->render();
			//$this->load->view('agenda/index', $output);
			
		} catch(Exception $e) {
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
		
		$data['output'] = $output;
		$this->load->view('youtube/backoffice', $data);
	}	
}*/













class Backoffice extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('backofficev.php', $output);
	}

	public function offices()
	{
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}

	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	public function offices_management()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('license');
			$crud->set_subject('Office');
			$crud->required_fields('id');
			$crud->columns('id','name');

			$output = $crud->render();
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}


}