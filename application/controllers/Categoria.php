<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('categoria_model');
		$this->load->model('usuario_model');
	}
	public function index()
	{
		$this->listar();
	}

	// listar todas las categorías
	public function listar (){
		$this->load->view('template/header');
		$this->load->view('categoria/listar_view');	
		$this->load->view('template/footer');	
	}

	// agregar un nueva categoria
	public function agregar(){
		$this->load->view('template/header');
		$this->load->view('categoria/agregar_view');
		$this->load->view('template/footer');
	}

	//chequear si existe una categoria con AJAX
	public function ajax_chequear_existe_categoria()
	{
		$nombre = $this->input->post('nombre_categoria');
		if($this->categoria_model->existe($nombre)){
			echo 'existe';
		}
	}

	//recibir los datos de una categoria y guardarlos en la base
	public function recibir_datos(){
		$datos['nombre'] = $this->input->post('nombre_categoria');
		$datos['descripcion'] = $this->input->post('descripcion_categoria');
		$this->categoria_model->guardar($datos);
		redirect(base_url('index.php/categoria/listar'),'refresh');
	}


}

/* End of file Categoria.php */
/* Location: ./application/controllers/Categoria.php */