<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class controlador extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("modelo");
    }

    public function index() {
        $this->load->view('header');
        $this->load->view('content');
        $this->load->view('footer');
    }

    function conectar() {
        $user = $this->input->post('user');
        $pass = md5($this->input->post('pass'));
        $valor = 0;
        $mensaje = "Usuario o Contraseña Incorrectos";
        $cookie = array('conectado' => false);
        if ($this->modelo->conectar($user, $pass) == 1) {
            $valor = 1;
            $cookie = array('conectado' => true);
            $this->session->set_userdata($cookie);
        }
        echo json_encode(array('valor' => $valor, 'mensaje' => $mensaje));
    }

    function verificalogin() {
        $valor = 0;
        if ($this->session->userdata('conectado') == true) {
            $valor = 1;
        }
        echo json_encode(array('valor' => $valor));
    }

    function salir() {
        $valor = 0;
        $cookie = array('conectado' => false);
        $this->session->set_userdata($cookie);
        echo json_encode(array('valor' => $valor));
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */