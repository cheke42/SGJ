<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	//guarda una categoria
	public function guardar($data){
		date_default_timezone_set("America/Argentina/Buenos_Aires");
		$nombre_usuario = $this->session->userdata('usuario');
		$id_usuario = $this->usuario_model->obtener_id($nombre_usuario);
		$datos = array(
			'nombre' => $data['nombre'],
			'fecha_alta' => date('Y-m-d H:i:s') ,
			'id_creador' => $id_usuario ,
			'descripcion' => $data['descripcion']
			);
		$this->db->insert('categoria', $datos);
	}

	//obtener el id de una categoria a traves de su nombre
	public function obtener_id($nombre){
		$sql = "select * from categoria where nombre='" . $nombre . "'";
		$query = $this->db->query($sql);
		return $query->result()[0]->id;
	}

	//obtener los datos con id
	public function obtener_datos($id){
		$sql = "select * from categoria where id='" . $id . "'";
		$query = $this->db->query($sql);
		return $query->result()[0];
	}

	//verificar si existe el nombre: TRUE o FALSE
	public function existe($nombre){
		$this->db->where('nombre', $nombre);
		$query = $this->db->get('categoria');
		if($query->num_rows() > 0 ){
			return true;
		}else{
			return false;
		}
	}

	//obtener todas las categorias categorias
	public function obtener_categorias(){
		return $query = $this->db->get('categoria');
	}
	

}

/* End of file categoria_model.php */
/* Location: ./application/models/categoria_model.php */