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
    
//CONEXION
    
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

//**********COMPRAS**********


//**********VENTAS**********


//**********INVENTARIO**********

//**********PRODUCTOS**********
    function insert_producto() {
        $codigo = $this->input->post('codigo');
        $nombre = $this->input->post('nombre');
        $categoria = $this->input->post('categoria');
        $linea = $this->input->post('linea');
        $desc = $this->input->post('desc');
        $stock = $this->input->post('stock');
        $bajo = $this->input->post('bajo');
        $sobre = $this->input->post('sobre');
        $valor = 0;
        $msg = "Producto Ya Registrado";
        if ($this->modelo->insert_producto($codigo, $nombre, $categoria, $linea, $desc, $stock, $bajo, $sobre) == 0) {
            $msg = "Producto Registrado Correctamente";
            $valor = 1;
        }
        echo json_encode(array("valor" => $valor, "msg" => $msg));
    }
//**********LINEAS**********
    
    function cargar_lineas_activas() {
        $datos = $this->modelo->cargar_lineas_activas();
        $data ['cantidad'] = $datos->num_rows();
        $data ['lineas'] = $datos->result();
        $this->load->view('select_lineas', $data);
    }
    
    function insert_linea() {
        $nombre = $this->input->post('nombre');
        $desc = $this->input->post('desc');
        $valor = 0;
        $msg = "Línea Ya Registrada";
        if ($this->modelo->insert_linea($nombre, $desc) == 0) {
            $msg = "Línea Registrada Correctamente";
            $valor = 1;
        }
        echo json_encode(array("valor" => $valor, "msg" => $msg));
    }
//**********CATEGORIAS**********
    
    function cargar_categorias_activas() {
        $datos = $this->modelo->cargar_categorias_activas();
        $data ['cantidad'] = $datos->num_rows();
        $data ['categorias'] = $datos->result();
        $this->load->view('select_categorias', $data);
    }
    
    function insert_categoria() {
        $nombre = $this->input->post('nombre');
        $desc = $this->input->post('desc');
        $valor = 0;
        $msg = "Categoría Ya Registrada";
        if ($this->modelo->insert_categoria($nombre, $desc) == 0) {
            $msg = "Categoría Registrada Correctamente";
            $valor = 1;
        }
        echo json_encode(array("valor" => $valor, "msg" => $msg));
    }
    
//**********REPORTES**********
    
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */