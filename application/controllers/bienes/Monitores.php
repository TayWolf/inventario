<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitores extends CI_Controller {
	private $modulo = "Monitores";
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Monitores_model");
		$this->load->model("Areas_model");
		$this->load->model("Elementos_model");
		$this->load->model("Tipo_propiedad_model");
		$this->load->model("Personas_model");
		$this->load->model("Marcas_model");
		$this->load->model("Status_model");
	}

	public function index()
	{

		$contenido_interno = array(
			"monitores" => $this->Monitores_model->getMonitores(false,""),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/monitores/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add(){
		$contenido_interno = array(
			"personas" => $this->Personas_model->getPersonas(),
			"tipo_propiedades" => $this->Tipo_propiedad_model->getTipo_propiedades(),
			"marcas" => $this->Marcas_model->getMarcas(),
			"areas" => $this->Areas_model->getAreas()
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/monitores/add",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store(){
		if ($this->input->post("guardar")) {
			$no_serie = $this->input->post("no_serie");
			$modelo = $this->input->post("modelo");
			$marca = $this->input->post("marca");
			$persona = $this->input->post("persona");
			$id_tipo_propiedad = $this->input->post("id_tipo_propiedad");
			$estado_bien = $this->input->post("estado_bien");

			$data = array(
				"id_persona" => $persona,
				"id_elemento" => 2,
				"id_tipo_propiedad" => $id_tipo_propiedad,
				"modelo" => $modelo,
				"no_serie" => $no_serie,
				"id_marca" => $marca,
				"fecregistro_bien" => date("Y-m-d H:i:s"),
				"estado_bien" => $estado_bien,
				"id_usuario" => $this->session->userdata("id_usuario"),
				"id_status" => 5
			);

			if ($this->Monitores_model->save($data)) {
				$this->backend_lib->savelog($this->modulo,"Inserción de nuevo Monitor con No. de Serie ".$no_serie);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."bienes/monitores");
			} else {
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."bienes/monitores/add");

			}
			
		} else {
			redirect(base_url()."bienes/monitores/add");
		}
		
	}

	public function view(){
		$id = $this->input->post("id");

		$data = array(
			"monitor" => $this->Monitores_model->infoMonitor($id),
			"tipo_propiedades" => $this->Tipo_propiedad_model->getTipo_propiedades(),
			"marcas" => $this->Marcas_model->getMarcas(),
			"areas" => $this->Areas_model->getAreas(),
			"mantenimientos" => $this->Monitores_model->getMantenimientos($id)
		);

		$this->load->view("admin/monitores/view", $data);
	}

	public function delete($id){
		$monitor = $this->Monitores_model->getMonitor($id);

		$this->Monitores_model->delete($id);
		$this->backend_lib->savelog($this->modulo,"Eliminación del Monitor con No. de Serie ".$monitor->no_serie);
		echo "bienes/monitores";
	}

	public function edit($id){
		$contenido_interno = array(
			"monitor" => $this->Monitores_model->getMonitor($id),
			"personas" => $this->Personas_model->getPersonas(),
			"tipo_propiedades" => $this->Tipo_propiedad_model->getTipo_propiedades(),
			"marcas" => $this->Marcas_model->getMarcas(),
			"status" => $this->Status_model->getStatus(),
			"areas" => $this->Areas_model->getAreas()
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/monitores/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idMonitor");
		$no_serie = $this->input->post("no_serie");
		$modelo = $this->input->post("modelo");
		$marca = $this->input->post("marca");
		$persona = $this->input->post("persona");
		$id_tipo_propiedad = $this->input->post("id_tipo_propiedad");
		$estado_bien = $this->input->post("estado_bien");

		/*if ($this->input->post("estado") ) {
			if ($this->input->post("estado") == 2) {
				$estado = 0;
			}
		}*/

		$data = array(
			"id_persona" => $persona,
			"id_tipo_propiedad" => $id_tipo_propiedad,
			"modelo" => $modelo,
			"no_serie" => $no_serie,
			"id_marca" => $marca,
			"estado_bien" => $estado_bien
		);
		if ($this->Monitores_model->update($id, $data)) {
			$this->backend_lib->savelog($this->modulo,"Actualización del Monitor con No. de Serie ".$no_serie);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."bienes/monitores");
		} else {
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."bienes/monitores/edit/".$id);

		}
		
	}

	public function addmantenimiento(){
		$id = $this->input->post("idmonitor");
		$fecha = $this->input->post("fecha");
		$descripcion = $this->input->post("descripcion");

		$data = array(
			"id_bien" => $id,
			"fecha_mantenimiento" => $fecha,
			"id_usuario" => $this->session->userdata("id_usuario"),
			"motivo_mantenimiento" => $descripcion,
			"id_status" => 9,
		);

		$dataMonitor = array(
			"ultimo_mantenimiento" => $fecha
		);



		if ($this->Monitores_model->saveMante($data)) {
			$monitor = $this->Monitores_model->getMonitor($id);
			$this->backend_lib->savelog($this->modulo,"Registro de Mantenimiento al Monitor con No. de Serie ".$monitor->no_serie);
			$this->Monitores_model->update($id,$dataMonitor);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."equipos/monitores");
		}else{
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."equipos/monitores");
		}

 	}

 	public function getMantenimientos(){
 		$id = $this->input->post("idequipo");
 		$mantenimientos = $this->Monitores_model->getMantenimientos($id);
 		echo json_encode($mantenimientos);
 	}


}