<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	//guardar un usuario
	public function guardar($datos){
		date_default_timezone_set("America/Argentina/Buenos_Aires");
		$nombre_usuario = $this->session->userdata('usuario');
		$id_usuario = $this->usuario_model->obtener_id($nombre_usuario);
		if ($datos['datos_fiscales'] == "on"){
			$datos_fiscales = true;
		}else{
			$datos_fiscales = false;
		}
		$data = array(
		   'nombre' => $datos['nombre'] ,
		   'id_creador' => $id_usuario ,
		   'fecha_alta' => date('Y-m-d H:i:s'),
		   'estado' => true,
		   'datos_fiscales' => $datos_fiscales,
		   'descripcion' => $datos['descripcion']
		);
		$this->db->insert('proveedor', $data); 

	}

	//Obtener el identificador de un proveedor
	public function obtener_id($nombre){
		$sql = "select * from proveedor where nombre='" . $nombre . "'";
		$query = $this->db->query($sql);
		return $query->result()[0]->id;
	}
	// guarda los datos fiscales de un proveedor
	public function guardar_datos_fiscales($datos){
		$id_proveedor = $this->obtener_id($datos['nombre_referencia']);
		$data = array(
			'id_proveedor' => $id_proveedor,
			'tipo_persona' => $datos['tipo_persona'],
			'estado' => $datos['estado'],
			'nombre' => $datos['nombre'],
			'codigo_postal' => $datos['codigo_postal'],
			'direccion' => $datos['direccion'],
			'localidad' => $datos['localidad'],
			'fecha_inscripcion' => $datos['fecha_inscripcion'],
			'numero_documento' => $datos['numero_documento'],
			'cuit' => $datos['cuit'],
			'tipo_dni' => $datos['tipo_dni']
		);
		$this->db->insert('dato_fiscal', $data);
		$this->cambiar_datos_fiscales(true, $datos['nombre_referencia']); 
	}

	// Actualiza la bandera de datos fiscales en la tabla del proveedor
	public function cambiar_datos_fiscales($valor, $nombre){
		$data = array(
				'datos_fiscales' => $valor
				);
		$this->db->where('id', $this->obtener_id($nombre));
		$this->db->update('proveedor',$data);

	}
	
	//retorna los datos de un proveedor
	public function obtener_datos($id){
		$sql = "select * from proveedor where id='" . $id . "'";
		$query = $this->db->query($sql);
		return $query->result()[0];
	}

	//retorna los datos fiscales de un proveedor
	public function obtener_datos_fiscales($id){
		$sql = "select * from dato_fiscal where id_proveedor='" . $id . "'";
		$query = $this->db->query($sql);
		return $query->result()[0];
	}

	//Chequear si existe un proveedor TRUE:FALSE
	public function existe($nombre)
	{
		$this->db->where('nombre', $nombre);
		$query = $this->db->get('proveedor');
		if($query->num_rows() > 0 ){
			return true;
		}else{
			return false;
		}
	}
	//Devuelve todos los datos del proveedor
	public function obtener_proveedores(){
  		return $query = $this->db->get('proveedor');
	}

	//Actualizar todos los datos
	public function actualizar_todos_datos($data){
		if ($data['estado'] == "on"){
			$estado = true;
		}else{
			$estado = false;
		}
		$id =  $data['id'];
		$datos = array(
			'nombre' => $data['nombre_referencia'], 
			'descripcion' => $data['descripcion_proveedor'], 
			'estado' => $estado 
		);
		$datos_fiscales = array(
			'localidad' => $data['localidad'],
			'direccion' => $data['direccion'],
			'codigo_postal' =>$data['codigo_postal']
		);
		$this->db->where('id', $id);
		$this->db->update('proveedor',$datos);
		$this->db->where('id_proveedor', $id);
		$this->db->update('dato_fiscal',$datos_fiscales);

	}

}

/* End of file proveedor_model.php */
/* Location: ./application/models/proveedor_model.php */