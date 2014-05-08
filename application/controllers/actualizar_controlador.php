<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actualizar_controlador extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database('default');
		$this->load->model('inicio_modelo');
	}

	public function index()
	{
		
	}
	public function actualiza_especialidad()
	{
		$idEspecialidad=$this->input->get('id', TRUE);
		$this->inicio_modelo->actualiza_area($this->input->post('nombre_especialidad'),$idEspecialidad);
		$this->load->view('prueba');
	}
}