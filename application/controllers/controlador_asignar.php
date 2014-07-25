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
		// Horarios?

		// echo "<pre>";
		// echo "Data\n";
		// print_r($data);
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

		$data['periodos'] = $this->modelo_horario->get_periodos_del_anio(date('Y'));
		$data['grupos'] = $this->modelo_horario->get_grupos_vigentes();

		$this->load->view('asignar/vista_escoger_periodo', $data);

	}
	function escoger_grupo_del_periodo()
	{
		$this->load->model('modelo_horario');

		$periodo = $this->modelo_horario->get_periodo_by_id($this->input->post('id_periodo'));
		$data['id_periodo'] = $periodo['idPeriodo'];
		$data['periodo'] = $periodo;
		$data['grupos'] = $this->modelo_horario->get_grupos_del_periodo($periodo['Anio'], $periodo['semestre']);

		$this->load->view('asignar/vista_escoger_grupo', $data);

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