<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personas extends CI_Controller 
{
	private $modulo = "Personas";
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")) 
		{
			redirect(base_url());
		}
		$this->load->model("Personas_model");
		$this->load->model("Areas_model");
		$this->load->model("Cargos_model");
		$this->load->model("Status_model");
	}

	public function index()
	{
		$contenido_interno = array(
			"personas" => $this->Personas_model->getPersonas(),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/personas/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add()
	{
		$contenido_interno = array(
			"areas" => $this->Areas_model->getAreas(),
			"cargos" => $this->Cargos_model->getCargos(),
			"status" => $this->Status_model->getStatus()
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/personas/add",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store()
	{
		if ($this->input->post("guardar")) 
		{
			$nombres = $this->input->post("nombres");
			$apPat = $this->input->post("apPat");
			$apMat = $this->input->post("apMat");
			$sexo = $this->input->post("sexo");
			$curp = $this->input->post("curp");
			$rfc = $this->input->post("rfc");
			$id_area = $this->input->post("id_area");
			$id_cargo = $this->input->post("id_cargo");
			$file = $this->input->post("file");

			$data = array(
				"nombres" => $nombres,
				"ap_paterno" => $apPat,
				"ap_materno" => $apMat,
				"fecregistro_persona" => date("Y-m-d"),
				"sexo" => $sexo,
				"imagen_perfil" => $file,
				"curp" => $curp,
				"rfc" => $rfc,
				"id_area" => $id_area,
				"id_cargo" => $id_cargo,
				"id_status" => 1
			);

			if ($this->Personas_model->save($data)) 
			{
				$this->backend_lib->savelog($this->modulo,"Inserción de la Perosona ".$nombres." ".$apMat." ".$apPaT);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."configuraciones/personas");
			} 
			else 
			{
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."configuraciones/personas/add");
			}
		} 
		else 
		{
			redirect(base_url()."configuraciones/personas/add");
		}
	}

	public function view()
	{
		$id = $this->input->post("id");

		$data = array(
			"persona" => $this->Personas_model->getPersona($id)
		);

		$this->load->view("admin/personas/view", $data);
	}

	public function delete($id)
	{
		$propietario = $this->Personas_model->getPersona($id);

		$this->Personas_model->delete($id);
		$this->backend_lib->savelog($this->modulo,"Eliminación del propietario ".$propietario->nombre);
		echo "configuraciones/personas";
	}

	public function edit($id)
	{
		$contenido_interno = array(
			"persona" => $this->Personas_model->getPersona($id),
			"areas" => $this->Personas_model->getAreas(),
			"cargos" => $this->Personas_model->getCargos(),
			"status" => $this->Personas_model->getStatus()
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/personas/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update()
	{
		$id = $this->input->post("idPropietario");
		$nombre = $this->input->post("nombre");
		$apMat = $this->input->post("apMat");
		$apPaT = $this->input->post("apPat");
		$estado = 1;

		if ($this->input->post("estado") ) 
		{
			if ($this->input->post("estado") == 2) 
			{
				$estado = 0;
			}
		}
		$data = array(
			"nombre" => $nombre,
			"apMat" => $apMat,
			"apPat" => $apPat,
			"estado" => $estado
		);
		if ($this->Personas_model->update($id, $data)) {
			$this->backend_lib->savelog($this->modulo,"Actualización del propietario ".$nombre." ".$apMat." ".$apPaT);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."configuraciones/personas");
		} 
		else 
		{
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."configuraciones/personas/edit/".$id);
		}
	}

	public function excel()
	{
		//Cargamos la librería de excel.
    	$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Propietarios');
        //Contador de filas
        $contador = 2;
        //Le aplicamos ancho las columnas.
        /*$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);*/
        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        //Le aplicamos negrita a los títulos de la cabecera.
        $this->excel->getActiveSheet()->getStyle("A{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("B{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("C{$contador}")->getFont()->setBold(true);
        //Definimos los títulos de la cabecera.
        $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'Nro.');	        
        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Nombre(s)');
        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Apellido Materno');
        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Apellido Paterno');
        $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'Estado');

        $propietario = $this->Personas_model->getPersonas();

         //Definimos la data del cuerpo.
        foreach($propietario as $a)
        {
        	//Incrementamos una fila más, para ir a la siguiente.
        	$contador++;
        	//Informacion de las filas de la consulta.
			$this->excel->getActiveSheet()->setCellValue("A{$contador}", $a->id);
	        $this->excel->getActiveSheet()->setCellValue("B{$contador}", $a->nombre);
	        $this->excel->getActiveSheet()->setCellValue("B{$contador}", $a->apMat);
	        $this->excel->getActiveSheet()->setCellValue("B{$contador}", $a->apPat);
	        $status = $a->estado == 1 ? "Activo":"Inactivo"; 
	        $this->excel->getActiveSheet()->setCellValue("C{$contador}", $status);
        }
        //Le ponemos un nombre al archivo que se va a generar.
        $archivo = "Listado_de_propietarios.xls";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$archivo.'"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
        //Hacemos una salida al navegador con el archivo Excel.
        $objWriter->save('php://output');
	}

	public function excel2()
	{
		//Cargamos la librería de excel.
    	$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Propietarios');
        //Contador de filas
        $contador = 2;
        //Le aplicamos ancho las columnas.
        /*$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);*/
        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        //Le aplicamos negrita a los títulos de la cabecera.
        $this->excel->getActiveSheet()->getStyle("A{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("B{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("C{$contador}")->getFont()->setBold(true);
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
        $this->excel->getActiveSheet()->setCellValue("B1", 'Empresa de Transporte');	
        $this->excel->getActiveSheet()->setCellValue("C1",date("d-m-Y"));	
        $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'Nro.');	        
        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Nombre(s)');
        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Apellido Materno');
        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Apellido Paterno');
        $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'Estado');

        $propietario = $this->Personas_model->getPersonas();

         //Definimos la data del cuerpo.
        foreach($propietario as $a)
        {
        	//Incrementamos una fila más, para ir a la siguiente.
        	$contador++;
        	//Informacion de las filas de la consulta.
			$this->excel->getActiveSheet()->setCellValue("A{$contador}", $a->id);
	        $this->excel->getActiveSheet()->setCellValue("B{$contador}", $a->nombre);
	        $this->excel->getActiveSheet()->setCellValue("B{$contador}", $a->apMat);
	        $this->excel->getActiveSheet()->setCellValue("B{$contador}", $a->apPat);
	        $status = $a->estado == 1 ? "Activo":"Inactivo"; 
	        $this->excel->getActiveSheet()->setCellValue("C{$contador}", $status);
        }
        //Le ponemos un nombre al archivo que se va a generar.
        $archivo = "Listado_de_propietarios.xls";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$archivo.'"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
        //Hacemos una salida al navegador con el archivo Excel.
        $objWriter->save('php://output');
	}
}