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
    function crear_venta() {
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $fecha = date('Y-m-d');
        $hora = date("H:i:s");
        $datos = $this->modelo->crear_venta($fecha, $hora)->result();
        foreach ($datos as $fila) {
            $id_venta = $fila->id_venta;
        }
        echo json_encode(array("id" => $id_venta));
    }

    function cargar_ventas() {
        $num_venta = $this->input->post('num_venta');
        $datos = $this->modelo->cargar_ventas($num_venta);
        $data ['ventas'] = $datos->result();
        $this->load->view("lista_venta", $data);
    }

    function cargar_venta() {
        $codigo = $this->input->post('codigo');
        $cantidad = $this->input->post('cantidad');
        $num_venta = $this->input->post('num_venta');
        $stock = 0;
        $dato = $this->modelo->seleccionar_producto($codigo)->result();
        foreach ($dato as $fila) {
            $stock = $fila->stock_producto;
        }
        $nuevo_stock = $stock - $cantidad;
        if ($nuevo_stock >= 0) {
            $this->modelo->insert_datalle_venta($codigo, $cantidad, $num_venta);
        }
        $datos = $this->modelo->cargar_ventas($num_venta);
        $data ['ventas'] = $datos->result();
        $this->load->view("lista_venta", $data);
    }

    function actualizar_stock() {
        $codigo = $this->input->post('codigo');
        $cantidad = $this->input->post('cantidad');
        $valor = 0;
        $bajo_stock = 0;
        $stock = 0;
        $diferencia = 0;
        $dato = $this->modelo->seleccionar_producto($codigo)->result();
        foreach ($dato as $fila) {
            $stock = $fila->stock_producto;
            $bajo_stock = $fila->bajo_stock;
        }
        $nuevo_stock = $stock - $cantidad;
        if ($nuevo_stock >= 0) {
            $this->modelo->update_stock($codigo, $nuevo_stock);
            if ($bajo_stock > $nuevo_stock) {
                $diferencia = $nuevo_stock - $bajo_stock;
                $valor = 1;
            }
        } else {
            $valor = 2;
        }

        echo json_encode(array("valor" => $valor, "diferencia" => $diferencia));
    }

    function eliminar_venta() {
        $id = $this->input->post('id');
        $codigo = $this->input->post('codigo');
        $cantidad = $this->input->post('cantidad');
        $stock = 0;
        $valor = 0;
        $dato = $this->modelo->seleccionar_producto($codigo)->result();
        foreach ($dato as $fila) {
            $stock = $fila->stock_producto;
        }
        $nuevo_stock = $stock + $cantidad;
        $this->modelo->update_stock($codigo, $nuevo_stock);
        if ($this->modelo->eliminar_venta($id) == 0) {
            $valor = 1;
        }
        echo json_encode(array("valor" => $valor));
    }

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
        $id = $this->input->post('id');
        $codigo = $this->input->post('codigo');
        $nombre = $this->input->post('nombre');
        $categoria = $this->input->post('categoria');
        $linea = $this->input->post('linea');
        $descripcion = $this->input->post('descripcion');
        $bajo_stock = $this->input->post('bajo_stock');
        $stock = $this->input->post('stock');
        $sobre_stock = $this->input->post('sobre_stock');

        if ($this->modelo->update_producto($id, $codigo, $nombre, $categoria, $linea, $descripcion, $bajo_stock, $stock, $sobre_stock) == 0) {
            $valor = 0;
        }
        echo json_encode(array("valor" => $valor));
    }

    function seleccionar_producto() {
        $codigo = $this->input->post('codigo');
        $valor = 0;
        $datos = $this->modelo->seleccionar_producto($codigo)->result();
        $cont = $this->modelo->seleccionar_producto($codigo)->num_rows();
        if ($cont > 0) {
            $valor = 1;
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
            echo json_encode(array("valor" => $valor, "codigo" => $codigo_producto, "nombre" => $nombre, "descripcion" => $descripcion,
                "categoria" => $categoria, "linea" => $linea, "bajo_stock" => $bajo_stock, "stock" => $stock,
                "sobre_stock" => $sobre_stock, "nombre_linea" => $nombre_linea, "nombre_categoria" => $nombre_categoria));
        } else {
            echo json_encode(array("valor" => $valor));
        }
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

    function reporte_diario() {
        $tipo = $this->input->post('tipo');
        $fecha = $this->input->post('fecha');
        if ($tipo == "dc") {
            $datos["diario_dc"] = $this->modelo->diario_dc($fecha)->result();
            $datos["cantidad"] = $this->modelo->diario_dc($fecha)->num_rows();
            $this->load->view("r_detalle_compras", $datos);
        } else {
            if ($tipo == "dv") {
                $datos["diario_dv"] = $this->modelo->diario_dv($fecha)->result();
                $datos["cantidad"] = $this->modelo->diario_dv($fecha)->num_rows();
                $this->load->view("r_detalle_ventas", $datos);
            } else {
                if ($tipo == "rc") {
                    $datos["diario_rc"] = $this->modelo->diario_rc($fecha)->result();
                    $datos["cantidad"] = $this->modelo->diario_rc($fecha)->num_rows();
                    $this->load->view("r_resumen_compras", $datos);
                } else {
                    if ($tipo == "rv") {
                        $datos["diario_rv"] = $this->modelo->diario_rv($fecha)->result();
                        $datos["cantidad"] = $this->modelo->diario_rv($fecha)->num_rows();
                        $this->load->view("r_resumen_ventas", $datos);
                    } else {
                        if ($tipo == "pc") {
                            $datos["diario_pc"] = $this->modelo->diario_pc($fecha)->result();
                            $datos["cantidad"] = $this->modelo->diario_pc($fecha)->num_rows();
                            $this->load->view("r_productos_comprados", $datos);
                        } else {
                            $datos["diario_pv"] = $this->modelo->diario_pv($fecha)->result();
                            $datos["cantidad"] = $this->modelo->diario_pv($fecha)->num_rows();
                            $this->load->view("r_productos_vendidos", $datos);
                        }
                    }
                }
            }
        }
    }

    function reporte_mensual() {
        $tipo = $this->input->post('tipo');
        $fecha = $this->input->post('fecha');
        list($ano, $mes, $dia) = explode("/", $fecha);


        if ($tipo == "rc") {
            $datos["mensual_rc"] = $this->modelo->mensual_rc($mes, $ano)->result();
            $datos["cantidad"] = $this->modelo->mensual_rc($mes, $ano)->num_rows();
            $this->load->view("r_resumen_compras", $datos);
        } else {
            if ($tipo == "rv") {
                $datos["mensual_rv"] = $this->modelo->mensual_rv($mes, $ano)->result();
                $datos["cantidad"] = $this->modelo->mensual_rv($mes, $ano)->num_rows();
                $this->load->view("r_resumen_ventas", $datos);
            } else {
                if ($tipo == "pc") {
                    $datos["mensual_pc"] = $this->modelo->mensual_pc($mes, $ano)->result();
                    $datos["cantidad"] = $this->modelo->mensual_pc($mes, $ano)->num_rows();
                    $this->load->view("r_productos_comprados", $datos);
                } else {
                    $datos["mensual_pv"] = $this->modelo->mensual_pv($mes, $ano)->result();
                    $datos["cantidad"] = $this->modelo->mensual_pv($mes, $ano)->num_rows();
                    $this->load->view("r_productos_vendidos", $datos);
                }
            }
        }
    }

    function reporte_anual() {
        $tipo = $this->input->post('tipo');
        $fecha = $this->input->post('fecha');
        list($ano, $mes, $dia) = explode("/", $fecha);

        if ($tipo == "rc") {
            $datos["anual_rc"] = $this->modelo->anual_rc($ano)->result();
            $datos["cantidad"] = $this->modelo->anual_rc($ano)->num_rows();
            $this->load->view("r_resumen_compras", $datos);
        } else {
            if ($tipo == "rv") {
                $datos["anual_rv"] = $this->modelo->anual_rv($ano)->result();
                $datos["cantidad"] = $this->modelo->anual_rv($ano)->num_rows();
                $this->load->view("r_resumen_ventas", $datos);
            } else {
                if ($tipo == "pc") {
                    $datos["anual_pc"] = $this->modelo->anual_pc($ano)->result();
                    $datos["cantidad"] = $this->modelo->anual_pc($ano)->num_rows();
                    $this->load->view("r_productos_comprados", $datos);
                } else {
                    $datos["anual_pv"] = $this->modelo->anual_pv($ano)->result();
                    $datos["cantidad"] = $this->modelo->anual_pv($ano)->num_rows();
                    $this->load->view("r_productos_vendidos", $datos);
                }
            }
        }
    }

    function reporte_bajo() {
        $datos["r_bajo"] = $this->modelo->r_bajo()->result();
        $datos["cantidad"] = $this->modelo->r_bajo()->num_rows();
        $this->load->view("r_alertas_stock", $datos);
    }

    function reporte_sobre() {
        $datos["r_sobre"] = $this->modelo->r_sobre()->result();
        $datos["cantidad"] = $this->modelo->r_sobre()->num_rows();
        $this->load->view("r_alertas_stock", $datos);
    }

//    function reporte_semanal() {
//        $tipo = $this->input->post('tipo');
//        $fecha = $this->input->post('fecha');
//
//        if ($tipo == "rc") {
//            $datos["semanal_rc"] = $this->modelo->semanal_rc()->result();
//            $datos["cantidad"] = $this->modelo->semanal_rc()->num_rows();
//            $this->load->view("r_resumen_compras", $datos);
//        } else {
//            if ($tipo == "rv") {
//                $datos["semanal_rv"] = $this->modelo->semanal_rv($fecha)->result();
//                $datos["cantidad"] = $this->modelo->semanal_rv($fecha)->num_rows();
//                $this->load->view("r_resumen_ventas", $datos);
//            } else {
//                if ($tipo == "pc") {
//                    $datos["semanal_pc"] = $this->modelo->semanal_pc($fecha)->result();
//                    $datos["cantidad"] = $this->modelo->semanal_pc($fecha)->num_rows();
//                    $this->load->view("r_productos_comprados", $datos);
//                } else {
//                    $datos["semanal_pv"] = $this->modelo->semanal_pv($fecha)->result();
//                    $datos["cantidad"] = $this->modelo->semanal_pv($fecha)->num_rows();
//                    $this->load->view("r_productos_vendidos", $datos);
//                }
//            }
//        }
//    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
