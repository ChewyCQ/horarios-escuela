<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csv_modelo extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database('default');
	}

	public function insertar_maestros($maestros)
	{
		foreach ($maestros as $maestro) {
			$this->db->insert(
				'maestro', 
				array(
					'Clave' => $maestro['clave'],
					'Nombre' => strtoupper($maestro['nombre']),
					'Nivel' => $maestro['nivel'],
					'Fecha_ingreso' => $maestro['fecha de ingreso'],
					'Correo' => $maestro['correo'],
					'Profordem' => $maestro['profordem']
					) 
			);
		}
	}

}

/* End of file csv_modelo.php */
/* Location: ./application/models/csv_modelo.php */