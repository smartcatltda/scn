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
    function crear_compra($fecha, $hora) {
        $data = array(
            "fecha_compra" => $fecha,
            "hora_compra" => $hora,
        );
        $this->db->insert("compra", $data);
        $this->db->select('*');
        $this->db->from('compra');
        $this->db->order_by('id_compra', 'DESC');
        $this->db->limit(1);
        return $this->db->get();
    }

    function insert_datalle_compra($codigo, $cantidad, $num_compra) {
        $data = array(
            "codigo_producto" => $codigo,
            "cantidad" => $cantidad,
            "id_compra" => $num_compra,
        );
        $this->db->insert("detalle_compra", $data);
    }

    function update_stock($codigo, $nuevo_stock) {
        $data = array(
            "stock_producto" => $nuevo_stock,
        );
        $this->db->where('codigo_producto', $codigo);
        $this->db->update('producto', $data);
    }

    function cargar_compras($num_compra) {
        $this->db->select('*');
        $this->db->where('id_compra', $num_compra);
        $this->db->from('detalle_compra');
        $this->db->join('producto', 'detalle_compra.codigo_producto = producto.codigo_producto');
        $this->db->join('categoria', 'producto.id_categoria = categoria.id_categoria');
        $this->db->join('linea', 'producto.id_linea = linea.id_linea');
        return $this->db->get();
    }

    function eliminar_compra($id) {
        $this->db->where('id_detalle_compra', $id);
        $this->db->delete('detalle_compra');
        return 0;
    }

//**********VENTAS**********
//**********PRODUCTOS**********
    function cargar_productos() {
        $this->db->select('*');
        $this->db->from('producto');
        $this->db->join('categoria', 'producto.id_categoria = categoria.id_categoria');
        $this->db->join('linea', 'producto.id_linea = linea.id_linea');
        return $this->db->get();
    }

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

    function update_producto($codigo, $nombre, $categoria, $linea, $descripcion, $bajo_stock, $stock, $sobre_stock) {
        $data = array(
            "codigo_producto" => $codigo,
            "nombre_producto" => $nombre,
            "id_categoria" => $categoria,
            "id_linea" => $linea,
            "descripcion_producto" => $descripcion,
            "stock_producto" => $stock,
            "bajo_stock" => $bajo_stock,
            "sobre_stock" => $sobre_stock,
        );
        $this->db->where('codigo_producto', $codigo);
        $this->db->update('producto', $data);
        return 0;
    }

    function seleccionar_producto($codigo) {
        $this->db->select('*');
        $this->db->where('codigo_producto', $codigo);
        $this->db->from('producto');
        $this->db->join('categoria', 'producto.id_categoria = categoria.id_categoria');
        $this->db->join('linea', 'producto.id_linea = linea.id_linea');
        return $this->db->get();
    }

    function eliminar_producto($codigo) {
        $data = array(
            "estado_producto" => '1',
        );
        $this->db->where('codigo_producto', $codigo);
        $this->db->update('producto', $data);
        return 0;
    }

    function activar_producto($codigo) {
        $data = array(
            "estado_producto" => '0',
        );
        $this->db->where('codigo_producto', $codigo);
        $this->db->update('producto', $data);
        return 0;
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

    function update_linea($id, $nombre, $descripcion) {
        $data = array(
            "nombre_linea" => $nombre,
            "descripcion_linea" => $descripcion,
        );
        $this->db->where('id_linea', $id);
        $this->db->update('linea', $data);
        return 0;
    }

    function seleccionar_linea($id) {
        $this->db->select('*');
        $this->db->where('id_linea', $id);
        return $this->db->get('linea');
    }

    function eliminar_linea($id) {
        $data = array(
            "estado_linea" => '1',
        );
        $this->db->where('id_linea', $id);
        $this->db->update('linea', $data);
        return 0;
    }

    function activar_linea($id) {
        $data = array(
            "estado_linea" => '0',
        );
        $this->db->where('id_linea', $id);
        $this->db->update('linea', $data);
        return 0;
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

    function update_categoria($id, $nombre, $descripcion) {
        $data = array(
            "nombre_categoria" => $nombre,
            "descripcion_categoria" => $descripcion,
        );
        $this->db->where('id_categoria', $id);
        $this->db->update('categoria', $data);
        return 0;
    }

    function seleccionar_categoria($id) {
        $this->db->select('*');
        $this->db->where('id_categoria', $id);
        return $this->db->get('categoria');
    }

    function eliminar_categoria($id) {
        $data = array(
            "estado_categoria" => '1',
        );
        $this->db->where('id_categoria', $id);
        $this->db->update('categoria', $data);
        return 0;
    }

    function activar_categoria($id) {
        $data = array(
            "estado_categoria" => '0',
        );
        $this->db->where('id_categoria', $id);
        $this->db->update('categoria', $data);
        return 0;
    }

//**********REPORTES**********
}
