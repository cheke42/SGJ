<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operacion_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function obtener_operaciones(){
		return $query = $this->db->get('operacion_producto');
	}

	public function nombre_operacion($id){
		$sql = "select * from tipo_operacion_producto where id='" . $id . "'";
		$query = $this->db->query($sql);
		return $query->result()[0]->nombre;
	}

}

/* End of file operacion_model.php */
/* Location: ./application/models/operacion_model.php */