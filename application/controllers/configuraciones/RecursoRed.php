<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecursoRed extends CI_Controller {
	private $modulo = "Recurso de Red";
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("RecursoRed_model");
	}

	public function index()
	{

		$contenido_interno = array(
			"recursored" => $this->RecursoRed_model->getRecursoRedes(),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/recursored/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add(){
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/recursored/add","",TRUE)
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

			if ($this->RecursoRed_model->save($data)) {
				$this->backend_lib->savelog($this->modulo,"Inserción del Recurso de Red ".$descripcion);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."configuraciones/recursored");
			} else {
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."configuraciones/recursored/add");

			}
			
		} else {
			redirect(base_url()."configuraciones/recursored/add");
		}
		
	}

	public function view(){
		$id = $this->input->post("id");

		$data = array(
			"recursored" => $this->RecursoRed_model->getRecursoRed($id)
		);

		$this->load->view("admin/recursored/view", $data);
	}
	public function delete($id){
		$recursored = $this->RecursoRed_model->getRecursoRed($id);
		$data = array(
			"estado" => "0"
		);

		$this->RecursoRed_model->update($id, $data);
		$this->backend_lib->savelog($this->modulo,"Eliminación del Recurso de Red ".$recursored->descripcion);
		echo "configuraciones/recursored";
	}

	public function edit($id){
		$contenido_interno = array(
			"recursored" => $this->RecursoRed_model->getRecursoRed($id)
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/recursored/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idRecursoRed");
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
		if ($this->RecursoRed_model->update($id, $data)) {
			$this->backend_lib->savelog($this->modulo,"Actualización del Recurso de Red ".$descripcion);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."configuraciones/recursored");
		} else {
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."configuraciones/recursored/edit/".$id);

		}
		
	}


}