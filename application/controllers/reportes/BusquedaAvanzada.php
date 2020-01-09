<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BusquedaAvanzada extends CI_Controller 
{
	private $modulo = "Reportes";
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("BusquedaAvanzada_model");
	}

	public function index()
	{
		$fecinicio = $this->input->post("fecinicio");
		$fecfin = $this->input->post("fecfin");

		if ($this->input->post("buscar")) 
		{
			$impresoras = $this->BusquedaAvanzada_model->getBienes(false,"",$fecinicio,$fecfin);
		}
		else
		{
			$impresoras = $this->BusquedaAvanzada_model->getBienes(false,"");
		}

		$contenido_interno = array(
			"impresoras" => $impresoras,
			"fecinicio" => $fecinicio,
			"fecfin" => $fecfin

		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/reportes/busquedaavanzada",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function formulario()
	{
		$tipoarchivo = $this->input->post("tipoarchivo");

		if ($tipoarchivo = $this->input->post("tipoarchivo") == '') 
		{
			redirect(base_url()."reportes/busquedaavanzada");
		}

		else if ($tipoarchivo = $this->input->post("tipoarchivo") == 1) 
		{
			$contenido_interno = array(
			"fecregistro" => date("Y-m-d H:i:s"),
			);
			$contenido_externo = array(
				"contenido" => $this->load->view("admin/reportes/fonca/prestamointerno",$contenido_interno,TRUE)
			);
			$this->load->view('admin/template', $contenido_externo);
		}
		else if ($tipoarchivo = $this->input->post("tipoarchivo") == 2) 
		{
			$contenido_interno = array(
			"fecregistro" => date("Y-m-d H:i:s"),
			);
			$contenido_externo = array(
				"contenido" => $this->load->view("admin/reportes/fonca/prestamoexterno",$contenido_interno,TRUE)
			);
			$this->load->view('admin/template', $contenido_externo);
		}
		else if ($tipoarchivo = $this->input->post("tipoarchivo") == 3) 
		{
			$contenido_interno = array(
			"fecregistro" => date("Y-m-d H:i:s"),
			);
			$contenido_externo = array(
				"contenido" => $this->load->view("admin/reportes/fonca/resguardobienesti",$contenido_interno,TRUE)
			);
			$this->load->view('admin/template', $contenido_externo);
		}
		else if ($tipoarchivo = $this->input->post("tipoarchivo") == 4) 
		{
			$contenido_interno = array(
			"fecregistro" => date("Y-m-d H:i:s"),
			);
			$contenido_externo = array(
				"contenido" => $this->load->view("admin/reportes/fonca/resguardoimpresoras",$contenido_interno,TRUE)
			);
			$this->load->view('admin/template', $contenido_externo);
		}
	}

	public function generarPDF()
	{
		$tipoarchivo = $this->input->post("tipoarchivo");
		
		if ($tipoarchivo = $this->input->post("tipoarchivo") == 0) 
		{
			
		}
		elseif ($tipoarchivo = $this->input->post("tipoarchivo") == 1) 
		{
			$this->load->library('Pdf');
	        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	        
	  
	        $pdf->SetTitle('Formato-Préstamo Interno de equipo de cómputo');

			$pdf->SetPrintHeader(false);

			// Establecer el tipo de letra
			 
			//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
			// Helvetica para reducir el tamaño del archivo.
	    	$pdf->SetFont('helvetica', '', 10, '', true);

			// Añadir una página
			// Este método tiene varias opciones, consulta la documentación para más información.
			$pdf->AddPage("P");

	    	//preparamos y maquetamos el contenido a crear
	        $html = '';
	        $html .= "<style type=text/css>";
	        $html .= "th{color: #fff; font-weight: bold; background-color: #222}";
	        $html .= "h1{text-align: center;}";
	        $html .= "div.border{border: 2px solid black;}";
	        /*$html .= "img{float: left; top:0; position:absolute;}";*/
	        $html .= "</style>";

	        $html .= '<img src="'.base_url("assets/images/cultura_fonca.png").'">';
	        
	        $html .= '<h1 style="text-align:center;">Fondo Nacional para la Cultura y las Artes</h1>';
	        $html .= '<h2 style="text-align:center;">Subdirección de Evaluación e Informática</h2>';
	        $html .= '<h2 style="text-align:center;margin-top:0;">Formato de Préstamo de equipo de cómputo</h2>';

	        $html .= '<table width="100%" cellpadding="2"><tbody>';
	        $html.='<tr nobr="true">';
            $html.='<td style="text-align:left;width: 100px;">Fecha de Préstamo: </td>';
            $html.='<td colspan="3" style="text-align:center;"> 30 de Diciembre 2019</td></tr>';
	        $html.='<tr nobr="true">';
            $html.='<td style="text-align:left;width: 100px;">Nombre: </td>';
            $html.='<td colspan="3" style="text-align:left;border-bottom: 1px solid black"> NOMBRE DEL SOLICITANTE</td></tr>';
	        $html.='<tr nobr="true">';
            $html.='<td style="text-align:left;width: 100px;">Área: </td>';
            $html.='<td colspan="3" style="text-align:left;border-bottom: 1px solid black"> ÁREA</td></tr>';
	        $html.='</tbody></table>';

	        $html.='<br><br>';

	        $html .= '<table width="100%" cellpadding="3" border="1"><thead>';
	        $html .= '<tr>';
	        $html .= '<th style="text-align:center;">Descripción</th>';
	        $html .= '<th style="text-align:center;">Marca</th>';
	        $html .= '<th style="text-align:center;">Modelo</th>';
	        $html .= '<th style="text-align:center;">No. de Serie</th>';
	        $html .= '<th style="text-align:center;">IP</th>';
	        $html .= '<th style="text-align:center;">Fec. Préstamo.</th></tr></thead><tbody>';

	        //provincias es la respuesta de la función getProvinciasSeleccionadas($provincia) del modelo
	        $html.='<tr nobr="true">';
            $html.='<td style="text-align:center;word-wrap: break-word;">Laptop</td>';
            $html.='<td style="text-align:center;word-wrap: break-word;">Lenovo</td>';
            $html.='<td style="text-align:center;word-wrap: break-word;">S/N</td>';
            $html.='<td style="text-align:center;word-wrap: break-word;">MK9038DIU</td>';
            $html.='<td style="text-align:center;word-wrap: break-word;">172.17.124.174</td>';
            $html.='<td style="text-align:center;word-wrap: break-word;">30/12/2019</td></tr>';

	        /*foreach ($impresoras as $imp)
	        {
	         	$html.='<tr nobr="true">';
	            $html.='<td style="text-align:center;">'.$imp->descripcion_prestamo.'</td>';
	            $html.='<td style="text-align:center;">'.$imp->marca.'</td>';
	            $html.='<td colspan="2" style="text-align:center;">'.$imp->modelo.'</td>';
	            $html.='<td style="text-align:center;">'.$imp->no_serie.'</td>';
	            $html.='<td style="text-align:center;">'.$imp->id_ip.'</td>';
	            $html.='<td style="text-align:center;">'.$imp->fecprestamo_bien.'</td></tr>';
	        }*/

	        $html.='</tbody></table>';

	        $html.='<br><br><br><br><br>';

	        $html.='<table width="100%" cellpadding="2"><tbody>';
	        $html.='<tr nobr="true">';
	        $html.='<td colspan="3"></td>';
            $html.='<td colspan="2" style="text-align:center;border-top: 1px solid black; width: 200px;">Firma del Usuario</td></tr>';
	        $html.='</tbody></table>';

	        $html.='<br>';

	        $html.='<p>El usuario deberá responder por cualquier daño o pérdida parcial o total, será su responsabilidad devolver el equipo de cómputo o dispositivo en buenas condiciones dentro del horario establecido de servicio.</p><br><br><br><br><br><br>';

	        $html.='<table width="100%" border="2">';
            $html.='<br>';
	        $html.='<table width="100%" cellpadding="3"><tbody>';
            $html.='<br><br>';
	        $html.='<tr nobr="true">';
            $html.='<td style="text-align:left;width: 150px;">Fecha de Devolcuión: </td>';
            $html.='<td style="text-align:center;border-bottom: 1px solid black;width: 100px;">'.date("d").' de '.date("F").' '.date("Y").'</td></tr>';
            $html.='<br><br><br><br><br><br>';
	        $html.='<tr nobr="true">';
            $html.='<td style="width: 20px;"></td>';
            $html.='<td colspan="3" style="text-align:center;border-top: 1px solid black;width: 200px;"> Nombre y Firma del usuario que <br>devuelve el equipo</td>';
            $html.='<td style="width: 100px;"></td>';
            $html.='<td colspan="3" style="text-align:center;border-top: 1px solid black;width: 200px;"> Nombre y Firma de quien recibe <br>(Personal de Informática)</td></tr>';
            $html.='<br><br>';
            $html.='<tr nobr="true">';
            $html.='<td style="text-align:left;width: 100px;">Observaciones</td></tr>';
            $html.='<br>';
            $html.='<tr nobr="true">';
            $html.='<td style="width: 20px;"></td>';
            $html.='<td colspan="7" style="text-align:justify;border-bottom: 1px solid black;">Observaciones</td></tr>';
	        $html.='</tbody></table>';
            $html.='<br><br>';
	        $html.='</table>';
			// Imprimimos el texto con writeHTMLCell()
	    	$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 0, $fill = 0, $reseth = true, $align = '', $autopadding = true);

			// ---------------------------------------------------------
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
	    	$nombre_archivo = utf8_decode("Formato-Préstamo Interno de equipo de cómputo_".date("dmYHis").".pdf");
	    	$pdf->Output($nombre_archivo, 'I');
		}
		elseif ($tipoarchivo = $this->input->post("tipoarchivo") == 2) 
		{
			$this->load->library('Pdf');
	        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	        
	  
	        $pdf->SetTitle('Formato-Préstamo Externo de equipo de cómputo');

			$pdf->SetPrintHeader(false);

			// Establecer el tipo de letra
			 
			//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
			// Helvetica para reducir el tamaño del archivo.
	    	$pdf->SetFont('helvetica', '', 10, '', true);

			// Añadir una página
			// Este método tiene varias opciones, consulta la documentación para más información.
			$pdf->AddPage("P");

	    	//preparamos y maquetamos el contenido a crear
	        $html = '';
	        $html .= "<style type=text/css>";
	        $html .= "th{color: #fff; font-weight: bold; background-color: #222}";
	        $html .= "td.sn{padding:0;}";
	        $html .= "h2{text-align: center;margin-top:0;}";
	        $html .="#content {position: relative;}";
	        $html .="
				#content img {
				    position: absolute;
				    top: 0px;
				    right: 0px;
				}";
	        /*$html .= "img{float: left; top:0; position:absolute;}";*/
	        $html .= "</style>";

	        $html .= '<img src="'.base_url("assets/images/cultura_fonca.png").'">';
	        
	        $html .= '<h2 style="text-align:center;">FONDO NACIONAL PARA LA CULTURA Y LAS ARTES</h2>';
	        $html .= '<h3 style="text-align:center;">SUBDIRECCIÓN DE EVALUACIÓN E INFORMÁTICA</h3>';
	        $html .= '<h3 style="text-align:center;margin-top:0;">FORMATO DE AUTORIZACIÓN DE SALIDA DE EQUIPO</h3>';

	        $html .= '<table width="100%" cellpadding="1"><thead>';
	        $html .= '<tr>';
	        $html .= '<td style="text-align:right;">1 de Enero 2020</td>';
	        $html .= '</tr>';
	        $html .= '</thead></table>';

	        $html .= '<table width="100%" cellpadding="2"><tbody>';
	        $html.='<tr nobr="true">';
            $html.='<td style="text-align:left;width: 100px;">Área Solicitante: </td>';
            $html.='<td colspan="3" style="text-align:left;border-bottom: 1px solid black"> JÓVENES CREADORES</td></tr>';
	        $html.='<tr nobr="true">';
            $html.='<td style="text-align:left;width: 100px;">Destino del bien: </td>';
            $html.='<td colspan="3" style="text-align:left;border-bottom: 1px solid black"> FOTO MUSEO CUATRO CAMINOS</td></tr>';
	        $html.='<tr nobr="true">';
            $html.='<td style="text-align:left;width: 100px;">Hora de salida: </td>';
            $html.='<td colspan="3" style="text-align:left;border-bottom: 1px solid black"> Libre</td></tr>';
	        $html.='</tbody></table>';

	        $html.='<table width="100%"><tbody>';
	        $html.='<br><br>';
            $html.='<tr nobr="true">';
            $html.='<td style="text-align:left;width: 110px;">Características del bien:</td>';
            $html.='<td style="text-align:left;width: 45px;"> Muebles </td>';
            $html.='<td style="text-align:center;border: 1px solid black;width: 50px;"></td>';
            $html.='<td style="text-align:left;"> Documental </td>';
            $html.='<td style="text-align:center;border: 1px solid black;width: 50px;"></td>';
            $html.='<td style="text-align:left;width: 48px;"> Cómputo </td>';
            $html.='<td style="text-align:center;border: 1px solid black;width: 50px;">XXX</td>';
            $html.='<td style="text-align:left;width: 28px;"> Otro </td>';
            $html.='<td style="text-align:center;border: 1px solid black;width: 50px;"></td></tr>';
	        $html.='</tbody></table>';

	        $html.='<table width="100%" cellpadding="2"><tbody>';
	        $html.='<br><br>';
	        $html.='<tr nobr="true">';
            $html.='<td style="text-align:left;width: 100px;">Especifique: </td>';
            $html.='<td colspan="3" style="text-align:left;border-bottom: 1px solid black">Especificación</td></tr>';
	        $html.='</tbody></table>';

	        $html.='<br><br><br>';

	        $html.='<table width="100%" cellpadding="2" border="1"><thead>';
	        $html.='<tr>';
	        $html.='<th style="text-align:center;">#</th>';
	        $html.='<th colspan="3" style="text-align:center;">DESCRIPCIÓN</th>';
	        $html.='<th style="text-align:center;">MARCA</th>';
	        $html.='<th style="text-align:center;">N. SERIE</th>';
	        $html.='<th style="text-align:center;">IP</th></tr></thead><tbody>';
	    
	        //provincias es la respuesta de la función getProvinciasSeleccionadas($provincia) del modelo
	        // foreach ($impresoras as $imp)
	        // {
	         	$html.='<tr nobr="true">';
	            $html.='<td style="text-align:center;">1</td>';
	            $html.='<td colspan="2" style="text-align:center;">LAPTOP</td>';
	            $html.='<td style="text-align:center;">LENOVO</td>';
	            $html.='<td colspan="2" style="text-align:center;">MP1C834A</td>';
	            $html.='<td style="text-align:center;">172.17.124.168</td></tr>';
	        // }
	        $html.='</tbody></table>';
	        
	        $html.='<br><br>';

	        $html.='<table width="100%" cellpadding="2"><tbody>';
	        $html.='<br><br>';
	        $html.='<tr nobr="true">';
            $html.='<td style="text-align:left;width: 100px;">Observaciones: </td>';
            $html.='<td colspan="3" style="text-align:left;border-bottom: 1px solid black">Observacion</td></tr>';
	        $html.='</tbody></table>';

            $html.='<br><br><br><br><br><br>';

	        $html.='<table width="100%" cellpadding="3"><tbody>';
	        $html.='<tr nobr="true">';
            $html.='<td style="width: 20px;"></td>';
            $html.='<td colspan="3" style="text-align:center;border-bottom: 1px solid black;width: 200px;"> Autoriza <br>Ing. Raúl Cruz Fonseca<br><br><br></td>';
            $html.='<td style="width: 100px;"></td>';
            $html.='<td colspan="3" style="text-align:center;border-bottom: 1px solid black;width: 200px;"> Retira <br>Daniel Limón</td></tr>';
            $html.='<tr nobr="true">';
            $html.='<td style="width: 70px;"></td>';
            $html.='<td style="text-align:center;width: 100px;">INFORMÁTICA </td>';
            $html.='<td style="width: 180px;"></td>';
            $html.='<td style="text-align:center;width: 150px;">JÓVENES CREADORES</td></tr>';
            $html.='</tbody></table>';

			// Imprimimos el texto con writeHTMLCell()
	    	$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 0, $fill = 0, $reseth = true, $align = '', $autopadding = true);

			// ---------------------------------------------------------
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
	    	$nombre_archivo = utf8_decode("Reportes_de_impresoras_".date("dmYHis").".pdf");
	    	$pdf->Output($nombre_archivo, 'I');
		}
		elseif ($tipoarchivo = $this->input->post("tipoarchivo") == 3) 
		{
			$this->load->library('Pdf');
	        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	        
	        $pdf->SetTitle('Formato-Resguardo de bienes informáticos(Mainbit)_'.date("d-m-Y H:i:s"));

			$pdf->SetPrintHeader(false);
			// Establecer el tipo de letra
			
			//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
			// Helvetica para reducir el tamaño del archivo.
	    	$pdf->SetFont('helvetica', '', 11, '', true);

			// Añadir una página
			// Este método tiene varias opciones, consulta la documentación para más información.
			$pdf->AddPage("P");

	    	//preparamos y maquetamos el contenido a crear
	        $html = '';
	        $html .= "<style type=text/css>";
	        $html .= "th{color: #000; font-weight: bold;font-size:8px;}";
	        $html .= "td{font-size:8px;font-weight: bold;}";
	        $html .= "h2{text-align: center;margin-top:0;}";
	        $html .="#content {position: relative;}";
	        $html .="
				#content img.left {
				    position: absolute;
				    top: 0px;
				    right: 0px;
				    width: 100px;
				}";
	        /*$html .= "img{float: left; top:0; position:absolute;}";*/
	        $html.= "</style>";

	        $html.='<table width="70%" cellpadding="2"><thead>';
	        $html.='<tr>';
	        $html.='<td width="35%"><img width="200" src="'.base_url("assets/images/mainbit.png").'"></td>';
	        $html.='<td width="70%" rowspan="2" style="font-weight:bold;text-align:center;margin-top:30px !important;"><h4>RESGUARDO DE BIENES INFORMÁTICOS</h4><br><small>AC-0112</small></td>';
	        $html.='<td width="39%"><img width="200" src="'.base_url("assets/images/logo.png").'"></td>';
	        $html.='</tr>';
	        $html.='</thead></table>';

	        $html.='<p style="text-align:justify;font-size: 10px;">Derivado de la contratación de los servicios de Cómputo Administrado los cuales son provistos a través de la Empresa Mainbit, S.A. de C.V.; sirva la Presente Liberación de Bienes Informáticos, para hacer valer la recepción del mismo por la finalización del proyecto.</p>';

	        $html.='<table width="100%" cellpadding="2" border="1"><thead>';
	        $html.='<tr>';
	        $html.="<th>NOMBRE DEL EQUIPO: V5T43555</th>";
	        $html.='<th style="text-align:left;">MOVIMIENTO: BAJA</th></tr></thead><tbody>';
	    
	        //provincias es la respuesta de la función getProvinciasSeleccionadas($provincia) del modelo
	        // foreach ($impresoras as $imp)
	        // {
	         	/*$html.='<tr nobr="true">';
	            $html.='<td style="text-align:center;">'.$imp->id_bien.'</td>';
	            $html.='<td style="text-align:center;">'.$imp->no_serie.'</td>';
	            $html.='<td colspan="2" style="text-align:center;">'.$imp->modelo.'</td>';
	            $html.='<td style="text-align:center;">'.$imp->elemento.'</td>';
	            $html.='<td style="text-align:center;">'.$imp->id_ip.'</td>';
	            $html.='<td style="text-align:center;">'.$imp->nombres.' '.$imp->ap_paterno.' '.$imp->ap_materno.'</td>';
	            $html.='<td style="text-align:center;">'.$imp->fecregistro_bien.'</td>';
	            
	            $html.='<td style="text-align:center;">'.$imp->estado_bien.'</td>';
	            
	            $html.='<td style="text-align:center;">'.$imp->usuario.'</td>';
	            $html.='<td style="text-align:center;">'.$imp->nombre_status.'</td></tr>';*/
	        // }
	        $html.='</tbody></table>';
	        
	        $html.='<table width="100%" border="1"><tbody>';
		        $html.='<table width="100%" cellpadding="2"><tbody>';
			        $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 230px;">Nombre(s): GUILLERMO ALÍ</td>';
		            $html.='<td style="text-align:left;">A. Paterno: MORAN</td>';
		            $html.='<td style="text-align:left;">A. Materno: HUERTA</td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 280px;">Puesto: N/A</td>';
		            $html.='<td style="text-align:left;width: 95px;">Tel: 41550730</td>';
		            $html.='<td style="text-align:left;width: 85px;">Ext: 7085</td>';
		            $html.='<td style="text-align:left;width: 60px;">Piso: 3</td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 340px;">Unidad Administrativa: FONCA</td>';
		            $html.='<td style="text-align:left;width: 90px;">Inmueble: FONCA</td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td colspan="3" style="text-align:left;">Domicilio: SABINO 63, COL. SANTA MARÍA LA RIBERA, DEL. CUAUTHÉMOC, CIUDAD DE MÉXICO, C.P.06400</td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td colspan="3" style="text-align:left;">Ticket: REQ001359</td></tr>';
		        $html.='</tbody></table>';
	        $html.='</tbody></table>';

	        $html.='<br>';
	        $html.='<p style="font-size:8px;font-weight: bold;">PERFIL: NIVEL 6 (DOCKING STATION)</p>';
	        $html.='<br>';
	        $html.='<table width="100%" cellpadding="2" border="1"><thead>';
		        $html.='<tr>';
		        $html.='<th style="text-align:center;">COMPONENTE</th>';
		        $html.='<th style="text-align:center;">MARCA</th>';
		        $html.='<th style="text-align:center;">MODELO</th>';
		        $html.='<th style="text-align:center;">NO. DE SERIE</th></tr></thead><tbody>';
	    
	        // foreach ($impresoras as $imp)
	        // {
	         	$html.='<tr nobr="true">';
	            $html.='<td style="text-align:left;">MONITOR</td>';
	            $html.='<td style="text-align:left;">Lenovo</td>';
	            $html.='<td style="text-align:left;">ThinkVision E21-10</td>';
	            $html.='<td style="text-align:left;">V5T43555</td></tr>';
	            $html.='<tr nobr="true">';
	            $html.='<td style="text-align:left;">TECLADO</td>';
	            $html.='<td style="text-align:left;">Lenovo</td>';
	            $html.='<td style="text-align:left;">4X30M86903</td>';
	            $html.='<td style="text-align:left;">S/N</td></tr>';
	            $html.='<tr nobr="true">';
	            $html.='<td style="text-align:left;">MOUSE</td>';
	            $html.='<td style="text-align:left;">Lenovo</td>';
	            $html.='<td style="text-align:left;">06P4069</td>';
	            $html.='<td style="text-align:left;">S/N</td></tr>';
	            $html.='<tr nobr="true">';
	            $html.='<td style="text-align:left;">DOCKING STATION</td>';
	            $html.='<td style="text-align:left;">Lenovo</td>';
	            $html.='<td style="text-align:left;">40A1009US</td>';
	            $html.='<td style="text-align:left;">M2B282A3</td></tr>';
	            $html.='<tr nobr="true">';
	            $html.='<td style="text-align:left;">CARGADOR DOCKING</td>';
	            $html.='<td style="text-align:left;">Lenovo</td>';
	            $html.='<td style="text-align:left;">N/A</td>';
	            $html.='<td style="text-align:left;">S/N</td></tr>';
	        // }
	        $html.='</tbody></table>';
	        $html.='<br><br>';
	        $html.='<table width="100%" cellpadding="2" border="1"><thead>';
		        $html.='<tr>';
		        $html.='<th colspan="3" style="text-align:left;">Observaciones:</th></tr></thead><tbody>';
	        $html.='</tbody></table>';

	        $html.='<table width="100%" border="1">';
		        $html.='<table width="100%" cellpadding="2"><tbody>';
			        $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;"><br><br></td></tr>';
		        $html.='</tbody></table>';
	        $html.='</table>';

	        $html.='<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
	        $html.='<table width="100%" cellpadding="3"><tbody>';
		        $html.='<tr nobr="true">';
	            $html.='<td style="width: 20px;"></td>';
	            $html.='<td style="text-align:center;border-top: 1px solid black;width: 160px;"> Nombre y Firma del usuario</td>';
	            $html.='<td style="width: 10px;"></td>';
	            $html.='<td style="text-align:center;border-top: 1px solid black;width: 160px;"> Nombre y Firma del Ingeniero de la <br>Empresa Mainbit S.A. DE C.V.</td>';
	            $html.='<td style="width: 10px;"></td>';
	            $html.='<td style="text-align:center;border-top: 1px solid black;width: 160px;"> Nombre y Firma del Responsable de <br>informática y/o Unindad Administrativa</td></tr>';
	        $html.='</tbody></table>';
	        
	        $html.='<br><br>';
	        $html .= '<table width="100%" cellpadding="2"><tbody>';
	        $html.='<tr nobr="true">';
            $html.='<td style="text-align:left;width: 87px;font-size: 7px;">FECHA DE RECEPCIÓN: </td>';
            $html.='<td style="text-align:center;border-bottom: 1px solid black;width: 90px;">30 de Diciembre 2019</td></tr>';
	        $html.='</tbody></table>';
	        
	        $html.='<br><br><br><br>';
	        $html.='<p style="font-size: 5px;">EL EQUIPO DESCRITO EN EL PRESENTE DOCUMENTO ES EXCLUSIVO PARA EL USO DE LA SECRETARÍA DE CULTURA SÓLO PODRÁ SER OPERADO POR PERSONAL AUTORIZADO</p>';
	        $html.='<p style="font-size: 5px;text-align: justify;">EL FIRMANTE DEL RESGUARDO DEL EQUIPO, ES EL RESPONSABLE EN TODO MOMENTO DEL BIEN INFORMÁTICO HASTA QUE SOLICITE LA BAJA O REASIGNACIÓN DEL MISMO, TENIENDO LA OBLIGACIÓN DE MANTENER LA INTEGRIDAD DE ÉL Y CUIDANDO SU BUEN USO. EL USUARIO TIENE LA OBLIGACIÓN DE CUIDAR Y CONSERVAR EN BUEN ESTADO LOS BIENES INFORMÁTICOS QUE SE LE PROPORCIONEN PARA EL DESEMPEÑO DE SU TRABAJO E INFORMAR POR ESCRITO A SU COORDINACIÓN ADMINISTRATIVA LOS DESPERFECTOS QUE LOS CITADOS BIENES SUFRAN TAN PRONTO LO ADVIERTA.</p>';

			// Imprimimos el texto con writeHTMLCell()
	    	$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 0, $fill = 0, $reseth = true, $align = '', $autopadding = true);

			// ---------------------------------------------------------
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
	    	$nombre_archivo = utf8_decode("Reportes_de_impresoras_".date("dmYHis").".pdf");
	    	$pdf->Output($nombre_archivo, 'I');
		}
		else
		{
			$this->load->library('Pdf');
	        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	        
	  
	        $pdf->SetTitle('Formato-Resguardo de impresoras (MITA)');

			$pdf->SetPrintHeader(false);

			// Establecer el tipo de letra
			 
			//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
			// Helvetica para reducir el tamaño del archivo.
	    	$pdf->SetFont('helvetica', '', 10, '', true);

			// Añadir una página
			// Este método tiene varias opciones, consulta la documentación para más información.
			$pdf->AddPage("P");

	    	//preparamos y maquetamos el contenido a crear
	        $html = '';
	        $html.= "<style type=text/css>";
	        $html.= "th{color: #fff; font-weight: bold; background-color: #222}";
	        $html.= "h1{text-align: center;}";
	        $html.= "td{font-size:8px;font-weight: bold;}";
	        $html.="#content {position: relative;}";
	        $html.="
				#content img {
				    position: absolute;
				    top: 0px;
				    right: 0px;
				}";
	        /*$html .= "img{float: left; top:0; position:absolute;}";*/
	        $html .= "</style>";

	        $html.='<table width="70%" cellpadding="2"><thead>';
	        $html.='<tr>';
	        $html.='<td width="35%"><img width="200" src="'.base_url("assets/images/mita_logo.png").'"></td>';
	        $html.='<td width="1%" rowspan="2"></td>';
	        $html.='<td width="35%" rowspan="2" style="font-weight:bold;text-align:left;border: 1px solid #000">Modelo: <br><br><br><br>Serie: </td>';
	        $html.='<td width="2%"  rowspan="2" style=""></td>';
	        $html.='<td width="35%" rowspan="2" style="font-weight:bold;text-align:left;border: 1px solid #000">INS: <br>EXCLUYE: </td>';
	        $html.='<td width="1%" rowspan="2"></td>';
	        $html.='<td width="30%"><br><br><br>Mensaje Enviado: [ ]<br><br>Folio F.P.: </td>';
	        $html.='</tr>';
	        $html.='</thead></table>';
	        
	        $html.='<br><br>';

	        $html.='<table width="100%" border="1"><tbody>';
		        $html.='<table width="100%" cellpadding="2"><tbody>';
	        		$html.='<br>';
			        $html.='<tr nobr="true">';
	        		$html.='<td width="1%" rowspan="9"></td>';
		            $html.='<td style="text-align:left;width: 280px;">Cliente: Secretaría de Cultura</td>';
		            $html.='<td style="text-align:left;">Reporta: Fabiola Guzmán</td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 280px;"></td>';
		            $html.='<td style="text-align:left;">Contacto: </td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 280px;">Referencia: </td>';
		            $html.='<td style="text-align:left;">Colonia: </td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 280px;">Depto.: INFORMÁTICA</td>';
		            $html.='<td style="text-align:left;">Delegación: Bosque de Chapultepec</td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 280px;"></td>';
		            $html.='<td style="text-align:left;">C.P.: </td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 280px;">Calle y No.: </td>';
		            $html.='<td style="text-align:left;"></td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 280px;"></td>';
		            $html.='<td style="text-align:left;">Horario: </td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 280px;">Teléfono (s): </td>';
		            $html.='<td style="text-align:left;width: 100px">Fecha: </td>';
		            $html.='<td style="text-align:left;">Hora: </td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 280px;">Extensiones: </td></tr>';
		        $html.='</tbody></table>';
	        $html.='</tbody></table>';
	       	
	       	$html.='<br><br>';

	        $html.='<table width="100%" border="1"><tbody>';
		        $html.='<table width="100%" cellpadding="2"><tbody>';
	        		$html.='<br>';
		            $html.='<tr nobr="true">';
	        		$html.='<td width="1%" rowspan="3"></td>';
		            $html.='<td style="text-align:left;width: 180px;">Tipo: </td>';
		            $html.='<td style="text-align:left;width: 130px">Prioridad: </td>';
		            $html.='<td style="text-align:left;">Falla: </td></tr>';
			        $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 180px;">Notas: </td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 180px;">Fecha Venc. Cont.: </td>';
		            $html.='<td style="text-align:left;width: 150px">Contador Venc. Cont.: </td>';
		            $html.='<td style="text-align:left;">Fecha Venc. Serv.: </td></tr>';
		        $html.='</tbody></table>';
	        $html.='</tbody></table>';

	       	$html.='<br><br>';

	        $html.='<table width="100%" border="1"><tbody>';
		        $html.='<table width="100%" cellpadding="2"><tbody>';
	        		$html.='<br>';
		            $html.='<tr nobr="true">';
	        		$html.='<td width="1%" rowspan="6"></td>';
		            $html.='<td style="text-align:left;width: 200px;">Tipo de Contrato: </td>';
		            $html.='<td style="text-align:left;width: 120px">Contador de Recepción: </td>';
		            $html.='<td style="width: 20px;"></td>';
		            $html.='<td style="text-align:left;">Fecha de Recepción: </td></tr>';
			        $html.='<tr nobr="true">';
		            $html.='<td style="width: 193px;"></td>';
		            $html.='<td style="text-align:left;width: 110px;border: 1px solid #000"></td>';
		            $html.='<td style="width: 17px;"></td>';
		            $html.='<td style="width: 20px;"></td>';
		            $html.='<td style="text-align:left;">Hora de Recepción: </td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 200px;">Técnico Asignado: </td>';
		            $html.='<td style="text-align:left;width: 120px;">Contador de Atención: </td>';
		            $html.='<td style="width: 20px;"></td>';
		            $html.='<td style="text-align:left;width: 100%;">Fecha de Atención: 25/10/2019</td></tr>';
			        $html.='<tr nobr="true">';
		            $html.='<td style="width: 193px;"></td>';
		            $html.='<td style="text-align:left;width: 110px;border: 1px solid #000"></td>';
		            $html.='<td style="width: 17px;"></td>';
		            $html.='<td style="width: 20px;"></td>';
		            $html.='<td style="text-align:left;">Hora de Inicio: </td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 220px;">Refacciones Pendientes: </td>';
		            $html.='<td style="text-align:left;width: 100px;">Stock Toner: </td>';
		            $html.='<td style="width: 20px;"></td>';
		            $html.='<td style="text-align:left;width: 120px;">Hora Final: </td></tr>';
			        $html.='<tr nobr="true">';
		            $html.='<td style="width: 193px;"></td>';
		            $html.='<td style="text-align:left;width: 110px;border: 1px solid #000"></td></tr>';
		        $html.='</tbody></table>';
	        	$html.='<br><br>';
	        $html.='</tbody></table>';

	        $html.='<br><br>';

	         $html.='<table width="100%" border="1"><tbody>';
		        $html.='<table width="100%" cellpadding="2"><tbody>';
	        		$html.='<br>';
		            $html.='<tr nobr="true">';
	        		$html.='<td width="1%" rowspan="2"></td>';
		            $html.='<td style="width: 210px"></td>';
		            $html.='<td style="text-align:center;">Daño por Usuario</td>';
		            $html.='<td></td>';
		            $html.='<td></td></tr>';
			        $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 180px;">Causa de Daño:</td></tr>';
		            $html.='<tr nobr="true">';
	        		$html.='<td width="3%" rowspan="3"></td>';
		            $html.='<td colspan="4" style="text-align:justify;border-bottom: 1px solid #000"></td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td colspan="4" style="text-align:justify;border-bottom: 1px solid #000"></td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td colspan="4" style="text-align:justify;border-bottom: 1px solid #000"></td></tr>';
		            $html.='<tr nobr="true">';
	        		$html.='<br>';
	        		$html.='<td width="1%" rowspan="2"></td>';
		            $html.='<td style="text-align:left;width: 60px;">Pieza dañada:</td>';
		            $html.='<td style="text-align:left;width: 180px;border-bottom: 1px solid #000"></td>';
		            $html.='<td style="text-align:left;width: 80px;"></td>';
		            $html.='<td style="text-align:left;width: 180px;border-bottom: 1px solid #000"></td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 363px;"></td>';
		            $html.='<td style="text-align:left;width: 110px;">Nombre y Firma del Cliente</td></tr>';
		        $html.='</tbody></table>';
	        	$html.='<br><br>';
	        $html.='</tbody></table>';

	        $html.='<br><br>';

	        $html.='<table width="100%" border="1"><tbody>';
		        $html.='<table width="100%" cellpadding="2"><tbody>';
	        		$html.='<br>';
		            $html.='<tr nobr="true">';
	        		$html.='<td colspan="3"></td></tr>';
		            $html.='<tr nobr="true">';
	        		$html.='<td width="3%" rowspan="6"></td>';
		            $html.='<td style="text-align:left;width: 250px;border: 1px solid #000">Atendido Por: Oscar Velasco</td>';
	        		$html.='<td width="1%" rowspan="6"></td>';
		            $html.='<td style="text-align:left;width: 246px;border: 1px solid #000">Refacciones Utilizadas:  </td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 250px;border: 1px solid #000">Tipo de Servicio: ';
						$html.='<table>';
							$html.='<tr>';
							$html.='<td style="width: 15%;"></td>';
							$html.='<td style="width: 8%;">S/C</td>';
							$html.='<td style="width: 2%;"></td>';
							$html.='<td style="width: 5%;border: 1px solid #000"></td>';
							$html.='<td style="width: 5%;"></td>';
							$html.='<td style="width: 8%;">S/P</td>';
							$html.='<td style="width: 2%;"></td>';
							$html.='<td style="width: 5%;border: 1px solid #000"></td>';
							$html.='<td style="width: 5%;"></td>';
							$html.='<td style="width: 8%;">C/R</td>';
							$html.='<td style="width: 2%;"></td>';
							$html.='<td style="width: 5%;border: 1px solid #000"></td>';
							$html.='<td style="width: 5%;"></td>';
							$html.='<td style="width: 8%;">F/O</td>';
							$html.='<td style="width: 2%;"></td>';
							$html.='<td style="width: 5%;border: 1px solid #000"></td>';
							$html.='</tr>';
						$html.='</table>';
					$html.='</td>';
		            $html.='<td style="text-align:left;width: 246px;border: 1px solid #000"></td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 250px;border: 1px solid #000">Falla Real: </td>';
		            $html.='<td style="text-align:left;width: 246px;border: 1px solid #000">Refacciones Sig. Visita:  </td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 250px;border: 1px solid #000"></td>';
		            $html.='<td style="text-align:left;width: 246px;border: 1px solid #000"></td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 250px;border: 1px solid #000">Causa de la Falla: </td>';
		            // $html.='<td> [ ] NO [ ] Pendientes: </td></tr>';
		            $html.='<td style="text-align:left;width: 246px;border: 1px solid #000">Reparada: ';
						$html.='<table>';
							$html.='<tr>';
							$html.='<td style="width: 5%;"></td>';
							$html.='<td style="width: 5%;">SI</td>';
							$html.='<td style="width: 5%;border: 1px solid #000"></td>';
							$html.='<td style="width: 5%;"></td>';
							$html.='<td style="width: 8%;">NO</td>';
							$html.='<td style="width: 5%;border: 1px solid #000"></td>';
							$html.='<td style="width: 8%;"></td>';
							$html.='<td style="width: 30%;">Pendientes: </td>';
							$html.='</tr>';
						$html.='</table>';
					$html.='</td></tr>';
		            $html.='<tr nobr="true">';
		            $html.='<td style="text-align:left;width: 250px;border: 1px solid #000"></td>';
		            $html.='<td style="text-align:left;width: 246px;border: 1px solid #000"></td></tr>';
	        		$html.='<tr nobr="true">';
	        		$html.='<td colspan="3"></td></tr>';
		        $html.='</tbody></table>';
	        $html.='</tbody></table>';

	        $html.='<p style="font-size: 8px">Nota: El Sigiente recuadro será llenado por el cliente</p>';

	        $html.='<table width="100%" cellpadding="2"><tbody>';
	            $html.='<tr nobr="true">';
	            $html.='<td style="text-align:left;width: 265px;border: 1px solid #000">Nombre y firma del usuario: <br><br><br><br></td>';
        		$html.='<td width="1%" rowspan="6"></td>';
	            $html.='<td style="text-align:left;width: 263px;border: 1px solid #000">Observaciones: </td></tr>';
	        $html.='</tbody></table>';

	       /* $html .= '<h2 style="text-align:center;">Reportes de Impresoras</h2>';

	        $html .= '<table width="100%" cellpadding="3" border="1"><thead>';
	        $html .= '<tr>';
	        $html .= "<th>#</th>";
	        $html .= '<th style="text-align:center;">No. de Serie</th>';
	        $html .= '<th colspan="2" style="text-align:center;">Modelo</th>';
	        $html .= '<th style="text-align:center;">Elemento</th>';
	        $html .= '<th style="text-align:center;">IP</th>';
	        $html .= '<th style="text-align:center;">Encargado</th>';
	        $html .= '<th style="text-align:center;">Fec. Registro.</th>';
	        $html .= '<th style="text-align:center;">Bitacora</th>';
	        $html .= '<th style="text-align:center;">Usuario</th>';
	        
	        $html .= '<th style="text-align:center;">Estado</th></tr></thead><tbody>';
	    
	        //provincias es la respuesta de la función getProvinciasSeleccionadas($provincia) del modelo
	        // foreach ($impresoras as $imp)
	        // {
	         	$html.='<tr nobr="true">';
	            $html.='<td style="text-align:center;"></td>';
	            $html.='<td style="text-align:center;"></td>';
	            $html.='<td colspan="2" style="text-align:center;"></td>';
	            $html.='<td style="text-align:center;"></td>';
	            $html.='<td style="text-align:center;"></td>';
	            $html.='<td style="text-align:center;"></td>';
	            $html.='<td style="text-align:center;"></td>';
	            
	            $html.='<td style="text-align:center;"></td>';
	            
	            $html.='<td style="text-align:center;"></td>';
	            $html.='<td style="text-align:center;"></td></tr>';
	        // }

	        $html.='</tbody></table>';*/

			// Imprimimos el texto con writeHTMLCell()
	    	$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 0, $fill = 0, $reseth = true, $align = '', $autopadding = true);

			// ---------------------------------------------------------
			// Cerrar el documento PDF y preparamos la salida
			// Este método tiene varias opciones, consulte la documentación para más información.
	    	$nombre_archivo = utf8_decode("Reportes_de_impresoras_".date("dmYHis").".pdf");
	    	$pdf->Output($nombre_archivo, 'I');
		}
	}
}