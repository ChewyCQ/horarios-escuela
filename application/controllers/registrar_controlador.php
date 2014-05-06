<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registrar_controlador extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database('default');
		$this->load->model('inicio_modelo');
	}

	public function index()
	{
		$data = array('title' => "Ejemplo");
		$this->load->view('prueba', $data /*FALSE*/);
	}
	public function guarda_carrera()
	{
		$this->inicio_modelo->registrar_carrera($this->input->post('nombre_carrera'));
		$this->index();
	}
	public function guarda_materia()
	{
		$this->inicio_modelo->registrar_materia($this->input->post('nombre_materia'),$this->input->post('tipo_materia'));
		$this->index();
	}
	public function guarda_plan()
	{
		$this->inicio_modelo->registrar_plan($this->input->post('nombre_plan'),$this->input->post('id_carrera'));
		$this->index();
	}
	public function guarda_semestre()
	{
		$this->inicio_modelo->registrar_semestre($this->input->post('numero_semestre'),$this->input->post('id_plan'));
		$this->index();
	}
	public function guarda_especialidad()
	{
		$this->inicio_modelo->registrar_especialidad($this->input->post('nombre_especialidad'));
		$this->index();
	}
	public function guarda_maestro()
	{
		$this->inicio_modelo->registrar_maestro($this->input->post('nombre'),$this->input->post('nivel'),$this->input->post('fecha_ingreso'),$this->input->post('email'),$this->input->post('profordem'),$this->input->post('id_especialidad'));
		$this->index();
	}

}