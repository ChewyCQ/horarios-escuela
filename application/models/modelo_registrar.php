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
            $datos = array(
			        		'Nombre_carrera' => trim(mb_strtoupper($carrera,'UTF-8'))
			            	);
            $this->db->insert('carrera',$datos); 
		}
		public function registrar_materia($materia,$tipo_materia,$especialidades)
		{
			//La función preg_replace elimina todos los espacios en blanco si estos son mayores a 1 entre cada texto 
			$materia=preg_replace('/\s+/', ' ', $materia);  
			$materia=trim(mb_strtoupper($materia,'UTF-8'));
			$datos = array(
							'Nombre_materia' => $materia,
							'Tipo_materia' => $tipo_materia
							);
			$this->db->insert('materia',$datos); 
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
			$plan=preg_replace('/\s+/', ' ', $plan);  
			$plan=trim(mb_strtoupper($plan,'UTF-8'));
			$datos= array(
							'Nombre_plan' => $plan,
							'idCarrera' => $idCarrera
							);
			$this->db->insert('plan',$datos); 

			$idPlan = $this->db->insert_id();
			//Semestres del plan
			for ($num_semestre=1; $num_semestre <= 6; $num_semestre++) { 
				$this->db->insert('semestre', 
					array(
						'Numero_semestre' => $num_semestre, 
						'idPlan' => $idPlan)
					);
			}
		}
		public function registrar_semestre($numero_semestre,$idPlan)
		{
			$this->db->insert('semestre', array('Numero_semestre' => $numero_semestre,'idPlan' => $idPlan)); 
		}
		public function registrar_especialidad($especialidad)
		{
			$especialidad=preg_replace('/\s+/', ' ', $especialidad);  
			$especialidad=trim(mb_strtoupper($especialidad,'UTF-8'));
			$datos = array(
							'Nombre_especialidad' => $especialidad
							);
            $this->db->insert('especialidad',$datos); 
		}
		public function registrar_maestro($clave,$nombre,$nivel,$fecha,$horas,$correo,$certificacion,$especialidad,$activo)
		{
			$nombre=preg_replace('/\s+/', ' ', $nombre);  
			$nombre=trim(mb_strtoupper($nombre,'UTF-8'));
			$datos = array(
							'Clave' => $clave,
							'Nombre' => $nombre,
							'Nivel' => $nivel,
							'Fecha_ingreso' => $fecha,
							'horas' => $horas,
							'Correo' => $correo,
							'Certificacion' => $certificacion,
							'idEspecialidad' => $especialidad,
							'activo' => $activo);
            $this->db->insert('maestro',$datos); 
		}
		public function registrar_grupo($generacion,$clave,$idSemestre,$turno)
		{
            $this->db->insert('grupo', array('Generacion' => $generacion,'Clave' => $clave, 'idSemestre' => $idSemestre, 'turno' => $turno)); 
		}
		public function registrar_alumno($nombre,$email,$idGrupo)
		{
			$nombre=preg_replace('/\s+/', ' ', $nombre);  
			$nombre=trim(mb_strtoupper($nombre,'UTF-8'));
			$datos=array(
						'Nombre' => $nombre,
						'Correo' => $email, 
						'idGrupo' => $idGrupo
						);
            $this->db->insert('alumno',$datos); 
		}
		public function registrar_dependencia($nombre,$cantidad,$maestros)
		{
			$nombre=preg_replace('/\s+/', ' ', $nombre);  
			$nombre=trim(mb_strtoupper($nombre,'UTF-8'));
			$datos=array(
						'Nombre' => $nombre,
						'CantidadMaxAlumnos' => $cantidad
						);
            $this->db->insert('dependencia',$datos); 

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
		public function registrar_periodo($periodo,$anio,$semestre)
		{
			$periodo=preg_replace('/\s+/', ' ', $periodo);  
			$periodo=trim(mb_strtoupper($periodo,'UTF-8'));
			$datos=array(
						'Periodo' => $periodo,
						'semestre' => $semestre,
						'Anio' => $anio
						);
            $this->db->insert('periodo',$datos); 
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