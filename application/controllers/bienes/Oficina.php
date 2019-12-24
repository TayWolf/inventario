<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oficina extends CI_Controller {
	private $modulo = "Bienes de Oficina";
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Bienes_Oficina_model");
		$this->load->model("Areas_model");
		$this->load->model("Personas_model");
		$this->load->model("Elementos_model");
		$this->load->model("Status_model");
		$this->load->model("Tipo_bien_model");
		$this->load->model("Tipo_propiedad_model");
	}

	public function index()
	{

		$contenido_interno = array(
			"bienesoficina" => $this->Bienes_Oficina_model->getNobreaks(false,""),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/bienesoficina/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add(){
		$contenido_interno = array(
			"areas" => $this->Areas_model->getAreas(),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/bienesoficina/add",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store(){
		if ($this->input->post("guardar")) {
			$descripcion = $this->input->post("descripcion");

			$data = array(
				"folio_remision" => "SCULTURA3-R/P3B/2783",
				"id_elemento" => 8,
				"id_tipo_propiedad" => 3,
				"modelo" => "Equipo de oficina",
				"no_serie" => "EO-12",
				"id_marca" => 1,
				"estado_bien" => $descripcion,
				"fecregistro_bien" => date("Y-m-d H:i:s"),
				"id_usuario" => $this->session->userdata("id_usuario"),
				"id_status" => 1
			);

			if ($this->Bienes_Oficina_model->save($data)) {
				$this->backend_lib->savelog($this->modulo,"Inserción de nuevo Bien de Oficina con No. de Serie ".$descripcion);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."bienes/oficina");
			} else {
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."bienes/oficina/add");

			}
			
		} else {
			redirect(base_url()."bienes/oficina/add");
		}
		
	}

	public function view(){
		$id = $this->input->post("id");

		$data = array(
			"bienoficina" => $this->Bienes_Oficina_model->infoNobreak($id)
		);

		$this->load->view("admin/bienesoficina/view", $data);
	}
	public function delete($id){
		$bienoficina = $this->Bienes_Oficina_model->getNobreak($id);
		$this->Bienes_Oficina_model->delete($id);
		$this->backend_lib->savelog($this->modulo,"Eliminación del Bien de Oficina ".$bienoficina->estado_bien);
		echo "bienes/oficina";
	}

	public function edit($id){
		$contenido_interno = array(
			"bienoficina" => $this->Bienes_Oficina_model->getNobreak($id)
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/bienesoficina/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idBienOficina");
		$descripcion = $this->input->post("descripcion");

		$data = array(
			"estado_bien" => $descripcion
		);
		if ($this->Bienes_Oficina_model->update($id, $data)) {
			$this->backend_lib->savelog($this->modulo,"Actualización del Bien de Oficina ".$descripcion);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."bienes/oficina");
		} else {
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."bienes/oficina/edit/".$id);

		}
		
	}

	/*public function addmantenimiento(){
		$id = $this->input->post("idequipo");
		$fecha = $this->input->post("fecha");
		$tecnico = $this->input->post("tecnico");
		$descripcion = $this->input->post("descripcion");

		$data = array(
			"lector_id" => $id,
			"fecha" => $fecha,
			"tecnico" => $tecnico,
			"descripcion" => $descripcion
		);

		$dataLector = array(
			"ultimo_mante" => $fecha
		);



		if ($this->Nobreak_model->saveMante($data)) {
			$lector = $this->Nobreak_model->getNobreak($id);
			$this->backend_lib->savelog($this->modulo,"Registro de Mantenimiento al Lector con Codigo ".$lector->codigo);
			$this->Nobreak_model->update($id,$dataLector);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."equipos/lectores");
		}else{
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."equipos/lectores");
		}

 	}

 	public function getMantenimientos(){
 		$id = $this->input->post("idequipo");
 		$mantenimientos = $this->Nobreak_model->getMantenimientos($id);
 		echo json_encode($mantenimientos);
 	}*/


}