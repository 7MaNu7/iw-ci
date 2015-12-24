<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda extends CI_Controller {

	//Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
	function __construct() {
		parent::__construct();
		/*
		Sin grocery:
		$this->load->model("Agenda_m", '', TRUE); 
		*/
		$this->load->database();
		$this->load->library('grocery_CRUD');
	}
	
	
	//Por defecto, si no ay index error
	public function index()
	{
		/*
		Sin grocery:
		$data['titulo']="Listado de la agenda";
		$data['cuantos']=$this->Agenda_m->count_all();
		$data['personas']=$this->Agenda_m->get_all();
		$this->load->view('agenda/index', $data);*/
	
		try {
			$crud = new grocery_CRUD();
		
			/* Seleccionamos el tema */
			$crud->set_theme('datatables');

			/* Nombre de la tabla en nuestra BD */
			$crud->set_table('agenda');

			/* Nombre */
			$crud->set_subject('Listado de la agenda');

			/* Lenguaje */
			$crud->set_language('spanish');

			/* Campos que son obligatorios */
			$crud->required_fields(
				'id',
				'nombre',
				'email'
			);

			/* Campos que apareceran en la vista (por ej, tlf no aparecerá) */
			$crud->columns(
				'id',
				'nombre',
				'email',
				'telefono'
			);

			$output = $crud->render();
			$this->load->view('agenda/index', $output);
			
		} catch(Exception $e) {
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
		
	}
}