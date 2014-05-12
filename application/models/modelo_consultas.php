<?php

	class Modelo_consultas extends CI_Model
	{
		public function __construct()
		{
			parent:: __construct();
		}
		//----------------------CONSULTAS PARA OBTENER LOS DATOS A MODIFICAR
		public function consulta_especialidad($id)
		{
			$especialidad = $this->db->get_where('maestro_especialidad', array('idEspecialidad' => $id));
			if($especialidad->num_rows()>0)
			{
				return $especialidad->row(); //Con el row solo se obtiene una fila de resultados
			}
			else
			{
				return FALSE;
			}
		}
		public function consulta_maestro($id)
		{
			$especialidad = $this->db->get_where('maestro_especialidad', array('idEspecialidad' => $id));
			if($especialidad->num_rows()>0)
			{
				return $especialidad->row(); //Con el row solo se obtiene una fila de resultados
			}
			else
			{
				return FALSE;
			}
		}
		public function consulta_materia($id)
		{
			$materia = $this->db->get_where('materia', array('idMateria' => $id));
			if($materia->num_rows()>0)
			{
				return $materia->row(); //Con el row solo se obtiene una fila de resultados
			}
			else
			{
				return FALSE;
			}
		}
		//Obtiene los semestres que estan actualmente en la tabla semestre unida con la tabla de plan
		public function obtener_semestres_plan()
		{
			$this->db->select('*');
			$this->db->from('semestre');
			$this->db->join('plan', 'plan.idPlan = semestre.idPlan', 'left');
			$semestres= $this->db->get();
			if($semestres->num_rows()>0)
			{
				return $semestres->result();
			}
		}
		public function consulta_semestre($id)
		{
			$semestre = $this->db->get_where('semestre', array('idSemestre' => $id));
			if($semestre->num_rows()>0)
			{
				return $semestre->row(); //Con el row solo se obtiene una fila de resultados
			}
			else
			{
				return FALSE;
			}
		}
		//Obtiene los semestres que estan actualmente en la tabla semestre unida con la tabla de plan
		public function obtener_planes_carrera()
		{
			$this->db->select('*');
			$this->db->from('plan');
			$this->db->join('carrera', 'carrera.idCarrera = plan.idCarrera', 'left');
			$planes= $this->db->get();
			if($planes->num_rows()>0)
			{
				return $planes->result();
			}
		}
	}
?>