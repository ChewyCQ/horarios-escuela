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
			$maestro = $this->db->get_where('maestro', array('idMaestro' => $id));
			if($maestro->num_rows()>0)
			{
				return $maestro->row(); //Con el row solo se obtiene una fila de resultados
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
		public function consulta_carrera($id)
		{
			$carrera = $this->db->get_where('carrera', array('idCarrera' => $id));
			if($carrera->num_rows()>0)
			{
				return $carrera->row(); //Con el row solo se obtiene una fila de resultados
			}
			else
			{
				return FALSE;
			}
		}
		public function consulta_plan($id)
		{
			$plan = $this->db->get_where('plan', array('idPlan' => $id));
			if($plan->num_rows()>0)
			{
				return $plan->row(); //Con el row solo se obtiene una fila de resultados
			}
			else
			{
				return FALSE;
			}
		}
		public function consulta_grupos_semestre()
		{
			$this->db->select('*');
			$this->db->from('grupo');
			$this->db->join('semestre', 'semestre.idSemestre = grupo.idSemestre', 'left');
			$grupos= $this->db->get();
			if($grupos->num_rows()>0)
			{
				return $grupos->result();
			}
		}
		public function consulta_grupo($id)
		{
			$grupo = $this->db->get_where('grupo', array('idGrupo' => $id));
			if($grupo->num_rows()>0)
			{
				return $grupo->row(); //Con el row solo se obtiene una fila de resultados
			}
			else
			{
				return FALSE;
			}
		}
		public function consulta_alumno_grupo()
		{
			$this->db->select('*');
			$this->db->from('alumno');
			$this->db->join('grupo', 'grupo.idGrupo = alumno.idGrupo', 'left');
			$alumnos= $this->db->get();
			if($alumnos->num_rows()>0)
			{
				return $alumnos->result();
			}
		}
		public function consulta_alumno($id)
		{
			$alumno = $this->db->get_where('alumno', array('idAlumno' => $id));
			if($alumno->num_rows()>0)
			{
				return $alumno->row(); //Con el row solo se obtiene una fila de resultados
			}
			else
			{
				return FALSE;
			}
		}
		public function consulta_dependencia($id)
		{
			$dependencia = $this->db->get_where('dependencia', array('idDependencia' => $id));
			if($dependencia->num_rows()>0)
			{
				return $dependencia->row(); //Con el row solo se obtiene una fila de resultados
			}
			else
			{
				return FALSE;
			}
		}

		//Obtiene los semestres que estan actualmente en la tabla semestre
		public function obtener_semestre_carrera_plan()
		{
			$this->db->select('*');
			$this->db->from('carrera');
			$this->db->join('plan', 'plan.idCarrera = carrera.idCarrera', 'INNER');
			$this->db->join('semestre', 'plan.idPlan = semestre.idPlan', 'INNER');
			$resultado= $this->db->get_where('',array('Numero_semestre' => '3'));

			if($resultado->num_rows()>0)
			{
				return $resultado->result();
			}
		}

		//Obtiene los semestres que estan actualmente en la tabla semestre
		public function carrera_semestre($idCarrera)
		{
			$this->db->select('*');
			$this->db->from('carrera');
			$this->db->join('plan', 'plan.idCarrera = carrera.idCarrera', 'INNER');
			$this->db->join('semestre', 'plan.idPlan = semestre.idPlan', 'INNER');
			$resultado= $this->db->get_where('',array('idCarrera' => $idCarrera));

			if($resultado->num_rows()>0)
			{
				return $resultado->result();
			}
		}
	}
?>