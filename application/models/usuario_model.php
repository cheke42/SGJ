<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

	//guardar un usuario
	public function guardar($datos){
		date_default_timezone_set("America/Argentina/Buenos_Aires");
		$data = array(
		   'nombre' => $datos['nombre'] ,
		   'password' => md5($datos['password']) ,
		   'fecha_creacion' => date('Y-m-d H:i:s'),
		   'estado' => $datos['estado']
		);
		$this->db->insert('usuario', $data); 
	}

	//actualizar un usuario
	public function actualizar($datos, $id){
		$data = array(
		               'nombre' => $datos['nombre'] ,
		               'password' => md5($datos['password']) ,
		               'fecha_creacion' => date('Y-m-d H:i:s'),
		               'estado' => $datos['estado']
		            );

		$this->db->where('id', $id);
		$this->db->update('usuario', $data); 
	}

	//verificar si un usuario existe
	public function existe($nombre){
		$sql = "select * from usuario where nombre='" . $nombre."'";
		$query = $this->db->query($sql);
		if($query->num_rows() >0){
			return true;
		}else{
			return false;
		}
	}

	//verifico si el usuario y la contraseña son correctas
	public function datos_correctos($datos){
		$correcto = false;
		if($this->existe($datos['usuario'])){
			$query = $this->db->get('usuario');
			foreach ($query->result() as $row) {
				if ($row->nombre == $datos['usuario']){
					if($row->password == md5($datos['password'])){
						$correcto = true;
						break;
					}
				}
			}
		}
		return $correcto;
	}

	//obtener todos los datos de usuario
	public function obtener_datos($usuario){
		$sql = "select * from usuario where nombre='" . $usuario . "'";
		$query = $this->db->query($sql);
		return $query->result()[0];
	}

	//Obtener el identificador de un usuario
	public function obtener_id($nombre){
		$sql = "select * from usuario where nombre='" . $nombre . "'";
		$query = $this->db->query($sql);
		return $query->result()[0]->id;
	}

	//Obtener nombre a traves de un id
	public function obtener_nombre($id){
		$sql = "select * from usuario where id='" . $id . "'";
		$query = $this->db->query($sql);
		return $query->result()[0]->nombre;
	}

	//actualizar el password
	public function actualizar_password($datos){
		$datos_anteriores = $this->obtener_datos($datos['usuario']);
		$data = array(
						'password' => md5($datos['password']),
						'nombre'=> $datos_anteriores->nombre,
						'fecha_creacion' => $datos_anteriores->fecha_creacion,
						'estado' => $datos_anteriores->estado
					);
		$this->db->where('id', $datos_anteriores->id);
		$this->db->update('usuario', $data); 
	}

	//obtener todos los usuarios
	public function obtener_usuarios(){
		return $this->db->get('usuario');
	}
	

}

/* End of file usuario_model.php */
/* Location: ./application/models/usuario_model.php */