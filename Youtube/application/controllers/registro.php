<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class registro extends CI_Controller {

    //Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
    function __construct() {
        parent::__construct();        
        $this->load->model("registro_m", '', TRUE); 
    }
    
    //Por defecto, si no ay index error
    public function index()
    {
        $data['usuarios']=$this->registro_m->get_all();
        $data['cuantos']=$this->registro_m->count_all();
        $data['css_files'] = ["assets/css/cabecera.css", "assets/css/subirvideo.css"];
        $data['js_files'] = ["assets/js/cabecera.js"];
        $data['titulo']="Registrarse";
        $this->load->view('youtube/registro', $data);
    }

    public function probando($email)
    {

        $fracciones = explode("@", $email);
                
        if (sizeof($fracciones)!=2)
        {
            $this->form_validation->set_message('probando', 'El campo %s debe seguir el formato ***@***.***');
            return FALSE;
        }
        else
        {
            $cadFinal = explode(".", $fracciones[1]);
            if(sizeof($cadFinal)!=2)
            {
                $this->form_validation->set_message('probando', 'El campo %s debe seguir el formato ***@***.***');
                return FALSE;
            }
            else if(strlen($cadFinal[1])<2 || strlen($cadFinal[0])<2)
            {
                $this->form_validation->set_message('probando', 'El campo %s debe tener minimo dos caracteres despues del "@" y del "."');
                return FALSE; 
            }
            return TRUE;
        }
    }

    public function repetirPass($password)
    {
        $repetirPassword = $this->input->post('repetirPassword'); 

        if($password==$repetirPassword)
        {
            return TRUE;
        }
        else
        {
             $this->form_validation->set_message('repetirPass', 'El campo de repetir la password debe coincidir con el campo password');
            return FALSE;
        }
    }
    
    public function insertar_usuario(){


        //si se ha pulsado el botón submit validamos el formulario con codeIgniter
        if($this->input->post('submit')) {
            //hacemos las comprobaciones que deseemos en nuestro formulario
            $this->form_validation->set_rules('userName','userName','trim|required|xss_clean|is_unique[user.userName]');
            //$this->form_validation->set_rules('email','email','trim|required|xss_clean|is_unique[user.email]');
            $this->form_validation->set_rules('password','password','trim|required|xss_clean|callback_repetirPass');
            $this->form_validation->set_rules('email','email','trim|required|xss_clean|is_unique[user.email]|callback_probando');
            $this->form_validation->set_rules('repetirPassword','repetirPassword','trim|required|xss_clean');


            //validamos que se introduzcan los campos requeridos con la función de ci required
            $this->form_validation->set_message('required', 'El campo %s es obligatorio');
            $this->form_validation->set_message('is_unique', 'El campo %s introducido ya esta registrado en YouTube');

            if (!$this->form_validation->run())
            {
                //si no pasamos la validación volvemos al formulario mostrando los errores
                $this->index();
            }
            //si pasamos la validación correctamente pasamos a hacer la inserción en la base de datos
            else {

                $userName = $this->input->post('userName');   
                $email = $this->input->post('email');       
                $password = $this->input->post('password');   

                //ahora procesamos los datos hacía el modelo que debemos crear
                $nuevo_usuario = $this->registro_m->nueva_cuenta(
                    $userName,
                    $email,
                    $password
                );

                $this->load->helper('url');
                redirect("login", 'refresh');

            }
        }
    }
}
