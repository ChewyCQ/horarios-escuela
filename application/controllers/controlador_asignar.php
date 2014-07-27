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
		foreach ($post as $key => $value) {
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
		// echo "<pre>";
		// echo "maestro_materia\n";
		// print_r($maestro_materia);
		// echo "Horario\n";
		// print_r($horarios);
		// echo "horarios_clases\n";
		// print_r($horarios_clases);
		// echo "\n</pre>";
		$this->modelo_horario->insert_clases($horarios_clases);
		redirect("/controlador_asignar/ver_horario/{$id_periodo}/{$id_grupo}");
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
		$data['maestro_materia'] = $this->modelo_horario->get_maestro_materia_clase($id_periodo, $id_grupo);
		$data['grupo']['semestre'] = $this->semestre_grupo($data['grupo']['Generacion'],$this->modelo_horario->get_periodo_by_id($id_periodo));

		// echo "<pre>";
		// echo "Data\n";
		// print_r($data);
		// echo "</pre>";
		$this->load->view('vista_ver_horario', $data);
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