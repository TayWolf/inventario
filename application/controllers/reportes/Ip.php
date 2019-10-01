<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ip extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Ip_model");
	}

	public function index(){
		$fecinicio = $this->input->post("fecinicio");
		$fecfin = $this->input->post("fecfin");

		if ($this->input->post("buscar")) {
			$ip = $this->Ip_model->getIpsReporte(false,"",$fecinicio,$fecfin);
		}
		else{
			$ip = $this->Ip_model->getIpsReporte(false,"");
		}

		$contenido_interno = array(
			"ip" => $ip,
			"fecinicio" => $fecinicio,
			"fecfin" => $fecfin

		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/reportes/ip",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}


	public function search(){
		$buscar = $this->input->post("buscar");
		$numeropagina = $this->input->post("nropagina");
		$cantidad = $this->input->post("cantidad");
		$checkfecha = $this->input->post("checkfecha");
		$fecfin = $this->input->post("fecfin");
		$fecinicio = $this->input->post("fecinicio");
		$inicio = ($numeropagina -1)*$cantidad;

		if ($checkfecha == 1) {
			$ip = $this->Ip_model->getIpsReporte(1,$buscar,$inicio,$cantidad,$fecinicio,$fecfin);
			$total = $this->Ip_model->getIpsReporte(1,$buscar,false,false,$fecinicio,$fecfin);
		}else{
			$ip = $this->Ip_model->getIpsReporte(1,$buscar,$inicio,$cantidad);
			$total = $this->Ip_model->getIpsReporte(1,$buscar);
		}
		
		
		$data = array(
			"ip" => $ip,
			"totalregistros" => count($total),
			"cantidad" =>$cantidad
			
		);
		echo json_encode($data);
	}

	public function exportar(){
		$fechainicio = $this->input->post("fechainicio");
		$fechafin = $this->input->post("fechafin");
		$searchfecha = $this->input->post("searchfecha");
		$search = $this->input->post("search");
		$tipoarchivo = $this->input->post("tipoarchivo");
		if ($tipoarchivo == 1) {
			//Cargamos la librería de excel.
	    	$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
	        $this->excel->getActiveSheet()->setTitle('IPs');
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

	        
	        //Le aplicamos negrita a los títulos de la cabecera.
	        $this->excel->getActiveSheet()->getStyle("A{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("B{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("C{$contador}")->getFont()->setBold(true);
	        
	        $this->excel->getActiveSheet()->getStyle("D{$contador}")->getFont()->setBold(true);
	        
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
	        $this->excel->getActiveSheet()->setCellValue("C1", 'FONCA');	
	        $this->excel->getActiveSheet()->setCellValue("D1",date("d-m-Y"));		        
	        $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'ID');
	        
	        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'IP');
	        
	        ;
	        $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'Estado');

	        if ($fechainicio != "" && $fechafin != "") {
	        	$ip = $this->Ip_model->getIpsReporte(false,$search,$fechainicio,$fechafin);
	        }else{
	        	$ip = $this->Ip_model->getIpsReporte(false,$search,false,false);
	        }


	         //Definimos la data del cuerpo.
	        $i = 1;
	        foreach($ip as $mon){
	        	//Incrementamos una fila más, para ir a la siguiente.
	        	$contador++;
	        	//Informacion de las filas de la consulta.
		        $this->excel->getActiveSheet()->setCellValue("A{$contador}", $mon->id); 
		        $this->excel->getActiveSheet()->setCellValue("B{$contador}", $mon->descripcion);
		        $status = $mon->estado == 1 ? "Ocupada":"Libre"; 
		        $this->excel->getActiveSheet()->setCellValue("C{$contador}", $status);

		        $i++;
	        }
	        //Le ponemos un nombre al archivo que se va a generar.
	        $archivo = "Listado_de_tablets".date("dmYHis").".xlsx";
	        header('Content-Type: application/vnd.ms-excel; charset=utf-8');
	        header('Content-Disposition: attachment;filename="'.$archivo.'"');
	        header('Cache-Control: max-age=0');
	        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007'); 
	        //Hacemos una salida al navegador con el archivo Excel.
	        $objWriter->save('php://output');
		}
		else{
			 $this->load->library('Pdf');
	        $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
	        
	  
	        $pdf->SetTitle('Reporte de IPs '.date("d-m-Y"));

			$pdf->SetPrintHeader(false);

			// Establecer el tipo de letra
			 
			//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
			// Helvetica para reducir el tamaño del archivo.
        	$pdf->SetFont('times', '', 10, '', true);

			// Añadir una página
			// Este método tiene varias opciones, consulta la documentación para más información.
			$pdf->AddPage("L");

        	//preparamos y maquetamos el contenido a crear
	        $html = '';
	        $html .= "<style type=text/css>";
	        $html .= "th{color: #fff; font-weight: bold; background-color: #222}";
	        $html .= "h1{text-align: center;}";
	        $html .="#content {position: relative;}";
	        $html .="
				#content img {
				    position: absolute;
				    top: 0px;
				    right: 0px;
				}";
	        /*$html .= "img{float: left; top:0; position:absolute;}";*/
	        $html .= "</style>";

	        $html .= '<table width="100%" cellpadding="3" border="1"><thead>';
	        $html .= '<tr>';

	        $html .= '<td width="15%" rowspan="2">
					<img src="'.base_url("assets/images/logo.png").'" width="30" height="30">
	        </td>';
	        $html .= '<td width="70%" rowspan="2" style="font-weight:bold;text-align:center;margin-top:30px !important;"><h1>Empresa de Transporte</h1></td>';
	        $html .= '<td width="15%" style="font-weight:bold;text-align:center;">Fecha</td>';
	        $html .= '</tr>';
	        $html .= '<tr>';

	        $html .= '<td style="text-align:center;">'.date("d-m-Y").'</td>';
	        $html .= '</tr>';
	        $html .= '</thead></table>';

	        $html .= '<h2 style="text-align:center;">Reportes de IPs</h2>';
	
	        $html .= '<table width="100%" cellpadding="3" border="1"><thead>';
	        $html .= '<tr>';
	        $html .= "<th>Nro.</th>";
            $html .= '<th>IP</th>';
            
            $html .= '<th>Estado</th></tr></thead><tbody>';
    

            if ($fechainicio != "" && $fechafin != "") {
	        	$ip = $this->Ip_model->getIpsReporte(false,$search,$fechainicio,$fechafin);
	        }else{
	        	$ip = $this->Ip_model->getIpsReporte(false,$search,false,false);
	        }
        
	        //provincias es la respuesta de la función getProvinciasSeleccionadas($provincia) del modelo
	         foreach ($ip as $mon){
	         	$html.='<tr>';
                $html.='<td>'.$mon->id.'</td>';
                
                $html.='<td>'.$mon->descripcion.'</td>';
                $status = $mon->estado == 1 ? "Ocupada":"Libre";
                $html.='<td>'.$status.'</td></tr>';
               
	         }

	         $html.='</tbody></table>';

			// Imprimimos el texto con writeHTMLCell()
        	$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 0, $fill = 0, $reseth = true, $align = '', $autopadding = true);

			// ---------------------------------------------------------
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
        	$nombre_archivo = utf8_decode("Reportes_de_Ips".date("dmYHis").".pdf");
        	$pdf->Output($nombre_archivo, 'D');
		}
	
	}
}