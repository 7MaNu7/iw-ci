<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {

	//Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
	function __construct() {
		parent::__construct();

		$this->load->model("Video_m", '', TRUE);
	}


	public function index()
	{
		$data['video']=$this->Video_m->get(1);
		$data['comentarios']=$this->Video_m->get_comments(1);
        $data['related'] = $this->Video_m->get_search_related_videos($this->Video_m->get(1));
		$this->load->view('youtube/video', $data);
	}

    public function watch($id) {
        $data['video']=$this->Video_m->get($id);
		if(!$data['video']) {
			$data['page'] = 'video';
			$data['css_files'] = ["assets/css/404.css", "assets/css/cabecera.css"];
	        $data['js_files'] = ["assets/js/cabecera.js"];
			$this->load->view('error/404', $data);
		}
		else {
			$this->Video_m->increment_visit($id);
			$data['comentarios']=$this->Video_m->get_comments($id);
	        $data['related'] = $this->Video_m->get_search_related_videos($this->Video_m->get($id));
	        $data['css_files'] = ["assets/css/video.css", "assets/css/cabecera.css"];
	        $data['js_files'] = ["assets/js/cabecera.js"];
			$this->load->view('youtube/video', $data);
		}

    }


    public function editar($id)
    {

		 $data['video']=$this->Video_m->get($id);
		if(!$data['video']) {
			$data['page'] = 'video';
			$data['css_files'] = ["assets/css/404.css", "assets/css/cabecera.css"];
	        $data['js_files'] = ["assets/js/cabecera.js"];
			$this->load->view('error/404', $data);
		}
		else {

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
	            unset($_SESSION["visibility"]);
	            unset($_SESSION["license"]);
	            unset($_SESSION["category"]);
	            unset($_SESSION["language"]);
	            unset($_SESSION["qualities"]);
	        }

			$data['titulo'] = "Editar video";
			$data['videovisibilidades']=$this->Video_m->get_all_videovisibility();
			$data['licenses']=$this->Video_m->get_all_licenses();
			$data['categories']=$this->Video_m->get_all_categories();
			$data['languages']=$this->Video_m->get_all_languages();
			$data['qualities']=$this->Video_m->get_all_qualities();
			$data['videoqualities']=$this->Video_m->get_video_qualities($id);
			$data['videotags']=$this->Video_m->get_video_tags($id);
			$data['comentarios']=$this->Video_m->get_comments($id);
	        $data['related'] = $this->Video_m->get_search_related_videos($this->Video_m->get($id));
	        $data['css_files'] = ["assets/css/video.css", "assets/css/cabecera.css"];
	        $data['js_files'] = ["assets/js/cabecera.js"];
			$this->load->view('youtube/editarvideo', $data);
		}

    }

	public function nuevo_comentario()
	{
		$comment = $_POST['comment'];
		$video = $_POST['video'];
		$user = $_POST['user'];

		$this->Video_m->new_comment($video, $user, $comment);
		$this->watch($video);
	}


	public function borrar_comentario()
	{
		$comment = $_POST['comment'];
		$video = $_POST['video'];

		$this->Video_m->delete_comment($comment);
		$this->watch($video);
	}

	function modificar_video() {
					echo "probando";
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
                echo "title: " . $this->input->post('title');
                echo "url: " . $this->input->post('url');
                $_SESSION["title"] = $this->input->post('title'); 
                $_SESSION["url"] = $this->input->post('url');
                $_SESSION["description"] = $this->input->post('description'); 
                $_SESSION["etiquetas"] = $_POST['etiquetas'];
                $_SESSION["visibility"] = $this->input->post('visibility');
                $_SESSION["license"] = $this->input->post('license');
                $_SESSION["category"] = $this->input->post('category');
                $_SESSION["language"] = $this->input->post('language');
                $_SESSION["qualities"] = "";
				if(!empty($this->input->post('qualities'))) {
					if($this->input->post('qualities')) {
						 $_SESSION["qualities"] = $_POST['qualities'];
					} else {
						 $_SESSION["qualities"] = "";
					}
				}

                $_SESSION["clean"] = false;

                //si no pasamos la validación volvemos al formulario mostrando los errores y sin borrar inputs
                echo "id: " . $_SESSION["videoId"];
                $this->editar($_SESSION["videoId"]);

                //Para futuras navegaciones si que se borran los input
                $_SESSION["clean"] = true;
			}
			//si pasamos la validación correctamente pasamos a hacer la inserción en la base de datos
			else {
				$id = $_SESSION["videoId"];
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
				$video_editado = $this->Video_m->video_editado(
					$id,
					$user,
					$title,
					$url,
					$description,
					$visibility,
					$license,
					$category,
					$language
				);
				
	//			$tam = sizeof($arrayetiquetas);
				/* Si la etiqueta no existe la creamos. Relacionamos la etiqueta con el video */
		/*		for ($i=0;$i<$tam;$i++) {
					$tags='';
					$idtag='';
					
					$tags = $this->Video_m->get_tag_name($arrayetiquetas[$i]);
					foreach ($tags as $t) { $idtag = $t->id; }
					
					if(empty($idtag) || $idtag=='') {
						$nueva_tag = $this->Video_m->insert_tag($arrayetiquetas[$i]);
					}
					
					$tags = $this->Video_m->get_tag_name($arrayetiquetas[$i]);
					foreach ($tags as $t) { $idtag = $t->id; }
					$this->Video_m->insert_videotag($nuevo_video, $idtag);
				}
			*/	
				/* Relacionamos las calidades seleccionadas con el video */
		/*		if(!empty($this->input->post('qualities'))) {
					for ($j=0;$j<count($qualities);$j++) {
						$this->Video_m->insert_videoquality($nuevo_video, $qualities[$j]);
					}
				}
			*/	
				$this->load->helper('url');
				redirect("video/watch/" . $_SESSION["videoId"], 'refresh');
			}
		}
  }
}
