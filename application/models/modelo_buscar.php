<?php

	class Modelo_buscar extends CI_Model
	{
		public function __construct()
		{
			parent:: __construct();
		}
		//Obtener los maestros al ir introduciendo letras en el campo
		public function get_maestros($q)
		{
		    $this->db->select('Nombre');
		    $this->db->like('Nombre', $q);
		    $query = $this->db->get('maestro');
		    if($query->num_rows > 0)
		    {
		      foreach ($query->result_array() as $row)
		      {
		        $row_set[] = stripslashes($row['Nombre']); //Se crea el array de resultados
		        //stripslashes: Esta función se puede utilizar para limpiar los datos recuperados de una base de datos o de un formulario HTML
		      }
		      echo json_encode($row_set); //Se forma el array en un formato de json
		    }
		}	
		//Obtener las especialidades al ir introduciendo letras en el campo
		public function get_especialidades($q)
		{
		    $this->db->select('Nombre_especialidad');
		    $this->db->like('Nombre_especialidad', $q);
		    $query = $this->db->get('especialidad');
		    if($query->num_rows > 0)
		    {
		      foreach ($query->result_array() as $row)
		      {
		        $row_set[] = stripslashes($row['Nombre_especialidad']); //Se crea el array de resultados
		        //stripslashes: Esta función se puede utilizar para limpiar los datos recuperados de una base de datos o de un formulario HTML
		      }
		      echo json_encode($row_set); //Se forma el array en un formato de json
		    }
		}	
		//Obtener las materias al ir introduciendo letras en el campo
		public function get_materias($q)
		{
		    $this->db->select('Nombre_materia');
		    $this->db->like('Nombre_materia', $q);
		    $query = $this->db->get('materia');
		    if($query->num_rows > 0)
		    {
		      foreach ($query->result_array() as $row)
		      {
		        $row_set[] = stripslashes($row['Nombre_materia']); //Se crea el array de resultados
		        //stripslashes: Esta función se puede utilizar para limpiar los datos recuperados de una base de datos o de un formulario HTML
		      }
		      echo json_encode($row_set); //Se forma el array en un formato de json
		    }
		}
		//Obtener los planes al ir introduciendo letras en el campo
		public function get_planes($q)
		{
		    $this->db->select('Nombre_plan');
		    $this->db->like('Nombre_plan', $q);
		    $query = $this->db->get('plan');
		    if($query->num_rows > 0)
		    {
		      foreach ($query->result_array() as $row)
		      {
		        $row_set[] = stripslashes($row['Nombre_plan']); //Se crea el array de resultados
		        //stripslashes: Esta función se puede utilizar para limpiar los datos recuperados de una base de datos o de un formulario HTML
		      }
		      echo json_encode($row_set); //Se forma el array en un formato de json
		    }
		}
		//Obtener las carreras al ir introduciendo letras en el campo
		public function get_carreras($q)
		{
		    $this->db->select('Nombre_carrera');
		    $this->db->like('Nombre_carrera', $q);
		    $query = $this->db->get('carrera');
		    if($query->num_rows > 0)
		    {
		      foreach ($query->result_array() as $row)
		      {
		        $row_set[] = stripslashes($row['Nombre_carrera']); //Se crea el array de resultados
		        //stripslashes: Esta función se puede utilizar para limpiar los datos recuperados de una base de datos o de un formulario HTML
		      }
		      echo json_encode($row_set); //Se forma el array en un formato de json
		    }
		}
		//Obtener los grupos al ir introduciendo letras en el campo
		public function get_grupos($q)
		{
		    $this->db->select('Clave');
		    $this->db->like('Clave', $q);
		    $query = $this->db->get('grupo');
		    if($query->num_rows > 0)
		    {
		      foreach ($query->result_array() as $row)
		      {
		        $row_set[] = stripslashes($row['Clave']); //Se crea el array de resultados
		        //stripslashes: Esta función se puede utilizar para limpiar los datos recuperados de una base de datos o de un formulario HTML
		      }
		      echo json_encode($row_set); //Se forma el array en un formato de json
		    }
		}
		//Obtener los alumnos al ir introduciendo letras en el campo
		public function get_alumnos($q)
		{
		    $this->db->select('Nombre');
		    $this->db->like('Nombre', $q);
		    $query = $this->db->get('alumno');
		    if($query->num_rows > 0)
		    {
		      foreach ($query->result_array() as $row)
		      {
		        $row_set[] = stripslashes($row['Nombre']); //Se crea el array de resultados
		        //stripslashes: Esta función se puede utilizar para limpiar los datos recuperados de una base de datos o de un formulario HTML
		      }
		      echo json_encode($row_set); //Se forma el array en un formato de json
		    }
		}
		//Obtener las dependencias al ir introduciendo letras en el campo
		public function get_dependencias($q)
		{
		    $this->db->select('Nombre');
		    $this->db->like('Nombre', $q);
		    $query = $this->db->get('dependencia');
		    if($query->num_rows > 0)
		    {
		      foreach ($query->result_array() as $row)
		      {
		        $row_set[] = stripslashes($row['Nombre']); //Se crea el array de resultados
		        //stripslashes: Esta función se puede utilizar para limpiar los datos recuperados de una base de datos o de un formulario HTML
		      }
		      echo json_encode($row_set); //Se forma el array en un formato de json
		    }
		}
		//Valida que la materia no este asociada a algun semestre
		public function valida_materia_semestre($idMateria,$semestres)
		{
			
			for($i=0; $i<count($semestres);$i++)
			{	
				$this->db->select('*');
				$this->db->from('materia_semestre');			
				$this->db->where(array('materia_semestre.idMateria' => $idMateria, 'idSemestre' => $semestres[$i]));
				$resultado=$this->db->get();
			}		
			if($resultado->num_rows()>0)
			{
				return 1; //Retorna 1 si ya hay materias que estan asociadas a ese semestre
			}
			else
			{
				return 0; //Retorna 0 si no hay materias asociadas a ese semestre
			}
		}

		//Valida que no haya un grupo con la misma clave
		public function valida_grupo($clave)
		{
			$this->db->select('*');
			$this->db->from('grupo');			
			$this->db->where(array('grupo.Clave' => $clave));
			$resultado=$this->db->get();
					
			if($resultado->num_rows()>0)
			{
				return 1; //Retorna 1 si ya hay un grupo que tiene la misma clave
			}
			else
			{
				return 0; //Retorna 0 si no hay grupos con la misma clave
			}
		}
	}
?>