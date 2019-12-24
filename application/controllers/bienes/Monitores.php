<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitores extends CI_Controller {
	private $modulo = "Impresoras";
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Monitores_model");
		$this->load->model("Personas_model");
		$this->load->model("Tipo_propiedad_model");
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
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/monitores/add",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store(){
		if ($this->input->post("guardar")) {
			$id_persona = $this->input->post("id_persona");
			$id_tipo_propiedad = $this->input->post("id_tipo_propiedad");
			$modelo = $this->input->post("modelo");
			$no_serie = $this->input->post("no_serie");
			$id_marca = $this->input->post("id_marca");
			$id_ip = $this->input->post("id_ip");
			$estado_bien = $this->input->post("estado_bien");

			$data = array(
				"id_persona" => $id_persona,
				"id_elemento" => 6,
				"id_tipo_propiedad" => $id_tipo_propiedad,
				"modelo" => $modelo,
				"no_serie" => $no_serie,
				"id_marca" => $id_marca,
				"id_ip" => $id_ip,
				"fecregistro_bien" => date("Y-m-d H:i:s"),
				"estado_bien" => $estado_bien,
				"id_status" => 1,
				"id_usuario" => $this->session->userdata("id_usuario")
			);

			// $dataImpresora = array(
			// 	"id_status" => 4
			// );

			if ($this->Monitores_model->save($data)) {
				$this->backend_lib->savelog($this->modulo,"Inserción de nueva Impresora con No. de Serie ".$no_serie);
				// $this->Ip_model->update($id_ip, $dataImpresora);
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
			"impresora" => $this->Monitores_model->infoImpresora($id),
			"ips" => $this->Ip_model->getIpLibreCPU(),
			"personas" => $this->Personas_model->getPersonas(),
			"tipo_propiedades" => $this->Tipo_propiedad_model->getTipo_propiedades(),
			"marcas" => $this->Marcas_model->getMarcas(),
			// "mantenimientos" => $this->Impresoras_model->getMantenimientos($id)
		);

		$this->load->view("admin/monitores/view", $data);
	}
	public function delete($id){
		$impresora = $this->Monitores_model->getImpresora($id);
		
		$this->Monitores_model->delete($id);
		$this->backend_lib->savelog($this->modulo,"Eliminación de la Impresoras con No. de Serie ".$impresora->no_serie);
		echo "bienes/monitores";
	}

	public function edit($id){
		$contenido_interno = array(
			"impresora" => $this->Monitores_model->getImpresora($id),
			"ips" => $this->Ip_model->getIpLibreCPU(),
			"personas" => $this->Personas_model->getPersonas(),
			"tipo_propiedades" => $this->Tipo_propiedad_model->getTipo_propiedades(),
			"status" => $this->Status_model->getStatus(),
			"marcas" => $this->Marcas_model->getMarcas()
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/monitores/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idImpresora");
		$id_persona = $this->input->post("id_persona");
		$id_tipo_propiedad = $this->input->post("id_tipo_propiedad");
		$modelo = $this->input->post("modelo");
		$no_serie = $this->input->post("no_serie");
		$id_marca = $this->input->post("id_marca");
		$id_ip = $this->input->post("id_ip");
		$estado_bien = $this->input->post("estado_bien");
		$id_status = $this->input->post("id_status");

		$data = array(
			"id_persona" => $id_persona,
			"id_tipo_propiedad" => $id_tipo_propiedad,
			"modelo" => $modelo,
			"no_serie" => $no_serie,
			"id_marca" => $id_marca,
			"id_ip" => $id_ip,
			"estado_bien" => $estado_bien,
			"id_status" => $id_status
		);

		if ($this->Monitores_model->update($id, $data)) {
			$this->backend_lib->savelog($this->modulo,"Actualización de la Impresora con No. de Serie ".$no_serie);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."bienes/monitores");
		} else {
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."bienes/monitores/edit/".$id);

		}
		
	}

	public function addmantenimiento(){
		$id = $this->input->post("idequipo");
		$fecha = $this->input->post("fecha");
		$tecnico = $this->input->post("tecnico");
		$descripcion = $this->input->post("descripcion");

		$data = array(
			"impresora_id" => $id,
			"fecha" => $fecha,
			"tecnico" => $tecnico,
			"descripcion" => $descripcion
		);

		$dataImpresora = array(
			"ultimo_mante" => $fecha
		);



		if ($this->Monitores_model->saveMante($data)) {
			$impresora = $this->Monitores_model->getImpresora($id);
			$this->backend_lib->savelog($this->modulo,"Registro de Mantenimiento a la Impresora con Codigo ".$impresora->codigo);
			$this->Monitores_model->update($id,$dataImpresora);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."bienes/monitores");
		}else{
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."bienes/monitores");
		}

 	}

 	public function getMantenimientos(){
 		$id = $this->input->post("idequipo");
 		$mantenimientos = $this->Monitores_model->getMantenimientos($id);
 		echo json_encode($mantenimientos);
 	}


}