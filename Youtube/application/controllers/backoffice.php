<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
		$outputarray = json_decode(json_encode($output), true);
		array_push($outputarray['css_files'], base_url("assets/css/cabecera.css"));
		array_push($outputarray['css_files'], base_url("assets/css/backoffice.css"));
		array_push($outputarray['js_files'], base_url("assets/js/cabecera.js"));
		$output = json_decode(json_encode($outputarray));
		$this->load->view('backoffice.php', $output);
	}

	public function licencias()
	{
		$output = $this->grocery_crud->render();
		$this->_backoffice_output($output);
	}

	/* Si queremos tener una página inicial */
	public function obtenerDatos() {
		$my_css_files = [base_url()."assets/css/cabecera.css", base_url()."assets/css/backoffice.css"];
		$my_js_files = [base_url()."assets/js/cabecera.js"];
		$this->_backoffice_output((object)array('output' => '' ,
																						'titulo' => 'Gestión/Back-office',
																						'js_files' => $my_js_files ,
																						'css_files' => $my_css_files));
	}

	public function index()
	{
		//$this->obtenerDatos();
		$this->gestion_licencias();
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
