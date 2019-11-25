<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas extends CI_Controller {
	private $modulo = "Categoria";
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Marcas_model");
	}

	public function index()
	{

		$contenido_interno = array(
			"marcas" => $this->Marcas_model->getMarcas(),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/marcas/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add(){
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/marcas/add","",TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store(){
		if ($this->input->post("guardar")) {
			$marca = $this->input->post("marca");

			$data = array(
				"marca" => $marca
			);

			if ($this->Marcas_model->save($data)) {
				$this->backend_lib->savelog($this->modulo,"Inserción de la Marca ".$marca);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."configuraciones/marcas");
			} else {
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."configuraciones/marcas/add");

			}
			
		} else {
			redirect(base_url()."configuraciones/marcas/add");
		}
		
	}

	public function view(){
		$id = $this->input->post("id");

		$data = array(
			"marca" => $this->Marcas_model->getMarca($id)
		);

		$this->load->view("admin/marcas/view", $data);
	}
	public function delete($id){
		$marca = $this->Marcas_model->getMarca($id);
		
		$this->Marcas_model->delete($id);
		$this->backend_lib->savelog($this->modulo,"Eliminación de la Marca ".$marca->marca);
		echo "configuraciones/marcas";
	}

	public function edit($id){
		$contenido_interno = array(
			"marca" => $this->Marcas_model->getMarca($id)
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/marcas/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idMarca");
		$marca = $this->input->post("marca");
		
		$data = array(
			"marca" => $marca
		);
		if ($this->Marcas_model->update($id, $data)) {
			$this->backend_lib->savelog($this->modulo,"Actualización de la Marca ".$marca);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."configuraciones/marcas");
		} else {
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."configuraciones/marcas/edit/".$id);

		}
		
	}


}