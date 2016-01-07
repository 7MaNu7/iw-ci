<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class registro extends CI_Controller {

    //Incluir modelo para controller aquí o en tiempo de construccion si se usa mucho
    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model("registro_m", '', TRUE);
    }

    //Por defecto, si no ay index error
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();

        //Si estamos logeados nos echaran de esta pagina
        if(!isset($_SESSION['id']))
        {
            //si no se ha llegado a definir la variable que nos indica el borrado de los input
            //o si queremos que se borren (true) entonces mostramos form vacio
             if((!isset($_SESSION['clean'])) || $_SESSION["clean"] == true )
            {
                unset($_SESSION["nombre"]);
                unset($_SESSION["email"]);
            }
        }

        $data['usuarios']=$this->registro_m->get_all();
        $data['cuantos']=$this->registro_m->count_all();
        $data['css_files'] = [base_url("assets/css/cabecera.css"), base_url("assets/css/registro.css")];
        $data['js_files'] = [base_url("assets/js/cabecera.js"), base_url("assets/js/validacion-registro.js")];
        $data['titulo']="Registrarse";
        $data['page_title'] = 'Registrarse';
        $this->load->view('youtube/registro', $data);
    }


    public function patronEmail($email)
    {
       //PATRON:
       //empezar por caracter minus o mayus
       //minimo 2 caracteres antes del @, despues del primero ya se admiten numeros, guiones, puntos y guiones bajos
       //lo siguiente es el @
       //minimo dos cletras despues del @, permitiendo por medio un punto mas, con 0-6 letras (Ejemplo @alu.ua.es tiene un punto mas)
       //despues va el punto que si es obligatorio, y despues del punto de 2 a 6 letras
       $pattern = "/^[a-zA-Z][a-zA-Z0-9._-]+@[a-zA-Z][a-zA-Z.]{0,6}[a-zA-Z]\.[a-zA-Z]{2,6}$/";
       if(preg_match($pattern, $email)) {
            return TRUE;
       }
       else
       {
            $this->form_validation->set_message('patronEmail',
                'El campo %s debe seguir el formato correcto, aqui un ejemplo con caracteres permitidos: Aa1_-.@ejemplo.com');
            return FALSE;
       }
    }

    public function patronPass($password)
    {

        if(strlen($password)<8 || strlen($password)>16)
        {
            $this->form_validation->set_message('patronPass', 'El campo %s debe tener entre 8 y 16 caracteres');
            return FALSE;
        }
        else
        {

            // There is one upper and one lower
            if(preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password)){

                if(preg_match('/[0-9]/', $password))
                {
                    return TRUE;
                }
                else
                {
                     $this->form_validation->set_message('patronPass', 'El campo %s debe contener al menos un numero');
                     return FALSE;
                }
            }
            else
            {
                 $this->form_validation->set_message('patronPass', 'El campo %s debe contener letras mayusculas y minusculas (al menos una)');
                 return FALSE;
            }

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
            $this->form_validation->set_rules('userName','userName','trim|required|is_unique[user.userName]');
            //$this->form_validation->set_rules('email','email','trim|required|xss_clean|is_unique[user.email]');
            $this->form_validation->set_rules('password','password','trim|required|callback_patronPass|callback_repetirPass|xss_clean');
            $this->form_validation->set_rules('email','email','trim|required|is_unique[user.email]|callback_patronEmail');
            $this->form_validation->set_rules('repetirPassword','repetirPassword','trim|required|xss_clean');


            //validamos que se introduzcan los campos requeridos con la función de ci required
            $this->form_validation->set_message('required', 'El campo %s es obligatorio');
            $this->form_validation->set_message('is_unique', 'El campo %s introducido ya esta registrado en YouTube');


             if (session_status() == PHP_SESSION_NONE)
                    session_start();

            if (!$this->form_validation->run())
            {
                //Como hay error en el formulario no queremos limpiar los input (SALVO PASSWORD)
                $_SESSION["nombre"] = $this->input->post('userName');
                $_SESSION["email"] = $this->input->post('email');
                $_SESSION["clean"] = false;

                //si no pasamos la validación volvemos al formulario mostrando los errores y sin borrar inputs
                $this->index();

                //Para futuras navegaciones si que se borran los input
                $_SESSION["clean"] = true;

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
