<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nobreak extends CI_Controller {
	private $modulo = "No-BREAK";
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Nobreak_model");
		$this->load->model("Areas_model");
	}

	public function index()
	{

		$contenido_interno = array(
			"nobreaks" => $this->Nobreak_model->getNobreaks(false,""),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/nobreak/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add(){
		$contenido_interno = array(
			"areas" => $this->Areas_model->getAreas(),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/nobreak/add",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store(){
		if ($this->input->post("guardar")) {
			$codigo = $this->input->post("no_serie");
			$modelo = $this->input->post("modelo");
			$area = $this->input->post("area");
			$descripcion = $this->input->post("descripcion");

			$data = array(
				"no_serie" => $codigo,
				"modelo" => $modelo,
				"id_area" => $area,
				"descripcion" => $descripcion,
				"estado" => 1,
				"fecregistro" => date("Y-m-d"),
				"usuario_id" => $this->session->userdata("id"),
			);

			if ($this->Nobreak_model->save($data)) {
				$this->backend_lib->savelog($this->modulo,"Inserción de nuevo No-BREAK con No. de Serie ".$codigo);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."equipos/nobreak");
			} else {
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."equipos/nobreak/add");

			}
			
		} else {
			redirect(base_url()."equipos/nobreak/add");
		}
		
	}

	public function view(){
		$id = $this->input->post("id");

		$data = array(
			"nobreak" => $this->Nobreak_model->infoNobreak($id),
			"areas" => $this->Areas_model->getAreas($id)
		);

		$this->load->view("admin/nobreak/view", $data);
	}
	public function delete($id){
		$nobreak = $this->Nobreak_model->getNobreak($id);
		$this->Nobreak_model->delete($id);
		$this->backend_lib->savelog($this->modulo,"Eliminación del No-BREAK ".$nobreak->no_serie);
		echo "equipos/nobreak";
	}

	public function edit($id){
		$contenido_interno = array(
			"nobreak" => $this->Nobreak_model->getNobreak($id),
			"areas" => $this->Areas_model->getAreas(),
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/nobreak/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idNobreak");
		$no_serie = $this->input->post("no_serie");
		$modelo = $this->input->post("modelo");
		$area = $this->input->post("area");
		$descripcion = $this->input->post("descripcion");

		$estado = 1;

		if ($this->input->post("estado") ) {
			if ($this->input->post("estado") == 2) {
				$estado = 0;
			}
		}

		$data = array(
			"no_serie" => $no_serie,
			"modelo" => $modelo,
			"id_area" => $area,
			"descripcion" => $descripcion,
			"estado" => $estado,
		);
		if ($this->Nobreak_model->update($id, $data)) {
			$this->backend_lib->savelog($this->modulo,"Actualización del No-Break ".$no_serie);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."equipos/nobreak");
		} else {
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."equipos/nobreak/edit/".$id);

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