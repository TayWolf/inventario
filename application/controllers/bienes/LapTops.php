<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LapTops extends CI_Controller 
{
	private $modulo = "LapTops";
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")) 
		{
			redirect(base_url());
		}
		$this->load->model("LapTops_model");
		$this->load->model("Areas_model");
		$this->load->model("Elementos_model");
		$this->load->model("Tipo_propiedad_model");
		$this->load->model("Ip_model");
		$this->load->model("Personas_model");
		$this->load->model("Marcas_model");
		$this->load->model("Status_model");
	}

	public function index()
	{

		$contenido_interno = array(
			"laptops" => $this->LapTops_model->getLapTops(false,""),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/laptops/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add()
	{
		$contenido_interno = array(
			"personas" => $this->Personas_model->getPersonas(),
			"tipo_propiedades" => $this->Tipo_propiedad_model->getTipo_propiedades(),
			"marcas" => $this->Marcas_model->getMarcas(),
			"ips" => $this->Ip_model->getIpLibreCPU()
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/laptops/add",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store()
	{
		if ($this->input->post("guardar")) 
		{
			$modelo = $this->input->post("modelo");
			$no_serie = $this->input->post("no_serie");
			$procesador = $this->input->post("procesador");
			$unidad_almacenamiento = $this->input->post("unidad_almacenamiento");
			$ram = $this->input->post("ram");
			$direccion_mac = $this->input->post("direccion_mac");
			$sistema_operativo = $this->input->post("sistema_operativo");
			$estado_bien = $this->input->post("estado_bien");
			$id_tipo_propiedad = $this->input->post("id_tipo_propiedad");
			$id_marca = $this->input->post("id_marca");
			$id_ip = $this->input->post("id_ip");

			$data = array(
				"id_elemento" => 7,
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
				"fecregistro_bien" => date("Y-m-d H:i:s"),
				"estado_bien" => $estado_bien,
				"id_usuario" => $this->session->userdata("id_usuario"),
				"id_status" => 6
			);

			if ($this->LapTops_model->save($data)) 
			{
				$this->backend_lib->savelog($this->modulo,"Inserción de nueva Lap-Top con No. de Serie ".$no_serie);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."bienes/laptops");
			} 
			else 
			{
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."bienes/laptops/add");
			}
		} 
		else 
		{
			redirect(base_url()."bienes/laptops/add");
		}
	}

	public function view()
	{
		$id = $this->input->post("id");
		$data = array(
			"laptop" => $this->LapTops_model->infoLapTop($id),
			"tipo_propiedades" => $this->Tipo_propiedad_model->getTipo_propiedades(),
			"marcas" => $this->Marcas_model->getMarcas(),
			"areas" => $this->Areas_model->getAreas(),
			"mantenimientos" => $this->LapTops_model->getMantenimientos($id)
		);
		$this->load->view("admin/laptops/view", $data);
	}

	public function delete($id)
	{
		$laptop = $this->LapTops_model->getLapTop($id);

		$this->LapTops_model->delete($id);
		$this->backend_lib->savelog($this->modulo,"Eliminación de Lap-Top con No. de Serie ".$laptop->no_serie);
		echo "bienes/laptops";
	}

	public function edit($id)
	{
		$contenido_interno = array(
			"laptop" => $this->LapTops_model->getLapTop($id),
			"personas" => $this->Personas_model->getPersonas(),
			"tipo_propiedades" => $this->Tipo_propiedad_model->getTipo_propiedades(),
			"marcas" => $this->Marcas_model->getMarcas(),
			"status" => $this->Status_model->getStatus(),
			"ips" => $this->Ip_model->getIpLibreCPU()
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/laptops/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update()
	{
		$id = $this->input->post("idLaptop");
		$modelo = $this->input->post("modelo");
		$no_serie = $this->input->post("no_serie");
		$procesador = $this->input->post("procesador");
		$unidad_almacenamiento = $this->input->post("unidad_almacenamiento");
		$ram = $this->input->post("ram");
		$direccion_mac = $this->input->post("direccion_mac");
		$sistema_operativo = $this->input->post("sistema_operativo");
		$estado_bien = $this->input->post("estado_bien");
		$id_tipo_propiedad = $this->input->post("id_tipo_propiedad");
		$id_marca = $this->input->post("id_marca");
		$id_ip = $this->input->post("id_ip");
		$id_status = $this->input->post("id_status");

		/*if ($this->input->post("estado") ) {
			if ($this->input->post("estado") == 2) {
				$estado = 0;
			}
		}*/

		$data = array(
			"modelo" => $modelo,
			"no_serie" => $no_serie,
			"procesador" => $procesador,
			"unidad_almacenamiento" => $unidad_almacenamiento,
			"ram" => $ram,
			"estado_bien" => $estado_bien,
			"direccion_mac" => $direccion_mac,
			"sistema_operativo" => $sistema_operativo,
			"id_tipo_propiedad" => $id_tipo_propiedad,
			"id_marca" => $id_marca,
			"id_ip" => $id_ip,
			"id_status" => $id_status
		);

		if ($this->LapTops_model->update($id, $data)) 
		{
			$this->backend_lib->savelog($this->modulo,"Actualización de Lap-Top con No. de Serie ".$no_serie);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."bienes/laptops");
		} 
		else 
		{
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."bienes/laptops/edit/".$id);
		}	
	}

	public function addmantenimiento()
	{
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

		if ($this->LapTops_model->saveMante($data)) 
		{
			$laptop = $this->LapTops_model->getLapTop($id);
			$this->backend_lib->savelog($this->modulo,"Registro de Mantenimiento a Lap-Top con No. de Serie ".$laptop->no_serie);
			$this->LapTops_model->update($id,$dataMonitor);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."equipos/laptops");
		}
		else
		{
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."equipos/laptops");
		}
 	}

 	public function getMantenimientos()
 	{
 		$id = $this->input->post("idequipo");
 		$mantenimientos = $this->LapTops_model->getMantenimientos($id);
 		echo json_encode($mantenimientos);
 	}
}