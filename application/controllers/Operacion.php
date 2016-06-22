<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operacion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('operacion_model');
		$this->load->model('sucursal_model');
		$this->load->model('usuario_model');
		$this->load->model('producto_model');

	}

	public function index()
	{
		$this->listar();
	}

	public function listar(){
		$id_sucursal = $this->session->userdata('numero_sucursal');
		$sucursal = $this->sucursal_model->obtener_datos($id_sucursal);
		$nombre = $sucursal->nombre;
		$datos['nombre_sucursal'] = $nombre;
		$this->load->view('template/header');
		$this->load->view('operacion/listar_view',$datos);
		$this->load->view('template/footer');
	}

	public function vender(){
		$this->load->view('template/header');
		$this->load->view('operacion/vender_view');
		$this->load->view('template/footer');
	}

	public function agregar(){
		$this->load->view('template/header');
		$this->load->view('operacion/agregar_view');
		$this->load->view('template/footer');
	}

	public function baja(){
		$this->load->view('template/header');
		$this->load->view('operacion/baja_view');
		$this->load->view('template/footer');
	}

	public function recibir_datos(){
		$operacion = $this->input->post('operacion');
		switch ($operacion) {
			case 'vender':
				$this->producto_model->vender($this->input->post());
				redirect(base_url('index.php/operacion'),'refresh');
				break;
			case 'agregar':
				$this->producto_model->agregar($this->input->post());
				redirect(base_url('index.php/operacion'),'refresh');
				break;
			case 'baja':
				$this->producto_model->baja($this->input->post());
				redirect(base_url('index.php/operacion'),'refresh');
				break;
				
		}
	}
	
	public function ajaxCantidadProducto(){
		$codigo = $this->input->post('codigo_producto');
		echo $this->producto_model->obtener_cantidad($codigo);
	}

}

/* End of file Solicitud.php */
/* Location: ./application/controllers/Solicitud.php */