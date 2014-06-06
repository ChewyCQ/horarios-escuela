<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelo_horario extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	function get_periodos_vigentes()
	{
		$this->db->where('Anio >', date('Y')-4);
		$this->db->order_by('Anio','desc');
		$this->db->order_by('Semestre','desc');
		$query = $this->db->get('periodo');
		return $query->result_array();
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
	function get_materias_del_grupo($idGrupo, $semestre)
	{
		$this->db->select('*');
		$this->db->from('grupo');
		$this->db->join('plan','grupo.idPlan = plan.idPlan');
		$this->db->join('semestre','semestre.idPlan = plan.idPlan');
		$this->db->join('materia_semestre','materia_semestre.idSemestre = semestre.idSemestre');
		$this->db->join('materia','materia.idMateria = materia_semestre.idMateria');
		$this->db->where('idGrupo =', $idGrupo);
		$this->db->where('Numero_semestre =', $semestre);
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_periodo($idPeriodo)
	{
		$this->db->where('idPeriodo =', $idPeriodo);
		$query = $this->db->get('periodo');
		return $query->row_array();
	}
}

/* End of file modelo_horario.php */
/* Location: ./application/models/modelo_horario.php */