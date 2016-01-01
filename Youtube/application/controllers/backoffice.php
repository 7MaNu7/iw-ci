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

	public function _backoffice_output($output = null)
	{
		$this->load->view('backoffice.php', $output);
	}

	public function licencias()
	{
		$output = $this->grocery_crud->render();
		$this->_backoffice_output($output);
	}

	public function index()
	{
		$this->_backoffice_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	// Configuramos la tabla licencias	
	public function gestion_licencias()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('license');
			$crud->set_subject('Licencias');
			$crud->required_fields('id', 'name');
			$crud->columns('id','name');

			$output = $crud->render();
			$this->_backoffice_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	// Configuramos la tabla categorias	
	public function gestion_categorias()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('category');
			$crud->set_subject('Categorias');
			$crud->required_fields('id', 'name');
			$crud->columns('id','name');

			$output = $crud->render();
			$this->_backoffice_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	// Configuramos la tabla visibilidad	
	public function gestion_visibilidad()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('videovisibility');
			$crud->set_subject('Visibilidad');
			$crud->required_fields('id', 'name');
			$crud->columns('id','name');

			$output = $crud->render();
			$this->_backoffice_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	// Configuramos la tabla etiquetas	
	public function gestion_etiquetas()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('tag');
			$crud->set_subject('Etiquetas');
			$crud->required_fields('id', 'name');
			$crud->columns('id','name');

			$output = $crud->render();
			$this->_backoffice_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	// Configuramos la tabla idiomas	
	public function gestion_idiomas()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('language');
			$crud->set_subject('Idiomas');
			$crud->required_fields('id', 'name');
			$crud->columns('id','name');

			$output = $crud->render();
			$this->_backoffice_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	// Configuramos la tabla calidades	
	public function gestion_calidades()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('quality');
			$crud->set_subject('Calidades');
			$crud->required_fields('id', 'name');
			$crud->columns('id','name');

			$output = $crud->render();
			$this->_backoffice_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}


}