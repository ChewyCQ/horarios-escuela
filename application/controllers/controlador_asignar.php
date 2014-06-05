<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Controlador_asignar extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		// $this->load->library('session');
		$this->load->database('default');
		$this->load->model('modelo_consultas');
		$this->load->model('modelo_inicio');
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
	public function materia_semestre()
	{
		$data = array('semestres'=>$this->modelo_consultas->obtener_semestre_carrera_plan(),
					  'materias'=>$this->modelo_consultas->obtener_materias_semestre(),
					  'var' => 0,
					  'id_materia' => '',
					  'horas_escuela' => '',
					  'horas_campo' => ''
					 );
		$this->load->view('asignar/vista_materia_semestre',$data);
	}

	public function maestro_materia()
	{
		$data = array('maestros' => $this->modelo_inicio->obtener_maestros());
		$this->load->view('asignar/vista_maestro_materia',$data);
	}

}