<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {
	private $modulo = "Categoria";
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Categoria_model");
	}

	public function index()
	{

		$contenido_interno = array(
			"categorias" => $this->Categoria_model->getCategorias(),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/categoria/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add(){
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/categoria/add","",TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store(){
		if ($this->input->post("guardar")) {
			$descripcion = $this->input->post("descripcion");

			$data = array(
				"descripcion" => $descripcion,
				"estado" => 1
			);

			if ($this->Categoria_model->save($data)) {
				$this->backend_lib->savelog($this->modulo,"Inserción de la Categoria ".$descripcion);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."configuraciones/categoria");
			} else {
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."configuraciones/categoria/add");

			}
			
		} else {
			redirect(base_url()."configuraciones/categoria/add");
		}
		
	}

	public function view(){
		$id = $this->input->post("id");

		$data = array(
			"categoria" => $this->Categoria_model->getCategoria($id)
		);

		$this->load->view("admin/categoria/view", $data);
	}
	public function delete($id){
		$categoria = $this->Categoria_model->getCategoria($id);
		$data = array(
			"estado" => "0"
		);

		$this->Categoria_model->update($id, $data);
		$this->backend_lib->savelog($this->modulo,"Eliminación de la Categoria ".$categoria->descripcion);
		echo "configuraciones/categoria";
	}

	public function edit($id){
		$contenido_interno = array(
			"categoria" => $this->Categoria_model->getCategoria($id)
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/categoria/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idCategoria");
		$descripcion = $this->input->post("descripcion");
		$estado = 1;

		if ($this->input->post("estado") ) {
			if ($this->input->post("estado") == 2) {
				$estado = 0;
			}
		}
		$data = array(
			"descripcion" => $descripcion,
			"estado" => $estado
		);
		if ($this->Categoria_model->update($id, $data)) {
			$this->backend_lib->savelog($this->modulo,"Actualización de la Categoria ".$descripcion);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."configuraciones/categoria");
		} else {
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."configuraciones/categoria/edit/".$id);

		}
		
	}


}