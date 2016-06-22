<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('producto_model');
		$this->load->model('sucursal_model');
		$this->load->model('categoria_model');
		$this->load->model('usuario_model');
		$this->load->model('pdfGenerator_model');
	}

	public function index()
	{
		$this->listar();	
	}

	//lista los productos de la sucursal
	public function listar(){
		$id_sucursal = $this->session->userdata('numero_sucursal');
		$sucursal = $this->sucursal_model->obtener_datos($id_sucursal);
		$nombre = $sucursal->nombre;
		$datos['nombre_sucursal'] = $nombre;
		$this->load->view('template/header.php');
		$this->load->view('producto/listar_view',$datos);
		$this->load->view('template/footer.php');
	}

	//agregar un producto
	public function agregar(){
		$this->load->view('template/header');
		$this->load->view('producto/agregar_view');
		$this->load->view('template/footer');
	}
	//recibe los datos enviados desde agregar
	function recibir_datos(){
		$this->producto_model->guardar($this->input->post());
		redirect(base_url('index.php/producto/listar'));
	}

	//chequear si existe un producto con AJAX
	public function ajax_chequear_existe_producto()
	{
		$nombre = $this->input->post('nombre_producto');
		if($this->producto_model->existe($nombre)){
			echo 'existe';
		}
	}

	//muestra un determinado producto
	public function ver(){
		$datos['codigo'] = $this->input->get('codigo');
		$this->load->view('template/header');
		$this->load->view('producto/ver_view',$datos);
		$this->load->view('template/footer');
	}

	// actualizar los datos de un producto
	public function actualizar(){
		$this->producto_model->actualizar_todos_datos($this->input->post());
		redirect(base_url('index.php/producto/listar'),'refresh');
	}

	public function barcode(){
		$datos['codigo'] = $this->input->get('codigo');
		$this->load->view('producto/barcode_view',$datos);
	}

	public function pdf(){
	$arreglo['header'] = array(1,2,3,4,5,6,7);
	$arreglo['titulo'] = "Este es un título";
	$this->pdfGenerator_model->generar($arreglo);
	}

}

/* End of file Producto.php */
/* Location: ./application/controllers/Producto.php */