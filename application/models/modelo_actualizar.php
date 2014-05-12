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
	}

?>