<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  public function crear( $id_proveedor, $nombre, $precio, $id_categoria, $descripcion ) {
    // Sanitizar datos
    $id_proveedor = intval( $id_proveedor );
    $nombre = htmlentities( $nombre );
    $precio = floatval( $precio );
    $id_categoria = intval( $id_categoria );
    $descripcion = htmlentities( $descripcion );

    $data = array(
      'id_proveedor' => $id_proveedor,
      'nombre_producto' => $nombre,
      'precio' => $precio,
      'id_categoria' => $id_categoria,
      'descripcion' => $descripcion
    );
  }

  public function leer( $id ) {
    // Sanitizar datos
    $id = intval( $id );

    $this->db->where('id_producto', $id);
    $this->db->get('productos');
    return $this->db->get('productos')->result_array();
  }

  public function actualizar( $id, $id_proveedor, $nombre, $precio, $id_categoria, $descripcion ) {
    // Sanitizar datos
    $id = intval( $id );
    $id_proveedor = intval( $id_proveedor );
    $nombre = htmlentities( $nombre );
    $precio = floatval( $precio );
    $id_categoria = intval( $id_categoria );
    $descripcion = htmlentities( $descripcion );

    $data = array(
      'id_proveedor' => $id_proveedor,
      'nombre_producto' => $nombre,
      'precio' => $precio,
      'id_categoria' => $id_categoria,
      'descripcion' => $descripcion
    );

    // Ejecutar consulta
		$this->db->where( 'id_producto', $id );
		$this->db->update( 'productos', $data );
		return boolval( $this->db->affected_rows() );
  }

  public function eliminar( $id ) {
    // Sanitizar datos
    $id = intval( $id );

    $this->db->where('id_producto', $id);
		$this->db->delete('productos');
		return boolval( $this->db->affected_rows() );
  }

  public function lista() {
    $this->db->join('proveedores', 'proveedores.id_proveedor = productos.id_proveedor');
    $this->db->join('categorias_producto', 'categorias_producto.id_categoria = productos.id_categoria');
    return $this->db->get('productos')->result_array();
  }
}
