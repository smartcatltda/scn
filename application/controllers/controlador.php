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
    function crear_compra() {
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $fecha = date('Y-m-d');
        $hora = date("H:i:s");
        $datos = $this->modelo->crear_compra($fecha, $hora)->result();
        foreach ($datos as $fila) {
            $id_compra = $fila->id_compra;
        }
        echo json_encode(array("id" => $id_compra));
    }

    function cargar_compra() {
        $codigo = $this->input->post('codigo');
        $cantidad = $this->input->post('cantidad');
        $num_compra = $this->input->post('num_compra');
        $this->modelo->insert_datalle_compra($codigo, $cantidad, $num_compra);
        $datos = $this->modelo->cargar_compras($num_compra);
        $data ['compras'] = $datos->result();
        $this->load->view("lista_compra", $data);
    }

    function update_stock() {
        $codigo = $this->input->post('codigo');
        $cantidad = $this->input->post('cantidad');
        $valor = 0;
        $sobre_stock = 0;
        $stock = 0;
        $diferencia = 0;
        $dato = $this->modelo->seleccionar_producto($codigo)->result();
        foreach ($dato as $fila) {
            $stock = $fila->stock_producto;
            $sobre_stock = $fila->sobre_stock;
        }
        $nuevo_stock = $stock + $cantidad;
        $this->modelo->update_stock($codigo, $nuevo_stock);
        if ($sobre_stock < $nuevo_stock) {
            $diferencia = $nuevo_stock - $sobre_stock;
            $valor = 1;
        }
        echo json_encode(array("valor" => $valor, "diferencia" => $diferencia));
    }

    function eliminar_compra() {
        $id = $this->input->post('id');
        $codigo = $this->input->post('codigo');
        $cantidad = $this->input->post('cantidad');
        $stock = 0;
        $valor = 0;
        $dato = $this->modelo->seleccionar_producto($codigo)->result();
        foreach ($dato as $fila) {
            $stock = $fila->stock_producto;
        }
        $nuevo_stock = $stock - $cantidad;
        $this->modelo->update_stock($codigo, $nuevo_stock);
        if ($this->modelo->eliminar_compra($id) == 0) {
            $valor = 1;
        }
        echo json_encode(array("valor" => $valor));
    }

    function cargar_compras() {
        $num_compra = $this->input->post('num_compra');
        $datos = $this->modelo->cargar_compras($num_compra);
        $data ['compras'] = $datos->result();
        $this->load->view("lista_compra", $data);
    }

//**********VENTAS**********
//**********PRODUCTOS**********

    function cargar_productos() {
        $datos = $this->modelo->cargar_productos();
        $data ['cantidad'] = $datos->num_rows();
        $data ['productos'] = $datos->result();
        $this->load->view("lista_productos", $data);
    }

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

    function update_producto() {
        $codigo = $this->input->post('codigo');
        $nombre = $this->input->post('nombre');
        $categoria = $this->input->post('categoria');
        $linea = $this->input->post('linea');
        $descripcion = $this->input->post('descripcion');
        $bajo_stock = $this->input->post('bajo_stock');
        $stock = $this->input->post('stock');
        $sobre_stock = $this->input->post('sobre_stock');

        if ($this->modelo->update_producto($codigo, $nombre, $categoria, $linea, $descripcion, $bajo_stock, $stock, $sobre_stock) == 0) {
            $valor = 0;
        }
        echo json_encode(array("valor" => $valor));
    }

    function seleccionar_producto() {
        $codigo = $this->input->post('codigo');
        $datos = $this->modelo->seleccionar_producto($codigo)->result();
        foreach ($datos as $fila) {
            $codigo_producto = $fila->codigo_producto;
            $nombre = $fila->nombre_producto;
            $categoria = $fila->id_categoria;
            $linea = $fila->id_linea;
            $descripcion = $fila->descripcion_producto;
            $bajo_stock = $fila->bajo_stock;
            $stock = $fila->stock_producto;
            $sobre_stock = $fila->sobre_stock;
            $nombre_categoria = $fila->nombre_categoria;
            $nombre_linea = $fila->nombre_linea;
        }
        echo json_encode(array("codigo" => $codigo_producto, "nombre" => $nombre, "descripcion" => $descripcion,
            "categoria" => $categoria, "linea" => $linea, "bajo_stock" => $bajo_stock, "stock" => $stock, "sobre_stock" => $sobre_stock, "nombre_linea" => $nombre_linea, "nombre_categoria" => $nombre_categoria));
    }

    function estado_producto() {
        $codigo = $this->input->post('codigo');
        $estado = $this->input->post('estado');
        if ($estado == 0) {
            if ($this->modelo->eliminar_producto($codigo) == 0) {
                $msj = "Producto Eliminado";
            }
        } else {
            if ($this->modelo->activar_producto($codigo) == 0) {
                $msj = "Producto Activado";
            }
        }
        echo json_encode(array("msj" => $msj));
    }

//**********LINEAS**********

    function cargar_lineas_activas() {
        $datos = $this->modelo->cargar_lineas_activas();
        $data ['cantidad'] = $datos->num_rows();
        $data ['lineas'] = $datos->result();
        $this->load->view('select_lineas', $data);
    }

    function cargar_lineas() {
        $datos = $this->modelo->cargar_lineas_activas();
        $data ['cantidad'] = $datos->num_rows();
        $data ['lineas'] = $datos->result();
        $this->load->view("lista_lineas", $data);
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

    function update_linea() {
        $id = $this->input->post('id');
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        if ($this->modelo->update_linea($id, $nombre, $descripcion) == 0) {
            $valor = 0;
        }
        echo json_encode(array("valor" => $valor));
    }

    function seleccionar_linea() {
        $id = $this->input->post('id');
        $datos = $this->modelo->seleccionar_linea($id)->result();
        foreach ($datos as $fila) {
            $id_categoria = $fila->id_linea;
            $nombre_categoria = $fila->nombre_linea;
            $descripcion_categoria = $fila->descripcion_linea;
        }
        echo json_encode(array("id" => $id_categoria, "nombre" => $nombre_categoria, "descripcion" => $descripcion_categoria));
    }

    function estado_linea() {
        $id = $this->input->post('id');
        $estado = $this->input->post('estado');
        if ($estado == 0) {
            if ($this->modelo->eliminar_linea($id) == 0) {
                $msj = "Linea Eliminada";
            }
        } else {
            if ($this->modelo->activar_linea($id) == 0) {
                $msj = "Linea Activada";
            }
        }
        echo json_encode(array("msj" => $msj));
    }

//**********CATEGORIAS**********

    function cargar_categorias_activas() {
        $datos = $this->modelo->cargar_categorias_activas();
        $data ['cantidad'] = $datos->num_rows();
        $data ['categorias'] = $datos->result();
        $this->load->view('select_categorias', $data);
    }

    function cargar_categorias() {
        $datos = $this->modelo->cargar_categorias_activas();
        $data ['cantidad'] = $datos->num_rows();
        $data ['categorias'] = $datos->result();
        $this->load->view("lista_categorias", $data);
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

    function update_categoria() {
        $id = $this->input->post('id');
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        if ($this->modelo->update_categoria($id, $nombre, $descripcion) == 0) {
            $valor = 0;
        }
        echo json_encode(array("valor" => $valor));
    }

    function seleccionar_categoria() {
        $id = $this->input->post('id');
        $datos = $this->modelo->seleccionar_categoria($id)->result();
        foreach ($datos as $fila) {
            $id_categoria = $fila->id_categoria;
            $nombre_categoria = $fila->nombre_categoria;
            $descripcion_categoria = $fila->descripcion_categoria;
        }
        echo json_encode(array("id" => $id_categoria, "nombre" => $nombre_categoria, "descripcion" => $descripcion_categoria));
    }

    function estado_categoria() {
        $id = $this->input->post('id');
        $estado = $this->input->post('estado');
        if ($estado == 0) {
            if ($this->modelo->eliminar_categoria($id) == 0) {
                $msj = "Categoria Eliminada";
            }
        } else {
            if ($this->modelo->activar_categoria($id) == 0) {
                $msj = "Categoria Activada";
            }
        }
        echo json_encode(array("msj" => $msj));
    }

//**********REPORTES**********
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */