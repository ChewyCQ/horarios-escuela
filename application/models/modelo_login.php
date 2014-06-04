<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelo_login extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database('default');
	}

	function validar()
	{
		$this->db->where('Usuario', $this->input->post('usuario'));
		$this->db->where('Password', md5($this->input->post('contrasena')));
		// $this->db->select('idLogin');
		$query = $this->db->get('login');

		if ($query->num_rows == 1) 
		{
			return $query->row_array();
		}
		else
		{
			return NULL;
		}
	}
	function registrar_sesion($idLogin)
	{
		$datos = array('idLogin' => $idLogin);
		$this->db->insert('sesion', $datos);
	}

}

/* End of file modelo_login.php */
/* Location: ./application/models/modelo_login.php */