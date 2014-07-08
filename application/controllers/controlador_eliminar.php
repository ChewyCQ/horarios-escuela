<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlador_eliminar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database('default');
		$this->load->model('modelo_eliminar');
		$this->verificar_sesion();
	}

	public function index()
	{
		redirect('controlador_inicio');
	}

	public function verificar_sesion()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if (!isset($is_logged_in) || $is_logged_in != TRUE) {
			redirect('login');
			die();
		}
	}

	public function elimina_maestro_puede_materia($idMater)
	{
		$this->modelo_eliminar->elimina_maestro_puede_materia($this->input->post('id_maestro'),$this->input->post('materias'));
		$this->index();
	}
}