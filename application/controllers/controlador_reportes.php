<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Controlador_reportes extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('modelo_inicio');
		$this->load->model('modelo_consultas');
		$this->load->database('default');
		$this->verificar_sesion();
		$this->load->library('fpdf/fpdf.php');
		$this->load->library('fpdf/PDF.php');
	}

	public function index()
	{
		redirect('controlador_inicio');
	}

	public function verificar_sesion()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if (!isset($is_logged_in) || $is_logged_in != TRUE) {
			redirect('login');
			die();
		}
	}

	public function genera($id_periodo, $id_grupo)
	{
		//Para obtener la fecha actual
		date_default_timezone_set("America/Mexico_City"); //Establecer la zona horaria de méxico
		$pdf = new FPDF('L','mm','Letter');
		$pdf->AddPage();

		#Establecemos los márgenes izquierda, arriba y derecha:
		$pdf->SetMargins(1.8,1,1.8);

		#Establecemos el margen inferior:
		$pdf->SetAutoPageBreak(true,1);  

		#izquierda,Ordenada de la esquina superior izquierda, ancho, alto
		$pdf->Image('assets/img/gobierno.png',8,8,40,15,'PNG');

		$pdf->SetFont('Arial','B',10);
		$pdf->SetXY(80,10);		
		$pdf->Cell(135,5,utf8_decode('COLEGIO DE EDUCACIÓN PROFESIONAL TÉCNICA DEL ESTADO DE COLIMA'),1,1,'C');

		$pdf->SetXY(80,15);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(135,5,utf8_decode('ORGANISMO PÚBLICO DESCENTRALIZADO DEL GOBIERNO DEL ESTADO'),1,1,'C');

		$pdf->Image('assets/img/logoOriginal.png',245,8,25,17,'PNG');
		$pdf->Image('assets/img/lineas.png',10,26,259,2,'PNG');

		$pdf->SetFont('Arial','I',10);
		$pdf->SetXY(238,29);		
		$pdf->Cell(30,5,utf8_decode('Plantel Colima 181'),0,1,'C');

		$pdf->SetFont('Arial','B',10);
		$pdf->SetXY(130,29);		
		$pdf->Cell(30,5,utf8_decode('Horario de Clases'),1,1,'C');

		$pdf->SetFont('Arial','B',10);
		$pdf->SetXY(9,34);		
		$pdf->Cell(37,5,utf8_decode('PERIODO ESCOLAR:'),1,1,'L');

		$pdf->SetFont('Arial','B',10);
		$pdf->SetXY(190,34);		
		$pdf->Cell(16,5,utf8_decode('GRUPO:'),1,1,'L');

		$pdf->SetFont('Arial','B',10);
		$pdf->SetXY(9,39);		
		$pdf->Cell(10,5,utf8_decode('SEM:'),1,1,'L');

		$pdf->SetFont('Arial','B',10);
		$pdf->SetXY(190,39);		
		$pdf->Cell(16,5,utf8_decode('TURNO:'),1,1,'L');

		#TABLA

		//funcion que calcula el numero de paginas
		$pdf->AliasNbPages();

		$miCabecera = array('Folio', 'Concepto', 'Importe');

		//Se va al método de seleccionar_datos() que se encuentra en la clase PDF y obtiene los datos
		if (isset($_GET['term']))
	    {
	      $q = mb_strtoupper($_GET['term'],'UTF-8');
	      $this->modelo_buscar->get_grupos($q);
	    }

		//Se va construyendo la tabla
		#$pdf->tablaHorizontal($miCabecera, "hOLA");

		$pdf->Output(); //Se cierra el pdf
	}
}