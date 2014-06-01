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
         $especialidad=preg_replace('/\s+/', ' ', $especialidad);  
         $especialidad=trim(mb_strtoupper($especialidad,'UTF-8'));
         $data = array(
                     'Nombre_especialidad' => $especialidad
                     );
         $this->db->where('idEspecialidad', $id);
			$this->db->update('especialidad', $data); 
		}
		public function actualiza_materia($nombre,$tipo,$especialidades,$materia_especialidad,$id)
		{
         $nombre=preg_replace('/\s+/', ' ', $nombre);  
         $nombre=trim(mb_strtoupper($nombre,'UTF-8'));
         $data = array(
            'Nombre_materia' => $nombre,
            'Tipo_materia' => $tipo
         );
         $this->db->where('idMateria', $id);
		   $this->db->update('materia', $data); 
         //Si se van a agregar mas especialidades a esa materia, se ejecuta este comando de insercion
         if($especialidades!=null)
         {
            for($i=0; $i<count($especialidades);$i++)
            {
               $data = array(
               'idMateria' => $id,
               'idEspecialidad' => $especialidades[$i],
               );
               $this->db->insert('especialidad_materia',$data); 
            }
         }
         //Si se van a eliminar especialidades asociadas a esa materia, se ejecuta este comando de eliminacion
         if($materia_especialidad!=null)
         {
            for($j=0; $j<count($materia_especialidad);$j++)
            {
               $data = array(
               'idMateria' => $id,
               'idEspecialidad' => $materia_especialidad[$j],
               );
               $this->db->delete('especialidad_materia',$data); 
            }
         }
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
		public function actualiza_maestro($id,$clave,$nombre,$nivel,$fecha,$horas,$correo,$certificacion,$especialidad,$activo)
		{
         $nombre=preg_replace('/\s+/', ' ', $nombre);  
         $nombre=trim(mb_strtoupper($nombre,'UTF-8'));
         $data = array(
            'Clave' => $clave,
            'Nombre' => $nombre,
            'Nivel' => $nivel,
            'Fecha_ingreso' => $fecha,
            'horas' => $horas,
            'Correo' => $correo,
            'Certificacion' => $certificacion,
            'idEspecialidad' => $especialidad,
            'activo' => $activo,
         );
         $this->db->where('idMaestro', $id);
		   $this->db->update('maestro', $data); 
		}
      public function actualiza_carrera($id,$nombre)
      {
         //La función preg_replace elimina todos los espacios en blanco si estos son mayores a 1 entre cada texto 
         $nombre=preg_replace('/\s+/', ' ', $nombre);  
         //La función trim elimina todos los espaciosn en blanco al inicio y al final del texto
         $data = array(
                     'Nombre_carrera' => trim(mb_strtoupper($nombre,'UTF-8'))
                        );
         $this->db->where('idCarrera', $id);
         $this->db->update('carrera', $data); 
      }
      public function actualiza_plan($id,$nombre,$idCarrera)
      {
         $nombre=preg_replace('/\s+/', ' ', $nombre);  
         $nombre=trim(mb_strtoupper($nombre,'UTF-8'));
         $data = array(
            'Nombre_plan' => $nombre,
            'idCarrera' => $idCarrera
         );
         $this->db->where('idPlan', $id);
         $this->db->update('plan', $data); 
      }
      public function actualiza_grupo($id,$generacion,$clave,$idSemestre,$turno)
      {
         $data = array(
            'Generacion' => $generacion,
            'Clave' => $clave,
            'idSemestre' =>$idSemestre,
            'turno' => $turno
         );
         $this->db->where('idGrupo', $id);
         $this->db->update('grupo', $data); 
      }
      public function actualiza_alumno($id,$nombre,$correo,$idGrupo)
      {
         $nombre=preg_replace('/\s+/', ' ', $nombre);  
         $nombre=trim(mb_strtoupper($nombre,'UTF-8'));
         $data = array(
            'Nombre' => $nombre,
            'Correo' => $correo,
            'idGrupo' =>$idGrupo
         );
         $this->db->where('idAlumno', $id);
         $this->db->update('alumno', $data); 
      }
      public function actualiza_dependencia($id,$nombre,$cantidad,$maestros,$maestro_campo)
      {
         $nombre=preg_replace('/\s+/', ' ', $nombre);  
         $nombre=trim(mb_strtoupper($nombre,'UTF-8'));
         $data = array(
            'Nombre' => $nombre,
            'CantidadMaxAlumnos' => $cantidad
         );
         $this->db->where('idDependencia', $id);
         $this->db->update('dependencia', $data); 
         //Si se van a agregar mas maestros a esa dependencia, se ejecuta este comando de insercion
         if($maestros!=null)
         {
            for($i=0; $i<count($maestros);$i++)
            {
               $data = array(
               'idMaestro' => $maestros[$i],
               'idDependencia' => $id
               );
               $this->db->insert('maestro_campo_clinico',$data); 
            }
         }
         //Si se van a eliminar maestros asociados a esa dependencia, se ejecuta este comando de eliminacion
         if($maestro_campo!=null)
         {
            for($j=0; $j<count($maestro_campo);$j++)
            {
               $data = array(
               'idMaestro' => $maestro_campo[$j],
               'idDependencia' => $id,
               );
               $this->db->delete('maestro_campo_clinico',$data); 
            }
         }
      }
      public function actualiza_ciclo($id,$periodo,$anio,$semestre)
      {
         $periodo=preg_replace('/\s+/', ' ', $periodo);  
         $periodo=trim(mb_strtoupper($periodo,'UTF-8'));
         $data = array(
            'Periodo' => $periodo,
            'semestre' => $semestre,
            'Anio' =>$anio
         );
         $this->db->where('idPeriodo', $id);
         $this->db->update('periodo', $data); 
      }
	}

?>