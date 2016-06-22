<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Principal extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$valor = $this->session->userdata('usuario');
		if(empty($valor)){
			redirect(base_url('index.php/log'));
		}
	}
	public function index()
	{
		$valor_id = $this->session->userdata('numero_sucursal');
		if(!empty($valor_id)){
			redirect(base_url('index.php/proveedor/listar'));
		}else{
			$this->load->view('template/header');
			$this->load->view('principal/selector_sucursal_view');
			$this->load->view('template/footer');
		}
	}

}
