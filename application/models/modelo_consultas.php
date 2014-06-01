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
			$especialidad = $this->db->get_where('especialidad', array('idEspecialidad' => $id));
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
			$this->db->select('*');
			$this->db->from('grupo');
			$this->db->join('semestre', 'semestre.idSemestre = grupo.idSemestre', 'INNER');
			$this->db->join('plan', 'plan.idPlan = semestre.idPlan', 'INNER');
			$this->db->join('carrera', 'carrera.idCarrera = plan.idCarrera', 'INNER');
			$this->db->where(array('grupo.idGrupo' => $id));
			$resultado=$this->db->get();
			if($resultado->num_rows()>0)
			{
				return $resultado->row(); //Con el row solo se obtiene una fila de resultados
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
			$this->db->order_by("Numero_semestre", "asc"); 
			$resultado=$this->db->get();
			
			//$resultado= $this->db->get_where('',array('Numero_semestre' => '3'));

			if($resultado->num_rows()>0)
			{
				return $resultado->result();
			}
		}

		//Obtiene las materias que estan actualmente en la tabla materia
		public function obtener_materias_semestre()
		{
			//La consulta muestra todas las materias que no esten actualmente ligadas a ningun semestre, que no esten en la tabla materia_semestre
			$materias=$this->db->query("select * from materia where not exists (select 1 from materia_semestre where materia_semestre.idMateria = materia.idMateria)");
			if($materias->num_rows()>0)
			{
				return $materias->result();
			}
			else
			{
				return false;
			}
		}

		//Obtiene los semestres que estan actualmente en la tabla semestre
		public function carrera_plan($idCarrera)
		{
			$this->db->select('plan.idPlan,plan.Nombre_plan');
			$this->db->from('carrera');
			$this->db->join('plan', 'plan.idCarrera = carrera.idCarrera', 'INNER');
			//$this->db->join('semestre', 'plan.idPlan = semestre.idPlan', 'INNER');
			$this->db->where(array('carrera.idCarrera' => $idCarrera));
			$resultado=$this->db->get();
			if($resultado->num_rows()>0)
			{
				return $resultado->result();
			}
			else
			{
				return FALSE;
			}
		}
		//Obtiene los semestres que estan actualmente en la tabla semestre
		public function carrera_semestre($idPlan)
		{
			$this->db->select('semestre.idSemestre,semestre.Numero_semestre');
			$this->db->from('plan');
			$this->db->join('semestre', 'semestre.idPlan = plan.idPlan', 'INNER');
			$this->db->where(array('plan.idPlan' => $idPlan));
			$resultado=$this->db->get();
			if($resultado->num_rows()>0)
			{
				return $resultado->result();
			}
			else
			{
				return FALSE;
			}
		}
		//Obtiene los datos de los maestros y la especialidad
		public function obtener_maestros_especialidad()
		{
			$this->db->select('*');
			$this->db->from('maestro');
			$this->db->join('especialidad', 'especialidad.idEspecialidad = maestro.idEspecialidad', 'INNER');
			$resultado=$this->db->get();
			if($resultado->num_rows()>0)
			{
				return $resultado->result();
			}
			else
			{
				return FALSE;
			}
		}
		//Obtiene todas las especialidades que le corresponden a una materia
		public function materia_especialidad($idMateria)
		{
			$this->db->select('especialidad_materia.idEspecialidad,especialidad.Nombre_especialidad');
			$this->db->from('materia');
			$this->db->join('especialidad_materia', 'especialidad_materia.idMateria = materia.idMateria', 'INNER');
			$this->db->join('especialidad', 'especialidad.idEspecialidad= especialidad_materia.idEspecialidad', 'INNER');
			$this->db->where(array('materia.idMateria' => $idMateria));
			$resultado=$this->db->get();
			if($resultado->num_rows()>0)
			{
				return $resultado->result();
			}
			else
			{
				return FALSE;
			}
		}
		//Obtiene todas las especialidades excepto aquellas que ya esten asociadas con alguna materia
		public function obtener_especialidades_filtro($idMateria)
		{
			$resultado=$this->db->query("select * from especialidad where not exists 
										(select 1 from especialidad_materia where 
										 especialidad_materia.idEspecialidad = especialidad.idEspecialidad 
										 and especialidad_materia.idMateria=".$idMateria.")");
			if($resultado->num_rows()>0)
			{
				return $resultado->result();
			}
			else
			{
				return FALSE;
			}
		}
		//Obtiene todos los maestros excepto aquellos que ya esten asociados con alguna dependencia
		public function obtener_maestros_filtro($idDependencia)
		{
			$resultado=$this->db->query("select * from maestro where not exists 
										(select 1 from maestro_campo_clinico where 
										 maestro_campo_clinico.idMaestro = maestro.idMaestro
										 and maestro_campo_clinico.idDependencia=".$idDependencia.") 
										ORDER BY Nombre ASC");
			if($resultado->num_rows()>0)
			{
				return $resultado->result();
			}
			else
			{
				return FALSE;
			}
		}
		//Obtiene todos los maestros que le corresponden a una dependencia
		public function maestro_campo($idDependencia)
		{
			$this->db->select('maestro_campo_clinico.idMaestro,maestro.Nombre');
			$this->db->from('dependencia');
			$this->db->join('maestro_campo_clinico', 'maestro_campo_clinico.idDependencia= dependencia.idDependencia', 'INNER');
			$this->db->join('maestro', 'maestro.idMaestro= maestro_campo_clinico.idMaestro', 'INNER');
			$this->db->where(array('dependencia.idDependencia' => $idDependencia));
			$resultado=$this->db->get();
			if($resultado->num_rows()>0)
			{
				return $resultado->result();
			}
			else
			{
				return FALSE;
			}
		}	

		//Consulta en la tabla de periodo y obtiene los datos que correspondan al id recibido
		public function consulta_ciclo($id)
		{
			$ciclo = $this->db->get_where('periodo', array('idPeriodo' => $id));
			if($ciclo->num_rows()>0)
			{
				return $ciclo->row(); //Con el row solo se obtiene una fila de resultados
			}
			else
			{
				return FALSE;
			}
		}

	}
?>