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
		$this->load->model('modelo_consultas');
		$this->load->model('modelo_inicio');
		$this->load->database('default');
	}
	public function materia_semestre()
	{
		$data = array('semestres'=>$this->modelo_consultas->obtener_semestre_carrera_plan(),'materias'=>$this->modelo_inicio->obtener_materias());
		$this->load->view('asignar/vista_materia_semestre',$data);
	}

}