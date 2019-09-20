<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo extends CI_Controller {
	private $modulo = "Modelo";
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Presentaciones_model");
	}

	public function index()
	{

		$contenido_interno = array(
			"presentaciones" => $this->Presentaciones_model->getPresentaciones(),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/modelo/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add(){
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/modelo/add","",TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store(){
		if ($this->input->post("guardar")) {
			$nombre = $this->input->post("nombre");

			$data = array(
				"nombre" => $nombre,
				"estado" => 1
			);

			if ($this->Presentaciones_model->save($data)) {
				$this->backend_lib->savelog($this->modulo,"Inserción de un nuevo modelo con el nombre ".$nombre);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."configuraciones/modelo");
			} else {
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."configuraciones/modelo/add");

			}
			
		} else {
			redirect(base_url()."configuraciones/modelo/add");
		}
		
	}

	public function view(){
		$id = $this->input->post("id");

		$data = array(
			"presentacion" => $this->Presentaciones_model->getPresentacion($id)
		);

		$this->load->view("admin/modelo/view", $data);
	}
	public function delete($id){
		$presentacion = $this->Presentaciones_model->getPresentacion($id);
		$data = array(
			"estado" => "0"
		);

		$this->Presentaciones_model->update($id, $data);
		$this->backend_lib->savelog($this->modulo,"Eliminación del modelo ".$presentacion->nombre);
		echo "configuraciones/modelo";
	}

	public function edit($id){
		$contenido_interno = array(
			"presentacion" => $this->Presentaciones_model->getPresentacion($id)
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/modelo/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idPresentacion");
		$nombre = $this->input->post("nombre");
		$estado = 1;

		if ($this->input->post("estado") ) {
			if ($this->input->post("estado") == 2) {
				$estado = 0;
			}
		}
		$data = array(
			"nombre" => $nombre,
			"estado" => $estado
		);
		if ($this->Presentaciones_model->update($id, $data)) {
			$this->backend_lib->savelog($this->modulo,"Actualización de modelo ".$nombre);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."configuraciones/modelo");
		} else {
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."configuraciones/modelo/edit/".$id);

		}
		
	}


}