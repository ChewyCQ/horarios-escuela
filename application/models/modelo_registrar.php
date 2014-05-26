<?php

	class Modelo_registrar extends CI_Model
	{
		public function __construct()
		{
			parent:: __construct();
		}
		public function registrar_carrera($carrera)
		{
			//La función preg_replace elimina todos los espacios en blanco si estos son mayores a 1 entre cada texto 
			$carrera=preg_replace('/\s+/', ' ', $carrera);  
			//La función trim elimina todos los espaciosn en blanco al inicio y al final del texto
            $this->db->insert('carrera', array('Nombre_carrera' => trim($carrera))); 
		}
		public function registrar_materia($materia,$tipo_materia,$especialidades)
		{
			//$cadena = str_replace(' ', '', $materia);//Quita todos los espacios en blanco de la cadena
			$consulta= $this->db->get_where('materia', array('Nombre_materia' => $materia));
			if($consulta->num_rows()>0)
			{
				return FALSE;
			}
			else
			{
				$this->db->insert('materia', array('Nombre_materia' => strtoupper($materia),'Tipo_materia' => $tipo_materia)); 
				$ultimo_id=$this->db->insert_id();
				if($especialidades!=null)
				{
					for($i=0; $i<count($especialidades);$i++)
					{
						$data = array(
						'idMateria' => $ultimo_id,
						'idEspecialidad' => $especialidades[$i],
						);
						$this->db->insert('especialidad_materia',$data); 
					}
				}
				return TRUE;
			}
			
		}
		public function registrar_materia_semestre($idMateria,$semestres,$horas_escuela,$horas_campo)
		{
			for($i=0; $i<count($semestres);$i++)
			{
				$data = array(
				'idMateria' => $idMateria,
				'idSemestre' => $semestres[$i],
				'Horas_semana_escuela' => $horas_escuela,
				'Horas_semana_campo_clinico' => $horas_campo
				);
				$this->db->insert('materia_semestre',$data); 
			}
		}
		public function registrar_plan($plan,$idCarrera)
		{
			$this->db->insert('plan', array('Nombre_plan' => $plan,'idCarrera' => $idCarrera)); 
		}
		public function registrar_semestre($numero_semestre,$idPlan)
		{
			$this->db->insert('semestre', array('Numero_semestre' => $numero_semestre,'idPlan' => $idPlan)); 
		}
		public function registrar_especialidad($especialidad)
		{
            $this->db->insert('especialidad', array('Nombre_especialidad' => $especialidad)); 
		}
		public function registrar_maestro($clave,$nombre,$nivel,$fecha,$horas,$correo,$profordem,$especialidad,$activo)
		{
            $this->db->insert('maestro', array('Clave' => $clave,'Nombre' => $nombre,'Nivel' => $nivel,'Fecha_ingreso' => $fecha,'horas' => $horas,'Correo' => $correo,'Profordem' => $profordem,'idEspecialidad' => $especialidad,'activo' => $activo)); 
		}
		public function registrar_grupo($generacion,$clave,$idSemestre,$turno)
		{
            $this->db->insert('grupo', array('Generacion' => $generacion,'Clave' => $clave, 'idSemestre' => $idSemestre, 'turno' => $turno)); 
		}
		public function registrar_alumno($nombre,$email,$idGrupo)
		{
            $this->db->insert('alumno', array('Nombre' => $nombre,'Correo' => $email, 'idGrupo' => $idGrupo)); 
		}
		public function registrar_dependencia($nombre,$cantidad,$maestros)
		{
            $this->db->insert('dependencia', array('Nombre' => $nombre,'CantidadMaxAlumnos' => $cantidad)); 
            $ultimo_id=$this->db->insert_id();
			if($maestros!=null)
			{
				for($i=0; $i<count($maestros);$i++)
				{
					$data = array(
					'idMaestro' => $maestros[$i],
					'idDependencia' => $ultimo_id
					);
					$this->db->insert('maestro_campo_clinico',$data); 
				}
			}

		}
		public function registrar_periodo($periodo)
		{
            $this->db->insert('periodo', $periodo); 
		}
		/**
		 * Inserta o actualiza el registro de la tabla escuela dependiendo si ya hay registros.
		 * @param  Array $escuela datos a inertar/actualzar
		 * @return [type]          [description]
		 */
		public function registrar_escuela($escuela)
		{
			$query = $this->db->get('escuela');
			if($query->num_rows() >= 1){
				$this->db->update('escuela',$escuela);
			}
			else
			{
	            $this->db->insert('escuela', $escuela); 
			}
		}
		public function get_nombre_escuela()
		{
			$query = $this->db->get('escuela');
			foreach ($query->result() as $row)
			{
			    $nombre = $row->Nombre;
			}
			if ( !isset($nombre) )
			{
				$nombre = '';
			}
			return $nombre;
		}
	}
?>