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
        return $this->db->get('producto');
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

    //REPORTES DIARIOS
    
    function diario_dc($fecha) {
        $this->db->select('*');
        $this->db->from('detalle_compra');
        $this->db->join('compra', 'detalle_compra.id_compra = compra.id_compra');
        $this->db->join('producto', 'detalle_compra.codigo_producto = producto.codigo_producto');
        $this->db->join('categoria', 'producto.id_categoria = categoria.id_categoria');
        $this->db->join('linea', 'producto.id_linea = linea.id_linea');
        $this->db->where('compra.fecha_compra', $fecha);
        return $this->db->get();
    }

    function diario_rc($fecha) {
        $this->db->select('*');
        $this->db->select_sum('cantidad', 'productos');
        $this->db->from('compra');
        $this->db->join('detalle_compra', 'compra.id_compra = detalle_compra.id_compra');
        $this->db->where('fecha_compra', $fecha);
        $this->db->group_by('compra.id_compra');
        return $this->db->get();
    }

    function diario_dv($fecha) {
        $this->db->select('*');
        $this->db->from('detalle_venta');
        $this->db->join('venta', 'detalle_venta.id_venta = venta.id_venta');
        $this->db->join('producto', 'detalle_venta.codigo_producto = producto.codigo_producto');
        $this->db->join('categoria', 'producto.id_categoria = categoria.id_categoria');
        $this->db->join('linea', 'producto.id_linea = linea.id_linea');
        $this->db->where('venta.fecha_venta', $fecha);
        return $this->db->get();
    }
    
    function diario_rv($fecha) {
        $this->db->select('*');
        $this->db->select_sum('cantidad', 'productos');
        $this->db->from('venta');
        $this->db->join('detalle_venta', 'venta.id_venta = detalle_venta.id_venta');
        $this->db->where('fecha_venta', $fecha);
        $this->db->group_by('venta.id_venta');
        return $this->db->get();
    }
    
    function diario_pc($fecha) {
        $this->db->select('*');
        $this->db->select_sum('cantidad', 'productos');
        $this->db->from('producto');
        $this->db->join('detalle_compra', 'producto.codigo_producto = detalle_compra.codigo_producto');
        $this->db->join('compra', 'detalle_compra.id_compra = compra.id_compra');
        $this->db->join('categoria', 'producto.id_categoria = categoria.id_categoria');
        $this->db->join('linea', 'producto.id_linea = linea.id_linea');
        $this->db->where('compra.fecha_compra', $fecha);
        $this->db->group_by('producto.codigo_producto');
        return $this->db->get();
    }
    
    function diario_pv($fecha) {
        $this->db->select('*');
        $this->db->select_sum('cantidad', 'productos');
        $this->db->from('producto');
        $this->db->join('detalle_venta', 'producto.codigo_producto = detalle_venta.codigo_producto');
        $this->db->join('venta', 'detalle_venta.id_venta = venta.id_venta');
        $this->db->join('categoria', 'producto.id_categoria = categoria.id_categoria');
        $this->db->join('linea', 'producto.id_linea = linea.id_linea');
        $this->db->where('venta.fecha_venta', $fecha);
        $this->db->group_by('producto.codigo_producto');
        return $this->db->get();
    }
    
    //REPORTES MENSUALES
    
    function mensual_rc($mes, $ano) {
        $this->db->select('*');
        $this->db->select_sum('cantidad', 'productos');
        $this->db->from('compra');
        $this->db->join('detalle_compra', 'compra.id_compra = detalle_compra.id_compra');
        $this->db->where('MONTH(fecha_compra)', $mes);
        $this->db->where('YEAR(fecha_compra)', $ano);
        $this->db->group_by('compra.id_compra');
        return $this->db->get();
    }
    
    function mensual_rv($mes, $ano) {
        $this->db->select('*');
        $this->db->select_sum('cantidad', 'productos');
        $this->db->from('venta');
        $this->db->join('detalle_venta', 'venta.id_venta = detalle_venta.id_venta');
        $this->db->where('MONTH(fecha_venta)', $mes);
        $this->db->where('YEAR(fecha_venta)', $ano);
        $this->db->group_by('venta.id_venta');
        return $this->db->get();
    }
    
    function mensual_pc($mes, $ano) {
        $this->db->select('*');
        $this->db->select_sum('cantidad', 'productos');
        $this->db->from('producto');
        $this->db->join('detalle_compra', 'producto.codigo_producto = detalle_compra.codigo_producto');
        $this->db->join('compra', 'detalle_compra.id_compra = compra.id_compra');
        $this->db->join('categoria', 'producto.id_categoria = categoria.id_categoria');
        $this->db->join('linea', 'producto.id_linea = linea.id_linea');
        $this->db->where('MONTH(fecha_compra)', $mes);
        $this->db->where('YEAR(fecha_compra)', $ano);
        $this->db->group_by('producto.codigo_producto');
        return $this->db->get();
    }
    
    function mensual_pv($mes, $ano) {
        $this->db->select('*');
        $this->db->select_sum('cantidad', 'productos');
        $this->db->from('producto');
        $this->db->join('detalle_venta', 'producto.codigo_producto = detalle_venta.codigo_producto');
        $this->db->join('venta', 'detalle_venta.id_venta = venta.id_venta');
        $this->db->join('categoria', 'producto.id_categoria = categoria.id_categoria');
        $this->db->join('linea', 'producto.id_linea = linea.id_linea');
        $this->db->where('MONTH(fecha_venta)', $mes);
        $this->db->where('YEAR(fecha_venta)', $ano);
        $this->db->group_by('producto.codigo_producto');
        return $this->db->get();
    }
    
    //REPORTES SEMANALES
    
    //REPORTES ANUALES
    
    function anual_rc($ano) {
        $this->db->select('*');
        $this->db->select_sum('cantidad', 'productos');
        $this->db->from('compra');
        $this->db->join('detalle_compra', 'compra.id_compra = detalle_compra.id_compra');
        $this->db->where('YEAR(fecha_compra)', $ano);
        $this->db->group_by('compra.id_compra');
        return $this->db->get();
    }
    
    function anual_rv($ano) {
        $this->db->select('*');
        $this->db->select_sum('cantidad', 'productos');
        $this->db->from('venta');
        $this->db->join('detalle_venta', 'venta.id_venta = detalle_venta.id_venta');
        $this->db->where('YEAR(fecha_venta)', $ano);
        $this->db->group_by('venta.id_venta');
        return $this->db->get();
    }
    
    function anual_pc($ano) {
        $this->db->select('*');
        $this->db->select_sum('cantidad', 'productos');
        $this->db->from('producto');
        $this->db->join('detalle_compra', 'producto.codigo_producto = detalle_compra.codigo_producto');
        $this->db->join('compra', 'detalle_compra.id_compra = compra.id_compra');
        $this->db->join('categoria', 'producto.id_categoria = categoria.id_categoria');
        $this->db->join('linea', 'producto.id_linea = linea.id_linea');
        $this->db->where('YEAR(fecha_compra)', $ano);
        $this->db->group_by('producto.codigo_producto');
        return $this->db->get();
    }
    
    function anual_pv($ano) {
        $this->db->select('*');
        $this->db->select_sum('cantidad', 'productos');
        $this->db->from('producto');
        $this->db->join('detalle_venta', 'producto.codigo_producto = detalle_venta.codigo_producto');
        $this->db->join('venta', 'detalle_venta.id_venta = venta.id_venta');
        $this->db->join('categoria', 'producto.id_categoria = categoria.id_categoria');
        $this->db->join('linea', 'producto.id_linea = linea.id_linea');
        $this->db->where('YEAR(fecha_venta)', $ano);
        $this->db->group_by('producto.codigo_producto');
        return $this->db->get();
    }
    
    //REPORTES STOCK
    
    function r_bajo() {
        $this->db->select('*');
        $this->db->from('producto');
        $this->db->join('categoria', 'producto.id_categoria = categoria.id_categoria');
        $this->db->join('linea', 'producto.id_linea = linea.id_linea');
        $this->db->where('bajo_stock !=', 0);
        $this->db->where('bajo_stock > stock_producto');
        return $this->db->get();
    }
    
    function r_sobre() {
        $this->db->select('*');
        $this->db->from('producto');
        $this->db->join('categoria', 'producto.id_categoria = categoria.id_categoria');
        $this->db->join('linea', 'producto.id_linea = linea.id_linea');
        $this->db->where('sobre_stock !=', 0);
        $this->db->where('sobre_stock < stock_producto');
        return $this->db->get();
    }
    
}
