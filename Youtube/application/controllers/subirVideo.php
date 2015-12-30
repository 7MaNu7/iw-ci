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
			$this->form_validation->set_rules('title','titulo','trim|required|xss_clean');
			$this->form_validation->set_rules('url','url','trim|required|xss_clean');
			
			//validamos que se introduzcan los campos requeridos con la función de ci required
			$this->form_validation->set_message('required', 'Campo %s es obligatorio');
			
			session_start();
			if (!$this->form_validation->run() || (!isset($_SESSION['email']) || !isset($_SESSION['password'])))
			{
				echo "Hola1";
				//si no pasamos la validación volvemos al formulario mostrando los errores
				$this->index();
			}
			//si pasamos la validación correctamente pasamos a hacer la inserción en la base de datos
			else {
				echo "Hola2";
				$title = $this->input->post('title');	
				$url = $this->input->post('url');		
				$description = $this->input->post('description');							
				$visibility = $this->input->post('visibility');
				$visibility = $this->input->post('visibility');
				$license = $this->input->post('license');
				$category = $this->input->post('category');
				$language = $this->input->post('language');
				
				if($this->input->post('qualities')) {
					$qualities = $_POST['qualities'];
					for ($i=0;$i<count($qualities);$i++) {     
					echo "<br> mira1: " . $i . ": " . $qualities[$i];    
					} 
				} else {
					$qualities = "";
				}
				
				$etiquetas = $_POST['etiquetas'];
				$arrayetiquetas = split(",", $etiquetas, 100);
				
				for ($i=0;$i<count($arrayetiquetas);$i++) {     
				echo "<br> mira3: " . $i . ": " . $arrayetiquetas[$i];    
				}
				$user = $_SESSION["id"];
				
				
				//ahora procesamos los datos hacía el modelo que debemos crear
				$nueva_video = $this->subirVideo_m->nuevo_video(
					$user,
					$title,
					$url,
					$description,
					$visibility,
					$license,
					$category,
					$language,
					$qualities,
					$arrayetiquetas
				);
				
				
				$tag = $this->subirVideo_m->get_tag_name($arrayetiquetas[0]);
				if($tag->id="") {
					$nueva_tag = $this->subirVideo_m->insert_tag($arrayetiquetas[0]);
				}
				
				$tag = $this->subirVideo_m->get_tag_name($arrayetiquetas[0]);
				$this->subirVideo_m->insert_videotag($nueva_video->id, $tag->id);
				
				//redirect(base_url("inicio"), "refresh");
				header('Location: inicio');
			}
		}
  }
	
}