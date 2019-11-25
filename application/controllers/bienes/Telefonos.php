<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Telefonos extends CI_Controller {
	private $modulo = "Telefonos";
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Telefonos_model");
		$this->load->model("Marcas_model");
		$this->load->model("Personas_model");
		$this->load->model("Tipo_propiedad_model");
		$this->load->model("Ip_model");
		$this->load->model("Status_model");
	}

	public function index()
	{

		$contenido_interno = array(
			"telefonos" => $this->Telefonos_model->getTelefonos(false,""),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/telefonos/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add(){
		$contenido_interno = array(
			"marcas" => $this->Marcas_model->getMarcas(),
			"personas" => $this->Personas_model->getPersonas(),
			"tipo_propiedades" => $this->Tipo_propiedad_model->getTipo_propiedades(),
			"ips" => $this->Ip_model->getIpLibreTel()
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/telefonos/add",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store(){
		if ($this->input->post("guardar")) {
			$id_persona = $this->input->post("id_persona");
			$id_tipo_propiedad = $this->input->post("id_tipo_propiedad");
			$no_ext_tel = $this->input->post("no_ext_tel");
			$no_serie = $this->input->post("no_serie");
			$modelo = $this->input->post("modelo");
			$id_marca = $this->input->post("id_marca");
			$id_ip = $this->input->post("id_ip");
			$estado_bien = $this->input->post("estado_bien");

			$data = array(
				"id_elemento" => 3,
				"id_persona" => $id_persona,
				"id_tipo_propiedad" => $id_tipo_propiedad,
				"no_ext_tel" => $no_ext_tel,
				"no_serie" => $no_serie,
				"modelo" => $modelo,
				"id_marca" => $id_marca,
				"id_ip" => $id_ip,
				"estado_bien" => $estado_bien,
				"fecregistro_bien" => date("Y-m-d H:i:s"),
				"id_usuario" => $this->session->userdata("id_usuario"),
				"id_status" => 1,
			);

			if ($this->Telefonos_model->save($data)) {
				$this->backend_lib->savelog($this->modulo,"Inserción de nuevo Teléfono con No. de Serie ".$no_serie);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."bienes/telefonos");
			} else {
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."bienes/telefonos/add");

			}
			
		} else {
			redirect(base_url()."bienes/telefonos/add");
		}
		
	}

	public function view(){
		$id = $this->input->post("id");

		$data = array(
			"telefono" => $this->Telefonos_model->infoTelefono($id),
			"mantenimientos" => $this->Telefonos_model->getMantenimientos($id)
		);

		$this->load->view("admin/telefonos/view", $data);
	}
	public function delete($id){
		$telefono = $this->Telefonos_model->getTelefono($id);
		
		$this->Telefonos_model->delete($id);
		$this->backend_lib->savelog($this->modulo,"Eliminación del Teléfono con No. de Serie ".$telefono->no_serie);
		echo "bienes/telefonos";
	}

	public function edit($id){
		$contenido_interno = array(
			"telefono" => $this->Telefonos_model->getTelefono($id),
			"marcas" => $this->Marcas_model->getMarcas(),
			"personas" => $this->Personas_model->getPersonas(),
			"status" => $this->Status_model->getStatus(),
			"tipo_propiedades" => $this->Tipo_propiedad_model->getTipo_propiedades(),
			"ips" => $this->Ip_model->getIpLibreTel()
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/telefonos/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idTelefono");
		$id_persona = $this->input->post("id_persona");
		$id_tipo_propiedad = $this->input->post("id_tipo_propiedad");
		$no_ext_tel = $this->input->post("no_ext_tel");
		$no_serie = $this->input->post("no_serie");
		$modelo = $this->input->post("modelo");
		$id_marca = $this->input->post("id_marca");
		$id_ip = $this->input->post("id_ip");
		$estado_bien = $this->input->post("estado_bien");
		$id_status = $this->input->post("id_status");

		$data = array(
			"id_persona" => $id_persona,
			"id_tipo_propiedad" => $id_tipo_propiedad,
			"no_ext_tel" => $no_ext_tel,
			"no_serie" => $no_serie,
			"modelo" => $modelo,
			"id_marca" => $id_marca,
			"id_ip" => $id_ip,
			"estado_bien" => $estado_bien,
			"id_status" => $id_status
		);
		if ($this->Telefonos_model->update($id, $data)) {
			$this->backend_lib->savelog($this->modulo,"Actualización del Telefono con No. de Serie ".$no_serie);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."bienes/telefonos");
		} else {
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."bienes/telefonos/edit/".$id);

		}
		
	}

	public function addmantenimiento(){
		$id = $this->input->post("idequipo");
		$fecha = $this->input->post("fecha");
		$tecnico = $this->input->post("tecnico");
		$descripcion = $this->input->post("descripcion");

		$data = array(
			"tablet_id" => $id,
			"fecha" => $fecha,
			"tecnico" => $tecnico,
			"descripcion" => $descripcion
		);

		$dataTablet = array(
			"ultimo_mante" => $fecha
		);



		if ($this->Telefonos_model->saveMante($data)) {
			$telefono = $this->Telefonos_model->getTelefono($id);
			$this->backend_lib->savelog($this->modulo,"Registro de Mantenimiento al Telefono con No. de Serie ".$telefono->no_serie);
			$this->Telefonos_model->update($id,$dataTablet);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."bienes/telefonos");
		}else{
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."bienes/telefonos");
		}

 	}

 	public function getMantenimientos(){
 		$id = $this->input->post("idequipo");
 		$mantenimientos = $this->Telefonos_model->getMantenimientos($id);
 		echo json_encode($mantenimientos);
 	}


}