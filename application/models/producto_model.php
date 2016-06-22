<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	//guarda un producto 
	public function guardar($data){
		date_default_timezone_set("America/Argentina/Buenos_Aires");
		$nombre_usuario = $this->session->userdata('usuario');
		$id_usuario = $this->usuario_model->obtener_id($nombre_usuario);
		$numero_sucursal = $this->session->userdata('numero_sucursal');
		$datos = array(
			'codigo' => $data['codigo'],
			'nombre' => $data['nombre'],
			'id_sucursal' => $numero_sucursal,
			'precio' => $data['precio'],
			'cantidad' => $data['cantidad'],
			'fecha_creacion' => date('Y-m-d H:i:s') ,
			'id_creador' => $id_usuario ,
			'estado' => true,
			'descripcion' => $data['descripcion']
			);
		$this->db->insert('producto', $datos);
		$categorias = $data['categorias'];
		if (!empty($categorias)){
			foreach ($categorias as $row) {
				$cat = array(
					'id_producto' => $data['codigo'] ,
					'id_categoria' => $row 
					);
				$this->db->insert('producto_categoria',$cat);
			}
		}
	}

	//obtener el id de un producto a traves de su nombre
	public function obtener_id($nombre){
		$sql = "select * from producto where nombre='" . $nombre . "'";
		$query = $this->db->query($sql);
		return $query->result()[0]->id;
	}

	//obtener los datos con id
	public function obtener_datos($codigo){
		$sql = "select * from producto where codigo = '" . $codigo . "'";
		$query = $this->db->query($sql);
		return $query->result()[0];
	}

	//verificar si existe el codigo en sucursal: TRUE o FALSE
	public function existe($codigo){
		$numero_sucursal = $this->session->userdata('numero_sucursal');
		$sql = "select  * from fdn_db.producto where (codigo = '" . $codigo ."') and (id_sucursal = '" . $numero_sucursal . "')";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0 ){
			return true;
		}else{
			return false;
		}
	}

	//obtener todos los productos
	public function obtener_productos(){
		return $query = $this->db->get('producto');
	}
	
	//obtener las categorias del producto
	public function obtener_categorias($codigo){
		$sql = "select id_categoria from producto_categoria where id_producto = '" . $codigo . "'";
		return $query = $this->db->query($sql);
	}

	//actualizar un producto
	public function actualizar_todos_datos($datos){
		$codigo = $datos['codigo'];
		$producto = array(
				'nombre' => $datos['nombre'],
				'precio' => $datos['precio'],
				'cantidad' => $datos['cantidad'],
				'descripcion' => $datos['descripcion']
			);
		$this->db->where('codigo', $codigo);
		$this->db->update('producto',$producto);
		$this->db->where('id_producto', $codigo);
		$this->db->delete('producto_categoria');
		$categorias = $datos['categorias'];
		if (!empty($categorias)){
			foreach ($categorias as $row) {
				$cat = array(
					'id_producto' => $codigo,
					'id_categoria' => $row 
					);
				$this->db->insert('producto_categoria',$cat);
			}
		}
	}

	//Obtener la cantidad de un codigo de producto
	public function obtener_cantidad($codigo){
		$sucursal = $this->session->userdata('numero_sucursal');
		$sql = "select * from producto where codigo = '" . $codigo . "' and id_sucursal = '" . $sucursal . "';  ";
		return $this->db->query($sql)->result()[0]->cantidad;
	}

	// Incrementar la cantidad espeicifcada de un producto
	public function incrementar($codigo, $cantidad){
		$cantidad_db = $this->obtener_cantidad($codigo);
		$cantidad_total = $cantidad_db + $cantidad;
		$datos = array(
				'cantidad' => $cantidad_total
				);
		$this->db->where('codigo', $codigo);
		$this->db->where('id_sucursal', $this->session->userdata('numero_sucursal'));
		$this->db->update('producto', $datos);
	}

	//Decrementar la cantidad espeicifcada de un producto
	public function decrementar($codigo, $cantidad){
		$cantidad_db = $this->obtener_cantidad($codigo);
		$cantidad_total = $cantidad_db - $cantidad;
		$datos = array(
				'cantidad' => $cantidad_total
				);
		$this->db->where('codigo', $codigo);
		$this->db->where('id_sucursal', $this->session->userdata('numero_sucursal'));
		$this->db->update('producto', $datos);
	}

	//Operaciones realizadas al vender un producto
	public function vender($datos){
		date_default_timezone_set("America/Argentina/Buenos_Aires");
		$nombre_usuario = $this->session->userdata('usuario');
		$id_usuario = $this->usuario_model->obtener_id($nombre_usuario);
		$numero_sucursal = $this->session->userdata('numero_sucursal');
		$data = array(
			'codigo_producto' => $datos['producto'],
			'cantidad' => $datos['cantidad'],
			'tipo_operacion' => "2",
			'id_operador' => $datos['vendedor'],
			'fecha_operacion' => date('Y-m-d H:i:s'),
			'detalle' => $datos['descripcion'],
			'id_sucursal' => $numero_sucursal
			);
		$this->db->insert('operacion_producto',$data);
		$this->decrementar($datos['producto'],$datos['cantidad']);
	}

	//Operaciones realizadas al dar de baja un producto
	public function baja($datos){
		date_default_timezone_set("America/Argentina/Buenos_Aires");
		$nombre_usuario = $this->session->userdata('usuario');
		$id_usuario = $this->usuario_model->obtener_id($nombre_usuario);
		$numero_sucursal = $this->session->userdata('numero_sucursal');
		$data = array(
			'codigo_producto' => $datos['producto'],
			'cantidad' => $datos['cantidad'],
			'tipo_operacion' => "3",
			'id_operador' => $id_usuario,
			'fecha_operacion' => date('Y-m-d H:i:s'),
			'detalle' => $datos['descripcion'],
			'id_sucursal' => $numero_sucursal
			);
		$this->db->insert('operacion_producto',$data);
		$this->decrementar($datos['producto'],$datos['cantidad']);
	}

	//Operaciones realizadas al agregar mas stock a un porducto
	public function agregar($datos){
		date_default_timezone_set("America/Argentina/Buenos_Aires");
		$nombre_usuario = $this->session->userdata('usuario');
		$id_usuario = $this->usuario_model->obtener_id($nombre_usuario);
		$numero_sucursal = $this->session->userdata('numero_sucursal');
		$data = array(
			'codigo_producto' => $datos['producto'],
			'cantidad' => $datos['cantidad'],
			'tipo_operacion' => "1",
			'id_operador' => $id_usuario,
			'fecha_operacion' => date('Y-m-d H:i:s'),
			'detalle' => $datos['descripcion'],
			'id_sucursal' => $numero_sucursal
			);
		$this->db->insert('operacion_producto',$data);
		$this->incrementar($datos['producto'],$datos['cantidad']);
	}

}

/* End of file producto_model.php */
/* Location: ./application/models/producto_model.php */