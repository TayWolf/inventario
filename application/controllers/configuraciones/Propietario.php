<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Propietario extends CI_Controller {
	private $modulo = "Propietario";
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Propietario_model");
	}

	public function index()
	{

		$contenido_interno = array(
			"propietarios" => $this->Propietario_model->getPropietarios(),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/propietario/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add(){
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/propietario/add","",TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store(){
		if ($this->input->post("guardar")) {
			$nombre = $this->input->post("nombre");
			$apMat = $this->input->post("apMat");
			$apPat = $this->input->post("apPat");

			$data = array(
				"nombre" => $nombre,
				"apMat" => $apMat,
				"apPat" => $apPat,
				"estado" => 1
			);

			if ($this->Propietario_model->save($data)) {
				$this->backend_lib->savelog($this->modulo,"Inserción del propietario ".$nombre." ".$apMat." ".$apPaT);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."configuraciones/propietario");
			} else {
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."configuraciones/propietario/add");

			}
			
		} else {
			redirect(base_url()."configuraciones/propietario/add");
		}
		
	}

	public function view(){
		$id = $this->input->post("id");

		$data = array(
			"propietario" => $this->Propietario_model->getPropietario($id)
		);

		$this->load->view("admin/propietario/view", $data);
	}
	public function delete($id){
		$propietario = $this->Propietario_model->getPropietario($id);

		$this->Propietario_model->delete($id);
		$this->backend_lib->savelog($this->modulo,"Eliminación del propietario ".$propietario->nombre);
		echo "configuraciones/propietario";
	}

	public function edit($id){
		$contenido_interno = array(
			"propietario" => $this->Propietario_model->getPropietario($id)
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/propietario/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idPropietario");
		$nombre = $this->input->post("nombre");
		$apMat = $this->input->post("apMat");
		$apPaT = $this->input->post("apPat");
		$estado = 1;

		if ($this->input->post("estado") ) {
			if ($this->input->post("estado") == 2) {
				$estado = 0;
			}
		}
		$data = array(
			"nombre" => $nombre,
			"apMat" => $apMat,
			"apPat" => $apPat,
			"estado" => $estado
		);
		if ($this->Propietario_model->update($id, $data)) {
			$this->backend_lib->savelog($this->modulo,"Actualización del propietario ".$nombre." ".$apMat." ".$apPaT);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."configuraciones/propietario");
		} else {
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."configuraciones/propietario/edit/".$id);

		}

		
	}

	public function excel(){
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

        $propietario = $this->Propietario_model->getPropietarios();

         //Definimos la data del cuerpo.
        foreach($propietario as $a){
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

	public function excel2(){
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

        $propietario = $this->Propietario_model->getPropietarios();

         //Definimos la data del cuerpo.
        foreach($propietario as $a){
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