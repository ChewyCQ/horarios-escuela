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
					  'materias'=>$this->modelo_consultas->obtener_materias_semestre(),
					  'var' => 0,
					  'id_materia' => '',
					  'horas_escuela' => '',
					  'horas_campo' => ''
					 );
		$this->load->view('asignar/vista_materia_semestre',$data);
	}

	public function maestro_materia()
	{
		$data = array('maestros' => $this->modelo_inicio->obtener_maestros());
		$this->load->view('asignar/vista_maestro_materia',$data);
	}
	public function horario()
	{
		// echo "<pre>";
		// echo "Post ";
		// print_r($this->input->post());
		// echo "</pre>";

		$this->load->model('modelo_horario');

		$periodo = $this->modelo_horario->get_periodo($this->input->post('id_periodo'));

		// echo "<pre>";
		// echo "Periodo ";
		// print_r($periodo);
		// echo "</pre>";

		$data['grupo'] = $this->modelo_horario->get_datos_grupo($this->input->post('id_grupo'));
		$data['grupo']['semestre'] = $this->semestre_grupo($data['grupo']['Generacion'],$periodo);

		// echo "<pre>";
		// echo "Grupo ";
		// print_r($data['grupo']);
		// echo "</pre>";

		$data['materias'] = $this->modelo_horario->get_materias_del_grupo(
			$this->input->post('id_grupo'), 
			$this->semestre_grupo($data['grupo']['Generacion'],$periodo)			
			);

		// echo "<pre>";
		// print_r($data['materias']);
		// echo "</pre>";

		$this->load->view('horario',$data);
	}
	function guardar_horario()
	{
		parse_str($this->input->post('list'), $salida);
		echo "<pre>";
		print_r($salida);
		echo "</pre>";
	}
	function escoger_periodo()
	{
		$this->load->model('modelo_horario');
		$data['periodos'] = $this->modelo_horario->get_periodos_vigentes();
		$data['grupos'] = $this->modelo_horario->get_grupos_vigentes();

		// echo "<pre>";
		// print_r($data['grupos']);
		// echo "</pre>";


		$this->load->view('asignar/vista_escoger_periodo', $data);

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

}