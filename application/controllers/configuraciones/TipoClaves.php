<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TipoClaves extends CI_Controller {
	private $modulo = "Tipo de Claves";
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Tipo_claves_model");
	}

	public function index()
	{

		$contenido_interno = array(
			"tipoclaves" => $this->Tipo_claves_model->getTipoClaves(),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/tipoclaves/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add(){
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/tipoclaves/add","",TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store(){
		if ($this->input->post("guardar")) {
			$nombre_tipo_acceso = $this->input->post("nombre_tipo_acceso");

			$data = array(
				"nombre_tipo_acceso" => $nombre_tipo_acceso
			);

			if ($this->Tipo_claves_model->save($data)) {
				$this->backend_lib->savelog($this->modulo,"Inserción del Tipo de Clave ".$nombre_tipo_acceso);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."configuraciones/tipoclaves");
			} else {
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."configuraciones/tipoclaves/add");

			}
			
		} else {
			redirect(base_url()."configuraciones/tipoclaves/add");
		}
		
	}

	public function view(){
		$id = $this->input->post("id");

		$data = array(
			"tipoclave" => $this->Tipo_claves_model->getTipoClave($id)
		);

		$this->load->view("admin/tipoclaves/view", $data);
	}
	public function delete($id){
		$tipoclave = $this->Tipo_claves_model->getTipoClave($id);

		$this->Tipo_claves_model->delete($id);
		$this->backend_lib->savelog($this->modulo,"Eliminación del Tipo de Clave ".$tipoclave->nombre_tipo_acceso);
		echo "configuraciones/tipoclaves";
	}

	public function edit($id){
		$contenido_interno = array(
			"tipoclave" => $this->Tipo_claves_model->getTipoClave($id)
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/tipoclaves/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idTipoClave");
		$nombre_tipo_acceso = $this->input->post("nombre_tipo_acceso");

		$data = array(
			"nombre_tipo_acceso" => $nombre_tipo_acceso
		);
		if ($this->Tipo_claves_model->update($id, $data)) {
			$this->backend_lib->savelog($this->modulo,"Actualización del Tipo de Clave ".$nombre_tipo_acceso);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."configuraciones/tipoclaves");
		} else {
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."configuraciones/tipoclaves/edit/".$id);

		}
		
	}


}