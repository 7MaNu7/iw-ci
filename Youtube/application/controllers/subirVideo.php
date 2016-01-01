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

		 if (session_status() == PHP_SESSION_NONE)
            session_start();

        //si no se ha llegado a definir la variable que nos indica el borrado de los input
        //o si queremos que se borren (true) entonces mostramos form vacio
        if((!isset($_SESSION['clean'])) || $_SESSION["clean"] == true)
        {
            unset($_SESSION["title"]); 
            unset($_SESSION["url"]);
            unset($_SESSION["description"]); 
            unset($_SESSION["etiquetas"]);
        }


		$data['css_files'] = ["assets/css/cabecera.css", "assets/css/subirvideo.css"];
		$data['js_files'] = ["assets/js/cabecera.js"];
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
			$this->form_validation->set_message('required', 'El campo %s es obligatorio');
			
			if (session_status() == PHP_SESSION_NONE)
				session_start();

			if (!$this->form_validation->run() || (!isset($_SESSION['email']) || !isset($_SESSION['password'])))
			{

                //Como hay error en el formulario no queremos limpiar los input (SALVO PASSWORD)
                $_SESSION["title"] = $this->input->post('title'); 
                $_SESSION["url"] = $this->input->post('url');
                $_SESSION["description"] = $this->input->post('description'); 
                $_SESSION["etiquetas"] = $_POST['etiquetas'];
                $_SESSION["clean"] = false;

                //si no pasamos la validación volvemos al formulario mostrando los errores y sin borrar inputs
                $this->index();

                //Para futuras navegaciones si que se borran los input
                $_SESSION["clean"] = true;
			}
			//si pasamos la validación correctamente pasamos a hacer la inserción en la base de datos
			else {
				$title = $this->input->post('title');	
				$url = $this->input->post('url');		
				$description = $this->input->post('description');							
				$visibility = $this->input->post('visibility');
				$visibility = $this->input->post('visibility');
				$license = $this->input->post('license');
				$category = $this->input->post('category');
				$language = $this->input->post('language');
				
				$qualities = "";
				if(!empty($this->input->post('qualities'))) {
					if($this->input->post('qualities')) {
						$qualities = $_POST['qualities'];
					} else {
						$qualities = "";
					}
				}
				
				/* Obtenemos array de etiquetas separadas por comas */
				$etiquetas = $_POST['etiquetas'];
				$arrayetiquetas = explode(",", $etiquetas);
				
				/* Obtenemos el id de los usuarios */
				$user = $_SESSION["id"];				
				
				//ahora procesamos los datos hacía el modelo que debemos crear
				$nuevo_video = $this->subirVideo_m->nuevo_video(
					$user,
					$title,
					$url,
					$description,
					$visibility,
					$license,
					$category,
					$language
				);
				
				$tam = sizeof($arrayetiquetas);
				/* Si la etiqueta no existe la creamos. Relacionamos la etiqueta con el video */
				for ($i=0;$i<$tam;$i++) {
					$tags='';
					$idtag='';
					
					$tags = $this->subirVideo_m->get_tag_name($arrayetiquetas[$i]);
					foreach ($tags as $t) { $idtag = $t->id; }
					
					if(empty($idtag) || $idtag=='') {
						$nueva_tag = $this->subirVideo_m->insert_tag($arrayetiquetas[$i]);
					}
					
					$tags = $this->subirVideo_m->get_tag_name($arrayetiquetas[$i]);
					foreach ($tags as $t) { $idtag = $t->id; }
					$this->subirVideo_m->insert_videotag($nuevo_video, $idtag);
				}
				
				/* Relacionamos las calidades seleccionadas con el video */
				if(!empty($this->input->post('qualities'))) {
					for ($j=0;$j<count($qualities);$j++) {
						$this->subirVideo_m->insert_videoquality($nuevo_video, $qualities[$j]);
					}
				}
				
				$this->load->helper('url');
				redirect("inicio", 'refresh');
			}
		}
  }
	
}