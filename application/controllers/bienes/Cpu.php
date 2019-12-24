<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpu extends CI_Controller {
	private $modulo = "CPU";
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Computadoras_model");
		$this->load->model("Areas_model");
		$this->load->model("Ip_model");
		$this->load->model("Personas_model");
		$this->load->model("Marcas_model");
		$this->load->model("Tipo_propiedad_model");
		$this->load->model("Status_model");
	}

	public function index()
	{
		

		$contenido_interno = array(
			"computadoras" => $this->Computadoras_model->getComputadoras(false,""),
			"personas" => $this->Personas_model->getPersonas()
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/cpu/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add(){
		$contenido_interno = array(
			"areas" => $this->Areas_model->getAreas(),
			"propiedades" => $this->Tipo_propiedad_model->getTipo_propiedades(),
			"ips" => $this->Ip_model->getIpLibreCPU(),
			"status" => $this->Status_model->getStatus(),
			"marcas" => $this->Marcas_model->getMarcas(),
			"personas" => $this->Personas_model->getPersonas(),
			"fecregistro" => date("Y-m-d H:i:s"),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/cpu/add",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store(){
		if ($this->input->post("guardar")) {
			$no_serie = $this->input->post("no_serie");
			$monitor = $this->input->post("monitor");
			$no_break = $this->input->post("no_break");
			$marca = $this->input->post("marca");
			$modelo = $this->input->post("modelo");
			$procesador = $this->input->post("procesador");
			$unidad_almacenamiento = $this->input->post("unidad_almacenamiento");
			$ram = $this->input->post("ram");
			$direccion_mac = $this->input->post("direccion_mac");
			$tipo_propiedad = $this->input->post("tipo_propiedad");
			$sistema_operativo = $this->input->post("sistema_operativo");
			$ip = $this->input->post("ip");
			$status = $this->input->post("status");
			$so = $this->input->post("sistema");
			$serial_so = $this->input->post("serial_so");
			$office = $this->input->post("office");
			$serial_office = $this->input->post("serial_office");
			$antivirus = $this->input->post("antivirus");
			$ip = $this->input->post("ip");
			$mac = $this->input->post("mac");
			$bitacora = $this->input->post("bitacora");
			$personas = $this->input->post("personas");

			$data = array(
				"id_persona" => $personas,
				"id_elemento" => 1,
				"id_tipo_propiedad" => $tipo_propiedad,
				"modelo" => $modelo,
				"no_serie" => $no_serie,
				"monitor" => $monitor,
				"no_break" => $no_break,
				"id_marca" => $marca,
				"id_ip" => $ip,
				"procesador" => $procesador,
				"unidad_almacenamiento" => $unidad_almacenamiento,
				"ram" => $ram,
				"direccion_mac" => $direccion_mac,
				"fecregistro_bien" => date("Y-m-d H:i:s"), 
				"sistema_operativo" => $sistema_operativo,
				"estado_bien" => $bitacora,
				"id_usuario" => $this->session->userdata("id_usuario"),
				"id_status" => $status
			);

			if ($this->Computadoras_model->save($data)) {

				$ip = $this->Ip_model->getIp($id_ip);
				$data = array(
					"id_status" => 4
				);
				$this->Ip_model->update($id_ip, $data);

				$this->backend_lib->savelog($this->modulo,"Inserción de un nuevo CPU con No. de Serie ".$no_serie);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."bienes/cpu");
			} else {
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."bienes/cpu/add");

			}
			
		} else {
			redirect(base_url()."bienes/cpu/add");
		}
		
	}

	public function view()
	{
		$id_bien = $this->input->post("id");

		$data = array(
			"bienes" => $this->Computadoras_model->infoComputadora($id_bien),
			"mantenimientos" => $this->Computadoras_model->getMantenimientos($id_bien)
		);

		$this->load->view("admin/cpu/view", $data);
	}

	public function delete($id_bien){
		
		$cpu = $this->Computadoras_model->getComputadora($id_bien);
		
		$this->Computadoras_model->delete($id_bien);
		$this->backend_lib->savelog($this->modulo,"Eliminación del CPU con No. de Serie ".$cpu->no_serie);
		echo "bienes/cpu";
	}

	public function edit($id_bien){
		$contenido_interno = array(
			"computadora" => $this->Computadoras_model->getComputadora($id_bien),
			"areas" => $this->Areas_model->getAreas(),
			"propiedades" => $this->Tipo_propiedad_model->getTipo_propiedades(),
			"ips" => $this->Ip_model->getIpLibreCPU(),
			"status" => $this->Status_model->getStatus(),
			"marcas" => $this->Marcas_model->getMarcas(),
			"personas" => $this->Personas_model->getPersonas()
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/cpu/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idBien");
		$no_serie = $this->input->post("no_serie");
		$monitor = $this->input->post("monitor");
		$no_break = $this->input->post("no_break");
		$marca = $this->input->post("marca");
		$modelo = $this->input->post("modelo");
		$procesador = $this->input->post("procesador");
		$unidad_almacenamiento = $this->input->post("unidad_almacenamiento");
		$ram = $this->input->post("ram");
		$direccion_mac = $this->input->post("direccion_mac");
		$tipo_propiedad = $this->input->post("tipo_propiedad");
		$sistema_operativo = $this->input->post("sistema_operativo");
		$ip = $this->input->post("ip");
		$status = $this->input->post("status");
		$personas = $this->input->post("personas");
		$bitacora = $this->input->post("bitacora");

		/*$estado = 1;
		if ($this->input->post("estado") ) {
			if ($this->input->post("estado") == 2) {
				$estado = 0;
			}
		}*/
		$data = array(
			"no_serie" => $no_serie,
			"id_persona" => $personas,
			"id_elemento" => 1,
			"id_tipo_propiedad" => $tipo_propiedad,
			"modelo" => $modelo,
			"no_serie" => $no_serie,
			"monitor" => $monitor,
			"no_break" => $no_break,
			"id_marca" => $marca,
			"id_ip" => $ip,
			"procesador" => $procesador,
			"unidad_almacenamiento" => $unidad_almacenamiento,
			"ram" => $ram,
			"direccion_mac" => $direccion_mac,
			"fecregistro_bien" => date("Y-m-d H:i:s"),
			"sistema_operativo" => $sistema_operativo,
			"estado_bien" => $bitacora,
			"id_usuario" => $this->session->userdata("id_usuario"),
			"id_status" => $status,
		);
		if ($this->Computadoras_model->update($id, $data)) {
			$this->backend_lib->savelog($this->modulo,"Actualización del CPU con No. de Serie ".$no_serie);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."bienes/cpu");
		} else {
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."bienes/cpu/edit/".$id);

		}
		
	}

	public function addmantenimiento(){
		$id = $this->input->post("idequipo");
		$fecha = $this->input->post("fecha");
		$descripcion = $this->input->post("descripcion");

		$data = array(
			"id_bien" => $id,
			"id_usuario" => $this->session->userdata("id_usuario"),
			"fecha_mantenimiento" => $fecha,
			"motivo_mantenimiento" => $descripcion,
			"id_status" => 9
		);

		$dataComp = array(
			"ultimo_mantenimiento" => $fecha
		);



		if ($this->Computadoras_model->saveMante($data)) {
			$computadora = $this->Computadoras_model->getComputadora($id);
			$this->backend_lib->savelog($this->modulo,"Registro de Mantenimiento al CPU con No. Serie ".$computadora->no_serie);

			$this->Computadoras_model->update($id,$dataComp);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."bienes/cpu");
		}else{
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."bienes/cpu");
		}

 	}

 	public function getMantenimientos()
 	{
 		$id = $this->input->post("idequipo");
 		$mantenimientos = $this->Computadoras_model->getMantenimientos($id);
 		echo json_encode($mantenimientos);
 	}

 	public function addUsuarios(){
		$id = $this->input->post("idPropietario");
		$nombre = $this->input->post("nombre");

		$data = array(
			"id" => $id,
			"id_propietario" => $nombre
		);

		if ($this->Computadoras_model->savePropietario($data)) {
			$computadora = $this->Computadoras_model->getComputadora($id);
			$this->backend_lib->savelog($this->modulo,"Registro de Propietario al equipo ".$computadora->codigo);

			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."bienes/cpu");
		}else{
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."bienes/cpu");
		}

 	}

 	public function getUsuarios(){
 		$id = $this->input->post("idPropietario");
 		$mantenimientos = $this->Computadoras_model->getPropietarios($id);
 		echo json_encode($mantenimientos);
 	}

 	public function excel(){
		//Cargamos la librería de excel.
    	$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Antivirus');
        //Contador de filas
        $contador = 3;
        //Le aplicamos ancho las columnas.
        /*$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);*/
        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
        //Le aplicamos negrita a los títulos de la cabecera.
        $this->excel->getActiveSheet()->getStyle("A{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("B{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("C{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("C{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("D{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("E{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("F{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("G{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("H{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("I{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("J{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("K{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("L{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("M{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("N{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("O{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("P{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("Q{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("R{$contador}")->getFont()->setBold(true);
       	$this->excel->getActiveSheet()->getStyle("S{$contador}")->getFont()->setBold(true);
       	$this->excel->getActiveSheet()->getStyle("T{$contador}")->getFont()->setBold(true);
       	$this->excel->getActiveSheet()->getStyle("U{$contador}")->getFont()->setBold(true);
       	$this->excel->getActiveSheet()->getStyle("V{$contador}")->getFont()->setBold(true);
        //
        $this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(35);
        $objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName("logo");
		$objDrawing->setDescription("Tt's my logo");
		$objDrawing->setPath("./assets/images/logo.png");
		$objDrawing->setOffsetY(10);
		$objDrawing->setOffsetX(10);
		$objDrawing->setCoordinates('A1');
		$objDrawing->setWidth(30);
		$objDrawing->setHeight(30);
		$objDrawing->setWorksheet($this->excel->getActiveSheet());

        //Definimos los títulos de la cabecera.
        $this->excel->getActiveSheet()->setCellValue("C1", 'Empresa de Transporte');	
        $this->excel->getActiveSheet()->setCellValue("D1",date("d-m-Y"));	
        $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'Nro.');	        
        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Codigo');
        $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'Presentacion');
        $this->excel->getActiveSheet()->setCellValue("D{$contador}", 'Proveedor');
        $this->excel->getActiveSheet()->setCellValue("E{$contador}", 'Contacto');
        $this->excel->getActiveSheet()->setCellValue("F{$contador}", 'Fabricante');
        $this->excel->getActiveSheet()->setCellValue("G{$contador}", 'Finca');
        $this->excel->getActiveSheet()->setCellValue("H{$contador}", 'Area');
        $this->excel->getActiveSheet()->setCellValue("I{$contador}", 'Procesador');
        $this->excel->getActiveSheet()->setCellValue("J{$contador}", 'Disco Duro');
        $this->excel->getActiveSheet()->setCellValue("K{$contador}", 'Monitor');
        $this->excel->getActiveSheet()->setCellValue("L{$contador}", 'Memoria RAM');
        $this->excel->getActiveSheet()->setCellValue("M{$contador}", 'Sistema Operativo');
        $this->excel->getActiveSheet()->setCellValue("N{$contador}", 'Serial S.O');
        $this->excel->getActiveSheet()->setCellValue("O{$contador}", 'Antivirus');
        $this->excel->getActiveSheet()->setCellValue("P{$contador}", 'Bitacora');
        $this->excel->getActiveSheet()->setCellValue("Q{$contador}", 'IP');
        $this->excel->getActiveSheet()->setCellValue("R{$contador}", 'MAC');
        $this->excel->getActiveSheet()->setCellValue("S{$contador}", 'Ultimo Mant.');
        $this->excel->getActiveSheet()->setCellValue("T{$contador}", 'Usuario');
        $this->excel->getActiveSheet()->setCellValue("U{$contador}", 'Fec. Registro');
        $this->excel->getActiveSheet()->setCellValue("V{$contador}", 'Estado');

        $computadoras = $this->Computadoras_model->getComputadoras();

         //Definimos la data del cuerpo.
        $i = 1;
        foreach($computadoras as $c){
        	//Incrementamos una fila más, para ir a la siguiente.
        	$contador++;
        	//Informacion de las filas de la consulta.
			$this->excel->getActiveSheet()->setCellValue("A{$contador}", $i);
	        $this->excel->getActiveSheet()->setCellValue("B{$contador}", $c->codigo);
	        $this->excel->getActiveSheet()->setCellValue("C{$contador}", $c->presentacion);
	        $this->excel->getActiveSheet()->setCellValue("D{$contador}", $c->proveedor);
	        $this->excel->getActiveSheet()->setCellValue("E{$contador}", $c->contacto);
	        $this->excel->getActiveSheet()->setCellValue("F{$contador}", $c->fabricante);
	        $this->excel->getActiveSheet()->setCellValue("G{$contador}", $c->finca);
	        $this->excel->getActiveSheet()->setCellValue("H{$contador}", $c->area);
	        $this->excel->getActiveSheet()->setCellValue("I{$contador}", $c->velocidad);
	        $this->excel->getActiveSheet()->setCellValue("J{$contador}", $c->disco);
	        $this->excel->getActiveSheet()->setCellValue("K{$contador}", $c->monitor);
	        $this->excel->getActiveSheet()->setCellValue("L{$contador}", $c->memoria);
	        $this->excel->getActiveSheet()->setCellValue("M{$contador}", $c->sistema);
	        $this->excel->getActiveSheet()->setCellValue("N{$contador}", $c->serial_so);
	        $this->excel->getActiveSheet()->setCellValue("O{$contador}", $c->antivirus);
	        $this->excel->getActiveSheet()->setCellValue("P{$contador}", $c->bitacora);
	        $this->excel->getActiveSheet()->setCellValue("Q{$contador}", $c->ip);
	        $this->excel->getActiveSheet()->setCellValue("R{$contador}", $c->mac);
	        $this->excel->getActiveSheet()->setCellValue("S{$contador}", $c->ultimo_mante);
	        $this->excel->getActiveSheet()->setCellValue("T{$contador}", $c->nombres);
	        $this->excel->getActiveSheet()->setCellValue("U{$contador}", $c->fecregistro);
	        $status = $c->estado == 1 ? "Activo":"Inactivo"; 
	        $this->excel->getActiveSheet()->setCellValue("V{$contador}", $status);

	        $i++;
        }
        //Le ponemos un nombre al archivo que se va a generar.
        $archivo = "Listado_de_computadoras".date("dmYHis").".xls";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$archivo.'"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
        //Hacemos una salida al navegador con el archivo Excel.
        $objWriter->save('php://output');

	}
}