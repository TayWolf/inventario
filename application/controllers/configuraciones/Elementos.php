<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Elementos extends CI_Controller {
	private $modulo = "Elementos";
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Elementos_model");
		$this->load->model("Tipo_bien_model");
	}

	public function index()
	{

		$contenido_interno = array(
			"elemento" => $this->Elementos_model->getElementos()
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/elementos/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add()
	{
		$contenido_interno = array(
			"tipo_bienes" => $this->Tipo_bien_model->getTipoBienes()
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/elementos/add",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store(){
		if ($this->input->post("guardar")) {
			$nombre = $this->input->post("nombre");
			$tipo_bien = $this->input->post("tipo_bien");
			
			$data = array(
				"elemento" => $nombre,
				"id_tipo_bien" => $tipo_bien,
			);

			if ($this->Elementos_model->save($data)) {
				$this->backend_lib->savelog($this->modulo,"Inserción del Elemento ".$nombre);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."configuraciones/elementos");
			} else {
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."configuraciones/elementos/add");

			}
			
		} else {
			redirect(base_url()."configuraciones/elementos/add");
		}
		
	}

	public function view(){
		$id = $this->input->post("id");

		$data = array(
			"elemento" => $this->Elementos_model->getElemento($id)
		);

		$this->load->view("admin/elementos/view", $data);
	}
	public function delete($id){
		$elemento = $this->Elementos_model->getElemento($id);
		
		$this->Elementos_model->delete($id);
		$this->backend_lib->savelog($this->modulo,"Eliminación del Elemento ".$elemento->elemento);
		echo "configuraciones/elementos";
	}

	public function edit($id){
		$contenido_interno = array(
			"elemento" => $this->Elementos_model->getElemento($id),
			"tipo_bienes" => $this->Tipo_bien_model->getTipoBienes()
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/elementos/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idElemento");
		$nombre = $this->input->post("nombre");
		$tipo_bien = $this->input->post("tipo_bien");

		$data = array(
			"elemento" => $nombre,
			"id_tipo_bien" => $tipo_bien
		);

		if ($this->Elementos_model->update($id, $data)) {
			$this->backend_lib->savelog($this->modulo,"Actualización del Elemento ".$nombre);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."configuraciones/elementos");
		} else {
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."configuraciones/elementos/edit/".$id);

		}
		
	}


}