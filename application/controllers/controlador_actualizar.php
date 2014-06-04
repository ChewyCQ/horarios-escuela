<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlador_actualizar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database('default');
		$this->load->model('modelo_actualizar');
		$this->load->library('session');
	}

	public function index()
	{
		$this->verificar_sesion();
	}

	public function verificar_sesion()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if (!isset($is_logged_in) || $is_logged_in != TRUE) {
			redirect('login');
			die();
		}
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
		$this->modelo_actualizar->actualiza_materia($this->input->post('nombre_materia'),$this->input->post('tipo_materia'),$this->input->post('especialidades'),$this->input->post('materia_especialidad'),$idMateria);
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
		$this->load->library('fechas');
		//Colocar nuevo formato a la fecha para guardar en la base como date
		$fecha=$this->input->post('fecha_ingreso');
		if($fecha!=null)
		{
			$fecha_date=$this->fechas->fecha_dd_mes_aaaa($fecha);
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
		$this->modelo_actualizar->actualiza_maestro($idMaestro,$this->input->post('clave'),$this->input->post('nombre'),$this->input->post('nivel'),$fecha_date,$this->input->post('horas'),$this->input->post('email'),$this->input->post('certificacion'),$idEspecialidad,$this->input->post('activo'));
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
		$this->load->model('modelo_buscar');
		$this->load->model('modelo_inicio');
		$resultado=$this->modelo_buscar->valida_grupo($this->input->post('clave')); //Consulta para verificar que no exista grupo con la misma clave
		if($resultado==0) //Si retorna 0 significa que no hay registro con la misma clave de grupo
		{
			$idGrupo=$this->input->get('id', TRUE);
			$this->modelo_actualizar->actualiza_grupo($idGrupo,$this->input->post('generacion'),$this->input->post('clave'),$this->input->post('cantidad_alumnos'),$this->input->post('turno'),$this->input->post('id_plan'));
			$this->index();
		}
		else //Si retorna 1, significa ya hay un grupo con la misma clave, entonces, llamo el error y cargo los datos que ya había ingresado
		{
			$generacion=$this->input->post('generacion');
			$cantidad_alumnos=$this->input->post('cantidad_alumnos');
			$turno=$this->input->post('turno');
			$idPlan=$this->input->post('id_plan');

			$data = array('idGrupo' => '',
						  'Generacion' => $generacion,
						  'Clave'=>'',
						  'cantidad_alumnos'=>$cantidad_alumnos,
						  'turno'=>$turno,
						  'idPlan'=>$idPlan,
						  'planes'=>$this->modelo_inicio->obtener_plan(),
						  'var' => 1
						  );
			$this->load->view('registrar/vista_grupo',$data);
		}		
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
		$this->modelo_actualizar->actualiza_dependencia($idDependencia,$this->input->post('nombre'),$this->input->post('cantidad'),$this->input->post('maestros'),$this->input->post('maestro_campo'));
		$this->index();
	}
	public function actualiza_ciclo()
	{
		$idPeriodo=$this->input->get('id', TRUE);
		$this->modelo_actualizar->actualiza_ciclo($idPeriodo,$this->input->post('clave'),$this->input->post('anio'),$this->input->post('semestre'));
		$this->index();
	}
	public function actualiza_materia_semestre()
	{
		$this->modelo_actualizar->actualiza_materia_semestre($this->input->post('materia_semestre'),$this->input->post('horas_escuela'),$this->input->post('horas_campo'),$this->input->post('id_materia'));
		$this->index();
	}
}