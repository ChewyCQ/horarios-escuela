<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelo_horario extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	function get_periodos()
	{
		$this->db->order_by('Anio','desc');
		$this->db->order_by('Semestre','desc');
		$query = $this->db->get('periodo');
		return $query->result_array();
	}

	function get_periodo_by_id($id_periodo)
	{
		$this->db->where('idPeriodo =', $id_periodo);
		$query = $this->db->get('periodo');
		return $query->row_array();
	}

	function get_periodos_del_anio($anio)
	{
		$this->db->where('Anio =', $anio);
		$this->db->order_by('Anio','desc');
		$this->db->order_by('Semestre','desc');
		$query = $this->db->get('periodo');
		return $query->result_array();
	}

	function get_grupos_del_periodo($anio, $semestre)
	{
		$this->db->join('plan','grupo.idPlan = plan.idPlan');
		$this->db->join('carrera','carrera.idCarrera = plan.idCarrera');
		if ($semestre == 0) {
			$this->db->where('Generacion >=', $anio - 3);
		} else {
			$this->db->where('Generacion >=', $anio - 2);
		}
		$this->db->order_by('Nombre_carrera','desc');
		$this->db->order_by('Generacion','desc');
		$query = $this->db->get('grupo');
		return $query->result_array();
	}

	function get_grupo_by_id($id_grupo)
	{
		$this->db->where('idGrupo =', $id_grupo);
		$query = $this->db->get('grupo');
		return $query->row_array();
	}

	function get_grupos_vigentes()
	{
		$this->db->select('*');
		$this->db->from('grupo');
		$this->db->join('plan','grupo.idPlan = plan.idPlan');
		$this->db->join('carrera','carrera.idCarrera = plan.idCarrera');
		$this->db->where('Generacion >', date('Y')-4);
		$this->db->order_by('Nombre_carrera','desc');
		$this->db->order_by('Generacion','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_datos_grupo($idGrupo)
	{
		$this->db->select('*');
		$this->db->from('grupo');
		$this->db->join('plan','grupo.idPlan = plan.idPlan');
		$this->db->where('idGrupo =', $idGrupo);
		$query = $this->db->get();
		return $query->row_array();
	}

	function get_materias_del_semestre($id_plan, $num_semestre)
	{
		$this->db->select('materia.idMateria, Nombre_materia, Clave_materia, Tipo_materia, Horas_semana_escuela, Horas_semana_campo_clinico');
		$this->db->join('materia_semestre','materia_semestre.idMateria = materia.idMateria');
		$this->db->join('semestre','semestre.idSemestre = materia_semestre.idSemestre');
		$this->db->where('semestre.Numero_semestre = ', $num_semestre);
		$this->db->where('semestre.idPlan = ', $id_plan);
		$query = $this->db->get('materia');
		return $query->result_array();
	}

	public function get_maestros_activos()
	{
		$this->db->where('activo = ', 1);
		$this->db->order_by('Nombre', 'desc');
		$query = $this->db->get('maestro');
		return $query->result_array();
	}

	public function get_horario_dia($hora, $dia)
	{
		echo "buscando horario de hora: {$hora} dia: {$dia}<br/>";
		$this->db->join('horario_clase', 'horario_clase.idhorario_clase = horario_dia.idhorario_clase');
		$this->db->where('hora_inicio = ', $hora);
		$this->db->where('iddia_semana = ', $dia);
		$query = $this->db->get('horario_dia', 1);
		return $query->row_array();
	}

	public function insert_clases($clases)
	{
		$this->borrar_clases(
			$clases[0]['idPeriodo'],
			$clases[0]['idGrupo']);
		foreach ($clases as $clase) {
			$this->db->insert('clase', $clase); 
		}
	}

	public function borrar_clases($id_periodo, $id_grupo)
	{
		$this->db->where(array('idPeriodo' => $id_periodo,'idGrupo' => $id_grupo));
		$this->db->delete('clase');
	}

	public function get_clases_where($valores)
	{
		$this->db->where($valores);
		$this->db->join('maestro', 'maestro.idMaestro = clase.idMaestro', 'left');
		$this->db->join('materia', 'materia.idMateria = clase.idMateria', 'left');
		$this->db->join('horario_dia', 'horario_dia.idhorario_dia = clase.idhorario_dia', 'left');
		$this->db->join('horario_clase', 'horario_clase.idhorario_clase = horario_dia.idhorario_clase', 'left');
		$query = $this->db->get('clase');
		return $query->result_array();
	}

	public function get_maestro_materia_clase($id_periodo, $id_grupo)
	{
		$this->db->distinct();
		$this->db->select('Clave_materia, maestro.Nombre, materia.Nombre_materia, Horas_semana_escuela, Horas_semana_campo_clinico');
		$this->db->where(array('idPeriodo' => $id_periodo,'idGrupo' => $id_grupo));
		$this->db->join('maestro', 'maestro.idMaestro = clase.idMaestro', 'left');
		$this->db->join('materia', 'materia.idMateria = clase.idMateria', 'left');
		$this->db->join('materia_semestre', 'materia.idMateria = materia_semestre.idMateria', 'left');
		$this->db->group_by('materia.idMateria');
		$this->db->order_by('materia.idMateria', 'asc');
		$query = $this->db->get('clase');
		// echo $this->db->last_query();
		return $query->result_array();
	}
}

/* End of file modelo_horario.php */
/* Location: ./application/models/modelo_horario.php */