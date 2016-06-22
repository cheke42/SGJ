<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('proveedor_model');
		$this->load->model('usuario_model');
	}

	public function index()
	{
		$this->listar();
	}

	//lista los proveedores en una tabla
	public function listar(){
		$this->load->view('template/header');
		$this->load->view('proveedor/listar_view');
		$this->load->view('template/footer');
	}

	// agregar un nuevo proveedor
	public function agregar(){
		$this->load->view('template/header');
		$this->load->view('proveedor/agregar_view');
		$this->load->view('template/footer');
	}

	//recibo los datos de un nuevo proveedor y lo redirijo a lista o obtener datos fiscales segun corresponda
	public function recibir_datos(){
		$datos['nombre'] = $this->input->post('nombre_proveedor');
		$datos['descripcion'] = $this->input->post('descripcion_proveedor');
		$datos['datos_fiscales'] = $this->input->post('datos_fiscales');
		$this->proveedor_model->guardar($datos);
		if ($datos['datos_fiscales'] == "on"){
			$this->obtener_datos_fiscales($datos['nombre']);
		}else{
			redirect(base_url('index.php/proveedor/listar'),'refresh');
		}
	}

	//obtener los datos fiscales de un proveedor 
	private function obtener_datos_fiscales($nombre){
		$datos['nombre_proveedor'] = $nombre;
		$this->load->view('template/header');
		$this->load->view('proveedor/datos_fiscales_view' , $datos);
		$this->load->view('template/footer');
		
	}

	//recibe los datos obtenidos desde la vista con SOA AFIP
	public function recibir_datos_fiscales(){
		$datos['cuit'] = $this->input->post('cuit');
		$datos['tipo_persona'] = $this->input->post('tipo_persona');
		$datos['estado'] = $this->input->post('estado');
		$datos['nombre'] = $this->input->post('nombre');
		$datos['nombre_referencia'] = $this->input->post('nombre_referencia');
		$datos['codigo_postal'] = $this->input->post('codigo_postal');
		$datos['direccion'] = $this->input->post('direccion');
		$datos['localidad'] = $this->input->post('localidad');
		$datos['fecha_inscripcion'] = date('Y-m-d', strtotime($this->input->post('fecha_inscripcion')));
		if ($datos['tipo_persona'] == 'FISICA'){
			$datos['numero_documento'] = $this->input->post('numero_documento');
			$datos['tipo_dni'] = $this->input->post('tipo_dni');

		}else{
			$datos['numero_documento'] = "";
			$datos['tipo_dni'] = "";
		}
		$this->proveedor_model->guardar_datos_fiscales($datos);
		redirect(base_url('index.php/proveedor/listar'),'refresh');
	}

	//muestra un determinado proveedr
	public function ver(){
		$datos['id'] = $this->input->get('id');
		$this->load->view('template/header');
		$this->load->view('proveedor/ver_view',$datos);
		$this->load->view('template/footer');
	}

	//agregar datos fiscales de un proveedor por get
	public function agregar_fiscales_get(){
		$nombre = $this->input->get('nombre');
		$this->obtener_datos_fiscales($nombre);
	}

	//chequear si existe un proveedor con AJAX
	public function ajax_chequear_existe_proveedor()
	{
		$nombre = $this->input->post('nombre_proveedor');
		if($this->proveedor_model->existe($nombre)){
			echo 'existe';
		}
	}

	//actualizar datos de proveedor
	public function actualizar(){
		$this->proveedor_model->actualizar_todos_datos($this->input->post());
		redirect(base_url('index.php/proveedor/listar'));
	}



}

/* End of file Proveedor.php */
/* Location: ./application/controllers/Proveedor.php */