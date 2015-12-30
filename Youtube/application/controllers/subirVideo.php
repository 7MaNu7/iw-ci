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
		$data['videovisibilidades']=$this->subirVideo_m->get_all_videovisibility();
		$data['licenses']=$this->subirVideo_m->get_all_licenses();
		$data['categories']=$this->subirVideo_m->get_all_categories();
		$data['languages']=$this->subirVideo_m->get_all_languages();
		$data['qualities']=$this->subirVideo_m->get_all_qualities();
		$data['cuantos']=$this->subirVideo_m->count_all();
		$this->load->view('youtube/subirvideo', $data);
	}
	
	function insertar_video() {
    	//si se ha pulsado el botón submit validamos el formulario con codeIgniter
		if($this->input->post('submit')) {
			//hacemos las comprobaciones que deseemos en nuestro formulario
			$this->form_validation->set_rules('tittle','nombre','trim|required|xss_clean');
			$this->form_validation->set_rules('url','email','trim|required|xss_clean');
			
			//validamos que se introduzcan los campos requeridos con la función de ci required
			$this->form_validation->set_message('required', 'Campo %s es obligatorio');
			
			if (!$this->form_validation->run())
			{
				//si no pasamos la validación volvemos al formulario mostrando los errores
				$this->index();
			}
			//si pasamos la validación correctamente pasamos a hacer la inserción en la base de datos
			else {/*
				$nombre = $this->input->post('nombre');	
				$email = $this->input->post('email');		
				$asunto = $this->input->post('asunto');							
				$mensaje = $this->input->post('mensaje');
				//conseguimos la hora de nuestro país, en mi caso españa
				date_default_timezone_set("Europe/Madrid");
	        	$fecha = date('Y-m-d');
	         	$hora= date("H:i:s");
				//ahora procesamos los datos hacía el modelo que debemos crear
				$nueva_insercion = $this->comentarios_model->nuevo_comentario(
					$nombre,
					$email,
					$asunto,
					$mensaje,
					$fecha,$hora
				);
				redirect(base_url("comentarios"), "refresh");*/
			}
		}
  }
	
}