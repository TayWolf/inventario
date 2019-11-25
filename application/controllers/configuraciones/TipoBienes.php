<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TipoBienes extends CI_Controller {
	private $modulo = "Tipo de Bienes";
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Tipo_bien_model");
	}

	public function index()
	{

		$contenido_interno = array(
			"tipobienes" => $this->Tipo_bien_model->getTipoBienes(),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/tipobienes/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add(){
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/tipobienes/add","",TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store(){
		if ($this->input->post("guardar")) {
			$nombre_bien = $this->input->post("nombre_bien");

			$data = array(
				"nombre_bien" => $nombre_bien
			);

			if ($this->Tipo_bien_model->save($data)) {
				$this->backend_lib->savelog($this->modulo,"Inserción del Tipo de Bien  ".$nombre_bien);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."configuraciones/tipobienes");
			} else {
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."configuraciones/tipobienes/add");

			}
			
		} else {
			redirect(base_url()."configuraciones/tipobienes/add");
		}
		
	}

	public function view(){
		$id = $this->input->post("id");

		$data = array(
			"tipobien" => $this->Tipo_bien_model->getTipoBien($id)
		);

		$this->load->view("admin/tipobienes/view", $data);
	}
	public function delete($id){
		$tipobien = $this->Tipo_bien_model->getTipoBien($id);
		
		$this->Tipo_bien_model->delete($id);
		$this->backend_lib->savelog($this->modulo,"Eliminación del Tipo de Bien ".$tipobien->nombre_bien);
		echo "configuraciones/tipobienes";
	}

	public function edit($id){
		$contenido_interno = array(
			"tipobien" => $this->Tipo_bien_model->getTipoBien($id)
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/tipobienes/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idTipoBien");
		$nombre_bien = $this->input->post("nombre_bien");
		
		$data = array(
			"nombre_bien" => $nombre_bien
		);
		if ($this->Tipo_bien_model->update($id, $data)) {
			$this->backend_lib->savelog($this->modulo,"Actualización del Tipo de Bien ".$nombre_bien);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."configuraciones/tipobienes");
		} else {
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."configuraciones/tipobienes/edit/".$id);

		}
		
	}


}