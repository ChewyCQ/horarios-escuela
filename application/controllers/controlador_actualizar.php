<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlador_actualizar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database('default');
		$this->load->model('modelo_actualizar');
	}

	public function index()
	{
		$data = array('title' => "Ejemplo");
		$this->load->view('prueba', $data);
	}
	public function actualiza_especialidad()
	{
		$idEspecialidad=$this->input->get('id', TRUE);
		$this->modelo_actualizar->actualiza_area($this->input->post('nombre_especialidad'),$idEspecialidad);
		$this->index();
	}
	public function actualiza_materia()
	{
		$idMateria=$this->input->get('id', TRUE);
		$this->modelo_actualizar->actualiza_materia($this->input->post('nombre_materia'),$this->input->post('tipo_materia'),$idMateria);
		$this->index();
	}
	public function actualiza_semestre()
	{
		$idSemestre=$this->input->get('id', TRUE);
		$this->modelo_actualizar->actualiza_semestre($this->input->post('numero_semestre'),$this->input->post('id_plan'),$idSemestre);
		$this->index();
	}
}