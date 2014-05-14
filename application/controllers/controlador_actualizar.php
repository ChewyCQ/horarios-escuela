<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlador_actualizar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database('default');
		$this->load->model('modelo_actualizar');
		include('/assets/fecha.php'); //Librerías que convierte la fecha a número y a letra	
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
	public function actualiza_maestro()
	{	
		//Colocar nuevo formato a la fecha para guardar en la base como date
		$fecha=$this->input->post('fecha_ingreso');
		if($fecha!=null)
		{
			$fecha_separada = explode(" ", $fecha);
			$dia=$fecha_separada[0];
			$mes= mes_numero(strtolower($fecha_separada[1])); //Utilizo el método mes de la librería de fecha para convertirlo a número
			$anio=$fecha_separada[2];
			$fecha_date=$anio.'-'.$mes.'-'.$dia;
		}
		else{
			$fecha_date=$fecha;
		}

		$idEspecialidad=$this->input->post('id_especialidad');
		if($idEspecialidad=='NULL')
		{
			$idEspecialidad=null;
		}
		$idMaestro=$this->input->get('id', TRUE);
		$this->modelo_actualizar->actualiza_maestro($idMaestro,$this->input->post('clave'),$this->input->post('nombre'),$this->input->post('nivel'),$fecha_date,$this->input->post('horas'),$this->input->post('email'),$this->input->post('profordem'),$idEspecialidad,$this->input->post('activo'));
		$this->index();
	}
	public function actualiza_carrera()
	{
		$idCarrera=$this->input->get('id', TRUE);
		$this->modelo_actualizar->actualiza_carrera($idCarrera,$this->input->post('nombre_carrera'));
		$this->index();
	}
	public function actualiza_plan()
	{
		$idPlan=$this->input->get('id', TRUE);
		$this->modelo_actualizar->actualiza_plan($idPlan,$this->input->post('nombre_plan'),$this->input->post('id_carrera'));
		$this->index();
	}
	public function actualiza_grupo()
	{
		$idGrupo=$this->input->get('id', TRUE);
		$this->modelo_actualizar->actualiza_grupo($idGrupo,$this->input->post('generacion'),$this->input->post('clave'),$this->input->post('id_semestre'));
		$this->index();
	}
	public function actualiza_alumno()
	{
		$idAlumno=$this->input->get('id', TRUE);
		$this->modelo_actualizar->actualiza_alumno($idAlumno,$this->input->post('nombre'),$this->input->post('email'),$this->input->post('id_grupo'));
		$this->index();
	}
	public function actualiza_dependencia()
	{
		$idDependencia=$this->input->get('id', TRUE);
		$this->modelo_actualizar->actualiza_dependencia($idDependencia,$this->input->post('nombre'),$this->input->post('cantidad'));
		$this->index();
	}
}