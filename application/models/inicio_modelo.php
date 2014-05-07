<?php

	class Inicio_modelo extends CI_Model
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

		public function registrar_carrera($carrera)
		{
            $this->db->insert('carrera', array('Nombre_carrera' => $carrera)); 
		}
		public function registrar_materia($materia,$tipo_materia)
		{
			$this->db->insert('materia', array('Nombre_materia' => $materia,'Tipo_materia' => $tipo_materia)); 
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
		public function registrar_maestro($nombre,$nivel,$fecha,$correo,$profordem,$especialidad)
		{
            $this->db->insert('maestro', array('Nombre' => $nombre,'Nivel' => $nivel,'Fecha_ingreso' => $fecha,'Correo' => $correo,'Profordem' => $profordem,'idEspecialidad' => $especialidad)); 
		}

		///----------------------ACTUALIZACIONES A LA BASE DE DATOS DE LOS REGISTROS--------------------////
		public function actualiza_area($especialidad,$id)
		{
            $data = array(
               'Nombre' => $especialidad
            );
            $this->db->where('id', $id);
			$this->db->update('maestro_especialidad', $data); 
		}
		
	}

?>