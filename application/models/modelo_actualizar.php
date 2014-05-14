<?php

	class Modelo_actualizar extends CI_Model
	{
		public function __construct()
		{
			parent:: __construct();
		}

		///----------------------ACTUALIZACIONES A LA BASE DE DATOS DE LOS REGISTROS--------------------////
		public function actualiza_area($especialidad,$id)
		{
            $data = array(
               'Nombre' => $especialidad
            );
            $this->db->where('idEspecialidad', $id);
			   $this->db->update('maestro_especialidad', $data); 
		}
		public function actualiza_materia($nombre,$tipo,$id)
		{
            $data = array(
               'Nombre_materia' => $nombre,
               'Tipo_materia' => $tipo
            );
            $this->db->where('idMateria', $id);
			   $this->db->update('materia', $data); 
		}
		public function actualiza_semestre($numero,$idPlan,$id)
		{
            $data = array(
               'Numero_semestre' => $numero,
               'idPlan' => $idPlan
            );
            $this->db->where('idSemestre', $id);
			   $this->db->update('semestre', $data); 
		}
		public function actualiza_maestro($id,$clave,$nombre,$nivel,$fecha,$horas,$correo,$profordem,$especialidad,$activo)
		{
            $data = array(
               'Clave' => $clave,
               'Nombre' => $nombre,
               'Nivel' => $nivel,
               'Fecha_ingreso' => $fecha,
               'horas' => $horas,
               'Correo' => $correo,
               'Profordem' => $profordem,
               'idEspecialidad' => $especialidad,
               'activo' => $activo,
            );
            $this->db->where('idMaestro', $id);
			   $this->db->update('maestro', $data); 
		}
      public function actualiza_carrera($id,$nombre)
      {
            $data = array(
               'Nombre_carrera' => $nombre
            );
            $this->db->where('idCarrera', $id);
            $this->db->update('carrera', $data); 
      }
      public function actualiza_plan($id,$nombre,$idCarrera)
      {
            $data = array(
               'Nombre_plan' => $nombre,
               'idCarrera' => $idCarrera
            );
            $this->db->where('idPlan', $id);
            $this->db->update('plan', $data); 
      }
      public function actualiza_grupo($id,$generacion,$clave,$idSemestre)
      {
            $data = array(
               'Generacion' => $generacion,
               'Clave' => $clave,
               'idSemestre' =>$idSemestre
            );
            $this->db->where('idGrupo', $id);
            $this->db->update('grupo', $data); 
      }
      public function actualiza_alumno($id,$nombre,$correo,$idGrupo)
      {
            $data = array(
               'Nombre' => $nombre,
               'Correo' => $correo,
               'idGrupo' =>$idGrupo
            );
            $this->db->where('idAlumno', $id);
            $this->db->update('alumno', $data); 
      }
       public function actualiza_dependencia($id,$nombre,$cantidad)
      {
            $data = array(
               'Nombre' => $nombre,
               'CantidadMaxAlumnos' => $cantidad
            );
            $this->db->where('idDependencia', $id);
            $this->db->update('dependencia', $data); 
      }
	}

?>