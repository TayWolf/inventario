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
		$this->load->model("Fabricantes_model");
		$this->load->model("Areas_model");
		$this->load->model("Ip_model");
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
			"fabricantes" => $this->Fabricantes_model->getFabricantes(),
			"areas" => $this->Areas_model->getAreas(),
			"ips" => $this->Ip_model->getIpLibre(),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/telefonos/add",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store(){
		if ($this->input->post("guardar")) {
			$no_ext = $this->input->post("no_ext");
			$no_serie = $this->input->post("no_serie");
			$modelo = $this->input->post("modelo");
			$area = $this->input->post("area");
			$usuario_tel = $this->input->post("usuario_telefono");
			$ip = $this->input->post("ip");

			$data = array(
				"no_ext" => $no_ext,
				"no_serie" => $no_serie,
				"modelo" => $modelo,
				"id_area" => $area,
				"usuario_telefono" => $usuario_tel,
				"id_ip" => $ip,
				"estado" => 1,
				"fecregistro" => date("Y-m-d H:i:s"),
				"usuario_id" => $this->session->userdata("id"),
			);

			if ($this->Telefonos_model->save($data)) {
				$this->backend_lib->savelog($this->modulo,"Inserción de nuevo Teléfono con No. de Serie ".$no_serie);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."equipos/telefonos");
			} else {
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."equipos/telefonos/add");

			}
			
		} else {
			redirect(base_url()."equipos/telefonos/add");
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
		$data = array(
			"estado" => "0"
		);

		$this->Telefonos_model->update($id, $data);
		$this->backend_lib->savelog($this->modulo,"Eliminación del Teléfono con No. de Serie ".$telefono->no_serie);
		echo "equipos/telefonos";
	}

	public function edit($id){
		$contenido_interno = array(
			"telefono" => $this->Telefonos_model->getTelefono($id),
			"fabricantes" => $this->Fabricantes_model->getFabricantes(),
			"areas" => $this->Areas_model->getAreas(),
			"ips" => $this->Ip_model->getIpLibre()
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/telefonos/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idTelefono");
		$no_ext = $this->input->post("no_ext");
		$no_serie = $this->input->post("no_serie");
		$modelo = $this->input->post("modelo");
		$area = $this->input->post("area");
		$usuario_tel = $this->input->post("usuario_telefono");
		$ip = $this->input->post("ip");
		$estado = 1;

		if ($this->input->post("estado") ) {
			if ($this->input->post("estado") == 2) {
				$estado = 0;
			}
		}

		$data = array(
			"no_ext" => $no_ext,
			"no_serie" => $no_serie,
			"modelo" => $modelo,
			"id_area" => $area,
			"usuario_telefono" => $usuario_tel,
			"id_ip" => $ip,
			"estado" => $estado,
		);
		if ($this->Telefonos_model->update($id, $data)) {
			$this->backend_lib->savelog($this->modulo,"Actualización del Telefono con No. de Serie ".$no_serie);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."equipos/telefonos");
		} else {
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."equipos/telefonos/edit/".$id);

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
			redirect(base_url()."equipos/telefonos");
		}else{
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."equipos/telefonos");
		}

 	}

 	public function getMantenimientos(){
 		$id = $this->input->post("idequipo");
 		$mantenimientos = $this->Telefonos_model->getMantenimientos($id);
 		echo json_encode($mantenimientos);
 	}


}