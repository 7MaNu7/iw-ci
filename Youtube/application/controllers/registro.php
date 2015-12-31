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
        $data['css_files'] = ["assets/css/cabecera.css", "assets/css/subirvideo.css"];
        $data['js_files'] = ["assets/js/cabecera.js"];
        $data['titulo']="Registrarse";
        $this->load->view('youtube/registro', $data);
    }
    
}
