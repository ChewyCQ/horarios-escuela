<?php

	class Modelo_eliminar extends CI_Model
	{
		public function __construct()
		{
			parent:: __construct();
		}
		public function elimina_maestro_puede_materia($idMaestro,$materias)
		{
			if($materias!=null)
			{
	            for($j=0; $j<count($materias);$j++)
	            {
	               $data = array(
	               'idMaestro' => $idMaestro,
	               'idMateria' => $materias[$j],
	               );
	               $this->db->delete('maestro_puede_materia',$data); 
	            }
	         }
	     }
	}
?>