<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario_model');
		
	}

	//muesto el login
	public function index()
	{	
		$valor = $this->session->userdata('usuario');
		if(!empty($valor)){
			redirect(base_url());
		}else{
			
			$this->load->view('template/header');
			$this->load->view('log/login_view');
			$this->load->view('template/footer');	
		}
	}
	// Recibo los datos del Log y realizo el mismo
	public function verificarDatos(){
		$datos['usuario'] = $this->input->post('username');
		$datos['password'] = $this->input->post('password');
		if($this->usuario_model->datos_correctos($datos)){
			$this->session->set_userdata('usuario',$datos['usuario']);
			$this->session->set_userdata('id_usuario',$this->usuario_model->obtener_id($datos['usuario']));
			redirect(base_url('index.php/principal'));
		}else{
			$error['mensaje_error'] = "Usuario y/o contraseña incorrecto/s";
			$error['usuario'] = $datos['usuario'];
			$this->load->view('template/header');
			$this->load->view('log/login_view',$error);
			$this->load->view('template/footer');
		}
	}
	//guardar la sucursal actual en sessión
	public function ajaxGuardarSucursal(){
		$this->session->set_userdata('numero_sucursal', $this->input->post('numero_sucursal'));
		echo $this->session->userdata('numero_sucursal');
	}
	// Cerrar la sessión 
	public function out(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

}

