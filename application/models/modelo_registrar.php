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
			$this->db->insert('materia', array('Nombre_materia' => $materia,'Tipo_materia' => $tipo_materia)); 
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
		public function registrar_materia_semestre($idMateria,$semestres,$horas)
		{
			for($i=0; $i<count($semestres);$i++)
			{
				$data = array(
				'idMateria' => $idMateria,
				'idSemestre' => $semestres[$i],
				'Horas_por_semana' => $horas
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
            $this->db->insert('maestro_especialidad', array('Nombre' => $especialidad)); 
		}
		public function registrar_maestro($clave,$nombre,$nivel,$fecha,$horas,$correo,$profordem,$especialidad,$activo)
		{
            $this->db->insert('maestro', array('Clave' => $clave,'Nombre' => $nombre,'Nivel' => $nivel,'Fecha_ingreso' => $fecha,'horas' => $horas,'Correo' => $correo,'Profordem' => $profordem,'idEspecialidad' => $especialidad,'activo' => $activo)); 
		}
		public function registrar_grupo($generacion,$clave,$idSemestre)
		{
            $this->db->insert('grupo', array('Generacion' => $generacion,'Clave' => $clave, 'idSemestre' => $idSemestre)); 
		}
		public function registrar_alumno($nombre,$email,$idGrupo)
		{
            $this->db->insert('alumno', array('Nombre' => $nombre,'Correo' => $email, 'idGrupo' => $idGrupo)); 
		}
		public function registrar_dependencia($nombre,$cantidad)
		{
            $this->db->insert('dependencia', array('Nombre' => $nombre,'CantidadMaxAlumnos' => $cantidad)); 
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