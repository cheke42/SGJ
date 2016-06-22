<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sucursal_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	//obtener los datos con id
	public function obtener_datos($id){
		$sql = "select * from sucursal where id='" . $id . "'";
		$query = $this->db->query($sql);
		return $query->result()[0];
	}
	

}

/* End of file sucursal_model.php */
/* Location: ./application/models/sucursal_model.php */