<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Controlador_asignar extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database('default');
		$this->load->model('modelo_consultas');
		$this->load->model('modelo_inicio');
		$this->verificar_sesion();
		#fpdf
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
	public function materia_semestre()
	{
		$data = array('semestres'=>$this->modelo_consultas->obtener_semestre_carrera_plan(),
					  'materias'=>$this->modelo_inicio->obtener_materias(),
					  'var' => 0,
					  'id_materia' => '',
					  'horas_escuela' => '',
					  'horas_campo' => ''
					 );
		$this->load->view('asignar/vista_materia_semestre',$data);
	}

	public function maestro_materia()
	{
		$data = array('maestros' => $this->modelo_inicio->obtener_maestros(),
					  'var' =>0,
					  'id_maestro' =>''
					  );
		$this->load->view('asignar/vista_maestro_materia',$data);
	}
	public function horario()
	{
		$post = $this->input->post();

		// echo "<pre>";
		// print_r($post);
		// echo "</pre>";

		$this->load->model('modelo_horario');

		$data['id_grupo'] = $post['id_grupo'];

		// Periodo
		$periodo = $this->modelo_horario->get_periodo_by_id($post['id_periodo']);
		$data['periodo'] = $periodo;
		// Grupo
		$data['grupo'] = $this->modelo_horario->get_grupo_by_id($post['id_grupo']);
		$data['grupo']['semestre'] = $this->semestre_grupo($data['grupo']['Generacion'],$periodo);
		// Materias
		$data['materias'] = $this->modelo_horario->get_materias_del_semestre($data['grupo']['idPlan'], $data['grupo']['semestre']);
		// Maestros
		$data['maestros'] = $this->modelo_horario->get_maestros_activos();
		// Horarios actuales
		$clases = $this->modelo_horario->get_clases_where(array('idPeriodo'=>$post['id_periodo'], 'idGrupo'=>$post['id_grupo']));
		$clase_aux = array();
		$num_clase = 0;
		foreach ($clases as $clase) {
			$data['clases'][$clase['iddia_semana']][substr($clase['hora_inicio'], 0, 5)] = $clase['idMateria'];
			$data['materia_maestro'][$clase['idMateria']] = $clase['idMaestro'];
		}

		// echo "<meta charset='utf-8'><pre>";
		// echo "Data\n";
		// print_r($data);
		// echo "</pre>";

		$this->load->view('asignar/vista_asignar_horario',$data);
	}
	function guardar_horario()
	{
		// echo "<pre>Guardar:\n";
		// print_r($this->input->post());
		// echo "</pre>";

		$this->load->model('modelo_horario');

		// Extraer datos
		$post = $this->input->post();
		$horarios = array();
		$id_periodo = $post['id_periodo'];
		$id_grupo = $post['id_grupo'];
		$valores = array();
		foreach ($post as $key => $value) {
			// echo "<br> key = {$key} value = {$value}<br>";
			$valores[$key] = $value;
			if (strrpos($key, "maestro") !== FALSE) {
				$id_materia = explode("_", $key)[2];
				$maestro_materia[] = array(
					'id_maestro' => $value,
					'id_materia' => $id_materia);
			} elseif (strrpos($key, "hora") !== FALSE) {
				$aux = explode("_", $key);
				$dia = $aux[1];
				$hora = $aux[2];
				$horarios[] =  array(
					'dia' => $this->_adaptar_dia($dia),
					'id_materia' => $value,
					'hora' => $this->_adaptar_hora($hora,$post['turno']));
			}
		}
		// agrupar datos
		$horarios_clases = array();
		$num_horarios;
		foreach ($horarios as $horario) {
			foreach ($maestro_materia as $mm) {
				if ($mm['id_materia'] == $horario['id_materia']) {
					$aux2['idMaestro'] = $mm['id_maestro'];
				}
			}
			$aux2['idPeriodo'] = $id_periodo;
			$aux2['idMateria'] = $horario['id_materia'];
			$aux2['idGrupo'] = $id_grupo;
			$aux2['idhorario_dia'] = $this->modelo_horario->get_horario_dia($horario['hora'], $horario['dia'])['idhorario_dia'];
			if ($aux2['idMateria'] != 0) {
				$horarios_clases[] = $aux2;
			}
		}
		// validar
		$advertencias = array();
		$num_rojas = 0;
		$materias_horas_programa = $this->modelo_horario->materia_horas($post['id_plan'], $post['semestre']);
		$materias_horas_horario = array();
		foreach ($horarios_clases as $horario_clase) {
			$maestro_ocupado = $this->modelo_horario->maestro_ocupado_en_horario(
				$horario_clase['idMaestro'],
				$horario_clase['idPeriodo'],
				$horario_clase['idGrupo'],
				$horario_clase['idhorario_dia']);
			if ($maestro_ocupado != FALSE) {
				$advertencias['rojas'][] = $maestro_ocupado;
			}
			if (isset($materias_horas_horario[$horario_clase['idMateria']])) {
				$materias_horas_horario[$horario_clase['idMateria']] += 1;
			} else {
				$materias_horas_horario[$horario_clase['idMateria']] = 1;
			}
			

			// advertencias amarillas
		}
		// advertencias rojas del cumplimiento de horas
		foreach ($materias_horas_programa as $key => $value) {
			if ( ! isset($materias_horas_horario[$key])) {
				$advertencias['rojas'][] = "El modulo <strong>{$this->modelo_horario->get_materia($key)['Nombre_materia']}</strong> no esta asignado.";
				continue;
			}
			if ($materias_horas_horario[$key] != $materias_horas_programa[$key]) {
				// echo "<br>No coincidio: {$materias_horas_horario[$key]} con {$materias_horas_programa[$key]['Horas_semana_escuela']}<br>";
				$advertencias['rojas'][] = "El modulo <strong>{$this->modelo_horario->get_materia($key)['Nombre_materia']}</strong> deberia tener <strong>{$materias_horas_programa[$key]['Horas_semana_escuela']}</strong> horas, tiene <strong>{$materias_horas_horario[$key]}</strong>.";
			}
		}

		// echo "<pre>Horas programa\n";
		// print_r($materias_horas_programa);
		// echo "</pre>";
		// echo "<pre>Horas horario\n";
		// print_r($materias_horas_horario);
		// echo "</pre>";

		// echo "<pre>";
		// echo "maestro_materia\n";
		// print_r($maestro_materia);
		// echo "Horario\n";
		// print_r($horarios);
		// echo "horarios_clases\n";
		// print_r($horarios_clases);
		// echo "\n</pre>";

		if ( empty($advertencias['rojas'])) {
			// guardar
			$advertencias = NULL;
			// echo "<pre>Horario\n";
			// print_r($horarios_clases);
			// echo "</pre>";
			$this->modelo_horario->insert_clases($horarios_clases);
			redirect("/controlador_asignar/ver_horario/{$id_periodo}/{$id_grupo}");
		} else {
			// regresar

			$data['advertencias'] = $advertencias;
			// echo "<pre>Advertencias: \n";
			// print_r($advertencias);
			// echo "</pre>";

			$data['valores'] = $valores;
			$data['id_grupo'] = $id_grupo;
			// Periodo
			$data['periodo'] = $this->modelo_horario->get_periodo_by_id($id_periodo);
			// Grupo
			$data['grupo'] = $this->modelo_horario->get_grupo_by_id($id_grupo);
			$data['grupo']['semestre'] = $this->semestre_grupo($data['grupo']['Generacion'],$data['periodo']);
			// Materias
			$data['materias'] = $this->modelo_horario->get_materias_del_semestre($data['grupo']['idPlan'], $data['grupo']['semestre']);
			// Maestros
			$data['maestros'] = $this->modelo_horario->get_maestros_activos();
			// echo "<pre>Data:\n";
			// print_r($data);
			// echo "</pre>";

			$this->load->view('asignar/vista_asignar_horario',$data);
		}
		

		// ver
		// $this->modelo_horario->insert_clases($horarios_clases);
		// redirect("/controlador_asignar/ver_horario/{$id_periodo}/{$id_grupo}");
	}
	public function _adaptar_hora($hora, $turno)
	{
		$hora_matutino = array("7:00","7:50","8:40","9:30","10:00","10:40","11:30","12:20","13:10","14:00");
		$hora_vespertino = array("14:00","14:50","15:40","16:30","17:20","17:50","18:40","19:30","20:20","21:10");
		return ($turno == 1) ? $hora_matutino[$hora] : $hora_vespertino[$hora];
	}
	public function _adaptar_dia($num_dia)
	{
		$dia = array("lunes", "martes", "miercoles", "jueves", "viernes");
		return $dia[$num_dia];
	}
	public function ver_horario($id_periodo, $id_grupo)
	{
		$this->load->model('modelo_horario');
		$data['clases'] = $this->modelo_horario->get_clases_where(array('idPeriodo'=>$id_periodo, 'idGrupo'=>$id_grupo));
		$data['grupo'] = $this->modelo_horario->get_datos_grupo($id_grupo);
		$data['periodo'] = $this->modelo_horario->get_periodo_by_id($id_periodo);
		$data['grupos'] = $this->modelo_horario->get_grupos_del_periodo_con_horarios($data['periodo']['Anio'],$data['periodo']['semestre']);
		$data['maestro_materia'] = $this->modelo_horario->get_maestro_materia_clase($id_periodo, $id_grupo);
		$data['grupo']['semestre'] = $this->semestre_grupo($data['grupo']['Generacion'],$this->modelo_horario->get_periodo_by_id($id_periodo));

		// echo "<pre>";
		// echo "Data\n";
		// print_r($data);
		// echo "</pre>";
		$this->load->view('ver/vista_ver_horario', $data);
	}
	public function ver_horario_otro_grupo()
	{
		$post = $this->input->post();
		redirect("controlador_asignar/ver_horario/{$post['id_periodo']}/{$post['id_grupo']}");
	}
	function escoger_periodo()
	{
		$this->load->model('modelo_horario');

		$data['periodos'] = $this->modelo_horario->get_periodos_del_anio(date('Y'));
		$data['grupos'] = $this->modelo_horario->get_grupos_vigentes();

		$this->load->view('asignar/vista_escoger_periodo', $data);

	}
	function escoger_periodo_a_ver()
	{
		$post = $this->input->post();
		if (isset($post['id_periodo'])) {
			redirect("controlador_asignar/escoger_grupo_del_periodo_a_ver/{$post['id_periodo']}");
			die();
		}
		$this->load->model('modelo_horario');

		$data['periodos'] = $this->modelo_horario->get_periodos();
		$data['grupos'] = $this->modelo_horario->get_grupos_vigentes();

		$this->load->view('ver/vista_escoger_periodo', $data);

	}

	function escoger_grupo_del_periodo_a_asignar()
	{
		$this->load->model('modelo_horario');

		$periodo = $this->modelo_horario->get_periodo_by_id($this->input->post('id_periodo'));
		$data['id_periodo'] = $periodo['idPeriodo'];
		$data['periodo'] = $periodo;
		$data['grupos'] = $this->modelo_horario->get_grupos_del_periodo($periodo['Anio'], $periodo['semestre']);

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";

		$this->load->view('asignar/vista_escoger_grupo', $data);

	}
	function escoger_grupo_del_periodo_a_ver($id_periodo=NULL)
	{
		$this->load->model('modelo_horario');
		if (isset($id_periodo)) {
			$data['periodo'] = $this->modelo_horario->get_periodo_by_id($id_periodo);
			if (isset($data['periodo'])) {
				$data['id_periodo'] = $data['periodo']['idPeriodo'];
				$data['grupos'] = $this->modelo_horario->get_grupos_del_periodo_con_horarios($data['periodo']['Anio'], $data['periodo']['semestre']);
				$this->load->view('ver/vista_escoger_grupo_horario', $data);
			} else {
				// echo "Periodo no encontrado";
				redirect('controlador_asignar/escoger_periodo_a_ver');
			}
		} else {
			$post = $this->input->post();
			if (isset($post['id_grupo'])) {
				redirect("/controlador_asignar/ver_horario/{$post['id_periodo']}/{$post['id_grupo']}");
			}
		}

	}
	/**
	 * Retorna el numero de semestre del grupo en un periodo dado.
	 * @param  Int $generacion_grupo Anio de generacion del grupo
	 * @param  1/0 $periodo          0 = ene-jun, 1 = ago-dic
	 * @return Int                   Numero de semestre del grupo para el periodo dado.
	 */
	function semestre_grupo($generacion_grupo, $periodo)
	{
		$anio_actual = $periodo['Anio'];
		$anios_enteros = $anio_actual - $generacion_grupo;
		$semestre = $anios_enteros * 2;
		if ($periodo['semestre'] == 1) {
			$semestre++;
		}
		return $semestre;
	}

	public function imprimir_horario()
	{
		$post = $this->input->post();
		redirect("controlador_asignar/genera/{$post['id_periodo']}/{$post['id_grupo']}");
	}

	public function genera()
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