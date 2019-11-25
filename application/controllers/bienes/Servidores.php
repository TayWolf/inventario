<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servidores extends CI_Controller {
	private $modulo = "Servidores";
	public function __construct(){
		parent::__construct();
		/*if (!$this->session->userdata("login")) {
			redirect(base_url());
		}*/
		$this->load->model("Servidores_model");
		$this->load->model("Ip_model");
		$this->load->model("Marcas_model");
		$this->load->model("Personas_model");
		$this->load->model("Tipo_propiedad_model");
		$this->load->model("Status_model");

	}

	public function index()
	{

		$contenido_interno = array(
			"servidores" => $this->Servidores_model->getProyectores(false,""),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/servidores/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add(){
		$contenido_interno = array(
			"marcas" => $this->Marcas_model->getMarcas(),
			"ips" => $this->Ip_model->getIpLibreServ(),
			"personas" => $this->Personas_model->getPersonas(),
			"tipo_propiedades" => $this->Tipo_propiedad_model->getTipo_propiedades()
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/servidores/add",$contenido_interno,TRUE)
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
			$procesador = $this->input->post("procesador");
			$unidad_almacenamiento = $this->input->post("unidad_almacenamiento");
			$ram = $this->input->post("ram");
			$direccion_mac = $this->input->post("direccion_mac");
			$sistema_operativo = $this->input->post("sistema_operativo");
			$estado_bien = $this->input->post("estado_bien");

			$data = array(
				"id_persona" => $id_persona,
				"id_elemento" => 14,
				"id_tipo_propiedad" => $id_tipo_propiedad,
				"modelo" => $modelo,
				"no_serie" => $no_serie,
				"id_marca" => $id_marca,
				"id_ip" => $id_ip,
				"procesador" => $procesador,
				"unidad_almacenamiento" => $unidad_almacenamiento,
				"ram" => $ram,
				"direccion_mac" => $direccion_mac,
				"fecregistro_bien" => date("Y-m-d H:i:s"),
				"sistema_operativo" => $sistema_operativo,
				"estado_bien" => $estado_bien,
				"id_usuario" => $this->session->userdata("id_usuario"),
				"id_status" => 1
			);

			if ($this->Servidores_model->save($data)) {
				$this->backend_lib->savelog($this->modulo,"Inserción de nuevo Servidor con No. de Serie ".$no_serie);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."bienes/servidores");
			} else {
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."bienes/servidores/add");

			}
			
		} else {
			redirect(base_url()."bienes/servidores/add");
		}
		
	}

	public function view(){
		$id = $this->input->post("id");

		$data = array(
			"servidor" => $this->Servidores_model->infoProyector($id),
			"mantenimientos" => $this->Servidores_model->getMantenimientos($id)
		);

		$this->load->view("admin/servidores/view", $data);
	}
	public function delete($id){
		$servidor = $this->Servidores_model->getProyector($id);

		$this->Servidores_model->delete($id);
		$this->backend_lib->savelog($this->modulo,"Eliminación del Servidor con No. de Serie ".$servidor->no_serie);
		echo "bienes/servidores";
	}

	public function edit($id){
		$contenido_interno = array(
			"servidor" => $this->Servidores_model->getProyector($id),
			"marcas" => $this->Marcas_model->getMarcas(),
			"ips" => $this->Ip_model->getIpLibreServ(),
			"personas" => $this->Personas_model->getPersonas(),
			"status" => $this->Status_model->getStatus(),
			"tipo_propiedades" => $this->Tipo_propiedad_model->getTipo_propiedades()
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/servidores/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idServidor");
		$id_persona = $this->input->post("id_persona");	
		$id_tipo_propiedad = $this->input->post("id_tipo_propiedad");
		$modelo = $this->input->post("modelo");
		$no_serie = $this->input->post("no_serie");
		$id_marca = $this->input->post("id_marca");
		$id_ip = $this->input->post("id_ip");
		$procesador = $this->input->post("procesador");
		$unidad_almacenamiento = $this->input->post("unidad_almacenamiento");
		$ram = $this->input->post("ram");
		$direccion_mac = $this->input->post("direccion_mac");
		$sistema_operativo = $this->input->post("sistema_operativo");
		$estado_bien = $this->input->post("estado_bien");
		$id_status = $this->input->post("id_status");

		$data = array(
			"id_persona" => $id_persona,
			"id_tipo_propiedad" => $id_tipo_propiedad,
			"modelo" => $modelo,
			"no_serie" => $no_serie,
			"id_marca" => $id_marca,
			"id_ip" => $id_ip,
			"procesador" => $procesador,
			"unidad_almacenamiento" => $unidad_almacenamiento,
			"ram" => $ram,
			"direccion_mac" => $direccion_mac,
			"sistema_operativo" => $sistema_operativo,
			"estado_bien" => $estado_bien,
			"id_status" => $id_status
		);
		if ($this->Servidores_model->update($id, $data)) {
			$this->backend_lib->savelog($this->modulo,"Actualización del Servidor con No. de Serie ".$no_serie);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."bienes/servidores");
		} else {
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."bienes/servidores/edit/".$id);

		}
		
	}

	public function addmantenimiento(){
		$id = $this->input->post("idequipo");
		$fecha = $this->input->post("fecha");
		$tecnico = $this->input->post("tecnico");
		$descripcion = $this->input->post("descripcion");

		$data = array(
			"proyector_id" => $id,
			"fecha" => $fecha,
			"tecnico" => $tecnico,
			"descripcion" => $descripcion
		);

		$dataProyector = array(
			"ultimo_mante" => $fecha
		);



		if ($this->Servidores_model->saveMante($data)) {
			$servidor = $this->Servidores_model->getProyector($id);
			$this->backend_lib->savelog($this->modulo,"Registro de Mantenimiento al Proyector con Codigo ".$servidor->no_serie);
			$this->Servidores_model->update($id,$dataProyector);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."bienes/servidores");
		}else{
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."bienes/servidores");
		}

 	}

 	public function getMantenimientos(){
 		$id = $this->input->post("idequipo");
 		$mantenimientos = $this->Servidores_model->getMantenimientos($id);
 		echo json_encode($mantenimientos);
 	}


}