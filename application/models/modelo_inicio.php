<?php

	class Modelo_inicio extends CI_Model
	{
		public function __construct()
		{
			parent:: __construct();
		}
		//Obtiene las carreras que existen actualmente en la tabla carrera
		public function obtener_carreras()
		{
			$carreras = $this->db->get('carrera');
			if($carreras->num_rows()>0)
			{
				return $carreras->result();
			}
		}
		//Obtiene los planes de la tabla plan
		public function obtener_plan()
		{
			$planes = $this->db->get('plan');
			if($planes->num_rows()>0)
			{
				return $planes->result();
			}
		}
		//Obtiene las especialidades de la tabla maestro_especialidad
		public function obtener_especialidades()
		{
			$especialidades = $this->db->get('maestro_especialidad');
			if($especialidades->num_rows()>0)
			{
				return $especialidades->result();
			}
		}
		//Obtiene las especialidades/areas que estan actualmente en la tabla maestro_especialidad
		public function obtener_areas()
		{
			$areas= $this->db->get('maestro_especialidad');
			if($areas->num_rows()>0)
			{
				return $areas->result();
			}
		}
		//Obtiene los maestros que estan actualmente en la tabla maestro
		public function obtener_maestros()
		{
			$maestros= $this->db->get('maestro');
			if($maestros->num_rows()>0)
			{
				return $maestros->result();
			}
		}
		//Obtiene los semestres que estan actualmente en la tabla semestre
		public function obtener_semestres()
		{
			$semestres= $this->db->get('semestre');
			if($semestres->num_rows()>0)
			{
				return $semestres->result();
			}
		}
		//Obtiene los grupos que estan actualmente en la tabla grupo
		public function obtener_grupos()
		{
			$grupos= $this->db->get('grupo');
			if($grupos->num_rows()>0)
			{
				return $grupos->result();
			}
		}
		//Obtiene las materias que estan actualmente en la tabla materia
		public function obtener_materias()
		{
			$materias= $this->db->get('materia');
			if($materias->num_rows()>0)
			{
				return $materias->result();
			}
		}
	}
?>