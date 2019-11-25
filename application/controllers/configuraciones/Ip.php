<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ip extends CI_Controller 
{
	private $modulo = "Ip";
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")) 
		{
			redirect(base_url());
		}
		$this->load->model("Ip_model");
	}

	public function index()
	{

		$contenido_interno = array(
			"ips" => $this->Ip_model->getIps(),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/ip/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add()
	{
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/ip/add","",TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store()
	{
		if ($this->input->post("guardar")) 
		{
			$direccion_ip = $this->input->post("direccion_ip");
			$rango_ip = $this->input->post("rango_ip");
			
			$data = array(
				"direccion_ip" => $direccion_ip,
				"rango_ip" => $rango_ip,
				"id_status" => 3
			);

			if ($this->Ip_model->save($data)) 
			{
				$this->backend_lib->savelog($this->modulo,"Inserción de la IP ".$direccion_ip);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."configuraciones/ip");
			} 
			else 
			{
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."configuraciones/ip/add");

			}
			
		} 
		else 
		{
			redirect(base_url()."configuraciones/ip/add");
		}	
	}

	public function view()
	{
		$id = $this->input->post("id");

		$data = array(
			"ip" => $this->Ip_model->getIp($id)
		);

		$this->load->view("admin/ip/view", $data);
	}

	public function delete($id)
	{
		$ip = $this->Ip_model->getIp($id);

		$this->Ip_model->delete($id);
		$this->backend_lib->savelog($this->modulo,"Eliminación de la IP ".$ip->direccion_ip);
		echo "configuraciones/ip";
	}

	public function edit($id)
	{
		$contenido_interno = array(
			"ip" => $this->Ip_model->getIp($id)
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/ip/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update()
	{
		$id = $this->input->post("idIp");
		$direccion_ip = $this->input->post("direccion_ip");
		$rango_ip = $this->input->post("rango_ip");

		$data = array(
			"direccion_ip" => $direccion_ip,
			"rango_ip" => $rango_ip
		);
		if ($this->Ip_model->update($id, $data)) 
		{
			$this->backend_lib->savelog($this->modulo,"Actualización de la IP ".$direccion_ip);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."configuraciones/ip");
		} 
		else 
		{
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."configuraciones/ip/edit/".$id);
		}
	}

	public function excel()
	{
		//Cargamos la librería de excel.
    	$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Ip\'\s');
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
        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Descripcion');
        $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'Estado');

        $antivirus = $this->Ip_model->getAntivirus();

         //Definimos la data del cuerpo.
        foreach($antivirus as $a)
        {
        	//Incrementamos una fila más, para ir a la siguiente.
        	$contador++;
        	//Informacion de las filas de la consulta.
			$this->excel->getActiveSheet()->setCellValue("A{$contador}", $a->id);
	        $this->excel->getActiveSheet()->setCellValue("B{$contador}", $a->descripcion);
	        $status = $a->estado == 1 ? "Ocupada":"Libre"; 
	        $this->excel->getActiveSheet()->setCellValue("C{$contador}", $status);
        }
        //Le ponemos un nombre al archivo que se va a generar.
        $archivo = "Listado_de_IP's.xls";
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
        $this->excel->getActiveSheet()->setTitle('IP\'\s');
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
        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Descripcion');
        $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'Estado');

        $antivirus = $this->Ip_model->getAntivirus();

         //Definimos la data del cuerpo.
        foreach($antivirus as $a)
        {
        	//Incrementamos una fila más, para ir a la siguiente.
        	$contador++;
        	//Informacion de las filas de la consulta.
			$this->excel->getActiveSheet()->setCellValue("A{$contador}", $a->id);
	        $this->excel->getActiveSheet()->setCellValue("B{$contador}", $a->descripcion);
	        $status = $a->estado == 1 ? "Ocupada":"Libre"; 
	        $this->excel->getActiveSheet()->setCellValue("C{$contador}", $status);
        }
        //Le ponemos un nombre al archivo que se va a generar.
        $archivo = "Listado_de_IP's.xls";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$archivo.'"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
        //Hacemos una salida al navegador con el archivo Excel.
        $objWriter->save('php://output');
	}
}