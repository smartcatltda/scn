<?php

class modelo extends CI_Model {

//CONEXION
    function conectar($user, $pass) {
        $this->db->select('*');
        $this->db->where('user', $user);
        $this->db->where('pass', ($pass));
        return $this->db->get('usuario')->num_rows();
    }

//**********COMPRAS**********
//**********VENTAS**********
//**********INVENTARIO**********
//**********PRODUCTOS**********
    
    function insert_producto($codigo, $nombre, $categoria, $linea, $desc, $stock, $bajo, $sobre) {
        $this->db->select('codigo_producto');
        $this->db->where('codigo_producto', $codigo);
        $cantidad = $this->db->get('producto')->num_rows();
        if ($cantidad == 0):
            $data = array(
                "codigo_producto" => $codigo,
                "nombre_producto" => $nombre,
                "id_categoria" => $categoria,
                "id_linea" => $linea,
                "descripcion_producto" => $desc,
                "stock_producto" => $stock,
                "bajo_stock" => $bajo,
                "sobre_stock" => $sobre,
            );
            $this->db->insert("producto", $data);
            return 0;
        else:
            return 1;
        endif;
    }
    
//**********LINEAS**********
    
    function cargar_lineas_activas() {
        $this->db->select('*');
        $this->db->from('linea');
        return $this->db->get();
    }
    
    function insert_linea($nombre, $desc) {
        $this->db->select('nombre_linea');
        $this->db->where('nombre_linea', $nombre);
        $cantidad = $this->db->get('linea')->num_rows();
        if ($cantidad == 0):
            $data = array(
                "nombre_linea" => $nombre,
                "descripcion_linea" => $desc,
            );
            $this->db->insert("linea", $data);
            return 0;
        else:
            return 1;
        endif;
    }

//**********CATEGORIAS**********
    
    function cargar_categorias_activas() {
        $this->db->select('*');
        $this->db->from('categoria');
        return $this->db->get();
    }
    
    function insert_categoria($nombre, $desc) {
        $this->db->select('nombre_categoria');
        $this->db->where('nombre_categoria', $nombre);
        $cantidad = $this->db->get('categoria')->num_rows();
        if ($cantidad == 0):
            $data = array(
                "nombre_categoria" => $nombre,
                "descripcion_categoria" => $desc,
            );
            $this->db->insert("categoria", $data);
            return 0;
        else:
            return 1;
        endif;
    }
//**********REPORTES**********
}
