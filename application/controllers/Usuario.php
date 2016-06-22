<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario_model');
		$valor = $this->session->userdata('usuario');
		if(empty($valor)){
			redirect(base_url('index.php/log'));
		}
	}
	public function ver()
	{
		$this->load->view('template/header');
		$this->load->view('usuario/ver');
		$this->load->view('template/footer');
	}
	//verificador para ajax
	public function ajaxChequear(){

		$datos['usuario'] = $this->session->userdata('usuario');
		$datos['password'] = $this->input->post('password');
		if ($this->usuario_model->datos_correctos($datos)){
			echo "correcto";
		}else{
			echo "incorrecto";
		}
	}
	//guardar para ajax
	public function ajaxGuardar(){
		
		$datos['password'] = $this->input->post('new_password');
		$datos['usuario'] = $this->session->userdata('usuario');
		$this->usuario_model->actualizar_password($datos);
	}

}

/* End of file Usuario.php */
/* Location: ./application/controllers/Usuario.php */