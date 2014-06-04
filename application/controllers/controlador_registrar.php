<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlador_registrar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','file','url'));
		$this->load->model('modelo_registrar');
		$this->load->model('modelo_consultas');
		$this->load->database('default');
		$this->load->library('form_validation','session'); //Limpia el formulario de inyecciones y sirve para las validaciones
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
	public function guarda_carrera()
	{
		$this->modelo_registrar->registrar_carrera($this->input->post('nombre_carrera'));
		$this->index();
	}
	public function guarda_materia()
	{
		$this->modelo_registrar->registrar_materia($this->input->post('nombre_materia'),$this->input->post('tipo_materia'),$this->input->post('especialidades'));
		$this->index();		
	}
	public function guarda_materia_semestre()
	{
		if($this->input->post('semestres')!=null)
		{
			$this->load->model('modelo_buscar');			
			$resultado=$this->modelo_buscar->valida_materia_semestre($this->input->post('id_materia'),$this->input->post('semestres'));
			if($resultado==0) //Si retorna 0 significa que no hay registro de materia asociada a ese semestre
			{
				$this->modelo_registrar->registrar_materia_semestre($this->input->post('id_materia'),$this->input->post('semestres'),$this->input->post('horas_escuela'),$this->input->post('horas_campo'));
				$this->index();
			}
			else //Si no retorna 0, retorna 1 y significa que esa materia ya esta asociada a algun semestre seleccionado
			{
				$data = array('semestres'=>$this->modelo_consultas->obtener_semestre_carrera_plan(),
					  'materias'=>$this->modelo_consultas->obtener_materias_semestre(),
					  'var' => 2,
					  'id_materia' => '',
					  'horas_escuela' => '',
					  'horas_campo' => ''
					 );
				$this->load->view('asignar/vista_materia_semestre',$data);
			}
			
		}
		else
		{
			$id_materia=$this->input->post('id_materia');
			$horas_escuela=$this->input->post('horas_escuela');
			$horas_campo=$this->input->post('horas_campo');
			
			$data = array('semestres'=>$this->modelo_consultas->obtener_semestre_carrera_plan(),
						  'materias'=>$this->modelo_consultas->obtener_materias_semestre(),
						  'var' => 1,
						  'id_materia' => $id_materia,
						  'horas_escuela' => $horas_escuela,
						  'horas_campo' => $horas_campo
						  );
			$this->load->view('asignar/vista_materia_semestre',$data);
		}
		
	}
	public function guarda_plan()
	{
		$this->modelo_registrar->registrar_plan($this->input->post('nombre_plan'),$this->input->post('id_carrera'));
		$this->index();
	}
	public function guarda_semestre()
	{
		$this->modelo_registrar->registrar_semestre($this->input->post('numero_semestre'),$this->input->post('id_plan'));
		$this->index();
	}
	public function guarda_especialidad()
	{
		$this->modelo_registrar->registrar_especialidad($this->input->post('nombre_especialidad'));
		$this->index();
	}
	public function guarda_maestro()
	{
		$this->load->library('fechas');
		//Colocar nuevo formato a la fecha para guardar en la base como date
		$fecha=$this->input->post('fecha_ingreso');
		$fecha_date="";
		if($fecha!=null)
		{
			$fecha_date=$this->fechas->fecha_dd_mes_aaaa($fecha);
		}
		else{
			$fecha_date='NULL';
		}
		$idEspecialidad=$this->input->post('id_especialidad');
		if($idEspecialidad=='NULL')
		{
			$idEspecialidad=null;
		}
		$this->modelo_registrar->registrar_maestro($this->input->post('clave'),$this->input->post('nombre'),$this->input->post('nivel'),$fecha_date,$this->input->post('horas'),$this->input->post('email'),$this->input->post('certificacion'),$idEspecialidad,$this->input->post('activo'));
		$this->index();
	}
	public function guarda_grupo()
	{
		$this->load->model('modelo_buscar');
		$this->load->model('modelo_inicio');
		$resultado=$this->modelo_buscar->valida_grupo($this->input->post('clave')); //Consulta para verificar que no exista grupo con la misma clave
		if($resultado==0) //Si retorna 0 significa que no hay registro con la misma clave de grupo
		{
			$this->modelo_registrar->registrar_grupo($this->input->post('generacion'),$this->input->post('clave'),$this->input->post('cantidad_alumnos'),$this->input->post('turno'),$this->input->post('id_plan'));
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
	public function guarda_alumno()
	{
		$this->modelo_registrar->registrar_alumno($this->input->post('nombre'),$this->input->post('email'),$this->input->post('id_grupo'));
		$this->index();
	}
	public function guarda_dependencia()
	{
		$this->modelo_registrar->registrar_dependencia($this->input->post('nombre'),$this->input->post('cantidad'),$this->input->post('maestros'));
		$this->index();
	}
	public function guarda_periodo()
	{
		$this->modelo_registrar->registrar_periodo($this->input->post('clave'),$this->input->post('anio'),$this->input->post('semestre'));
		$this->index();
	}
	public function guardar_escuela()
	{
		$escuela['Nombre'] = $this->input->post('nombre_escuela');
		$this->load->model('modelo_registrar');
		$this->modelo_registrar->registrar_escuela($escuela);
		redirect('controlador_inicio');
	}


}