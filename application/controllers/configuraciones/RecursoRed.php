<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecursoRed extends CI_Controller 
{
	private $modulo = "Recurso de Red";
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")) 
		{
			redirect(base_url());
		}
		$this->load->model("RecursoRed_model");
		$this->load->model("Tipo_claves_model");
		$this->load->model("Personas_model");
		$this->load->model("Status_model");
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

	public function add()
	{
		$contenido_interno = array(
			"tipo_claves" => $this->Tipo_claves_model->getTipoClaves(),
			"personas" => $this->Personas_model->getPersonas(),
			"status" => $this->Status_model->getStatus()
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/recursored/add",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store()
	{
		if ($this->input->post("guardar")) 
		{
			$id_tipo_clave = $this->input->post("id_tipo_clave");
			$id_persona = $this->input->post("id_persona");
			$usuario_acceso = $this->input->post("usuario_acceso");
			$clave_acceso = $this->input->post("clave_acceso");

			$data = array(
				"id_tipo_clave" => $id_tipo_clave,
				"id_persona" => $id_persona,
				"usuario_acceso" => $usuario_acceso,
				"clave_acceso" => $clave_acceso,
				"id_status" => 1
			);

			if ($this->RecursoRed_model->save($data)) 
			{
				$this->backend_lib->savelog($this->modulo,"Inserción del Recurso de Red ".$usuario_acceso);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."configuraciones/recursored");
			} 
			else
			{
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."configuraciones/recursored/add");
			}
		} 
		else 
		{
			redirect(base_url()."configuraciones/recursored/add");
		}	
	}

	public function view()
	{
		$id = $this->input->post("id");

		$data = array(
			"recursored" => $this->RecursoRed_model->getRecursoRed($id)
		);
		$this->load->view("admin/recursored/view", $data);
	}

	public function delete($id)
	{
		$recursored = $this->RecursoRed_model->getRecursoRed($id);

		$this->RecursoRed_model->delete($id);
		$this->backend_lib->savelog($this->modulo,"Eliminación del Recurso de Red ".$recursored->usuario_acceso);
		echo "configuraciones/recursored";
	}

	public function edit($id)
	{
		$contenido_interno = array(
			"recursored" => $this->RecursoRed_model->getRecursoRed($id),
			"tipo_claves" => $this->Tipo_claves_model->getTipoClaves(),
			"personas" => $this->Personas_model->getPersonas(),
			"status" => $this->Status_model->getStatus()
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/recursored/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update()
	{
		$id = $this->input->post("idRecursoRed");
		$id_tipo_clave = $this->input->post("id_tipo_clave");
		$id_persona = $this->input->post("id_persona");
		$usuario_acceso = $this->input->post("usuario_acceso");
		$clave_acceso = $this->input->post("clave_acceso");
		$id_status = $this->input->post("id_status");

		$data = array(
			"id_tipo_clave" => $id_tipo_clave,
			"id_persona" => $id_persona,
			"usuario_acceso" => $usuario_acceso,
			"clave_acceso" => $clave_acceso,
			"id_status" => $id_status
		);
		if ($this->RecursoRed_model->update($id, $data)) 
		{
			$this->backend_lib->savelog($this->modulo,"Actualización del Recurso de Red ".$usuario_acceso);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."configuraciones/recursored");
		} 
		else 
		{
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."configuraciones/recursored/edit/".$id);
		}
	}
}