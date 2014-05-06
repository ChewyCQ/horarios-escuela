<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Inicio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('inicio_modelo');
		$this->load->database('default');
	}

	public function index()
	{
		$data = array('title' => "Ejemplo");
		$this->load->view('prueba', $data /*FALSE*/);
	}
	public function area()
	{
		$this->load->view('registrar/vista_area_formacion');
	}
	public function maestro()
	{
		$datos['especialidades'] = $this->inicio_modelo->obtener_especialidades(); //Asignamos a un array el resultado de la consulta
		$this->load->view('registrar/vista_maestro',$datos);
	}
	public function materia()
	{
		$this->load->view('registrar/vista_materia');
	}
	public function semestre()
	{
		$datos['planes'] = $this->inicio_modelo->obtener_plan(); //Asignamos a un array el resultado de la consulta
		$this->load->view('registrar/vista_semestre',$datos);
	}
	public function plan()
	{
		$datos['carreras'] = $this->inicio_modelo->obtener_carreras(); //Asignamos a un array el resultado de la consulta
		$this->load->view('registrar/vista_plan',$datos);

	}
	public function carrera()
	{
		$this->load->view('registrar/vista_carrera');
	}
	public function especialidad()
	{
		$this->load->view('registrar/vista_especialidad');
	}

}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */