<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlador_registrar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','file','url'));
		$this->load->model('modelo_registrar');
		$this->load->database('default');
		$this->load->library('form_validation'); //Limpia el formulario de inyecciones y sirve para las validaciones
	}

	public function index()
	{
		$data = array('title' => "Ejemplo");
		$this->load->view('prueba', $data);
	}
	public function guarda_carrera()
	{
		$this->form_validation->set_rules('nombre_carrera','Carrera','trim|required|min_length[5]|max_length[70]');

		//Mensaje que muestra si encuenrra algún error de los previstos en las validaciones
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		$this->form_validation->set_message('max_length', 'El Campo %s debe tener un Maximo de %d Caracteres');

		if ($this->form_validation->run() == FALSE)
		{
			//echo "Posibles errores: ".validation_errors();  //Imprime los errores
			echo "Posibles errores: ".validation_errors();  //Imprime los errores			
			redirect('/controlador_inicio/carrera','refresh'); //redirigir a las vista de los maestros subidos
		}
		else{
			echo "No hay errores";			
		}
		//$this->modelo_registrar->registrar_carrera($this->input->post('nombre_carrera'));
		//$this->index();
	}
	public function guarda_materia()
	{
		$this->modelo_registrar->registrar_materia($this->input->post('nombre_materia'),$this->input->post('tipo_materia'),$this->input->post('especialidades'));
		$this->index();
	}
	public function guarda_materia_semestre()
	{
		$this->modelo_registrar->registrar_materia_semestre($this->input->post('id_materia'),$this->input->post('semestres'),$this->input->post('horas_escuela'),$this->input->post('horas_campo'));
		$this->index();
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
		if($fecha!=null)
		{
			$fecha_date=$this->fechas->fecha_dd_mes_aaaa($fecha);
		}
		else{
			$fecha_date='0000-00-00';
		}

		$idEspecialidad=$this->input->post('id_especialidad');
		if($idEspecialidad=='NULL')
		{
			$idEspecialidad=null;
		}
		$this->modelo_registrar->registrar_maestro($this->input->post('clave'),$this->input->post('nombre'),$this->input->post('nivel'),$fecha_date,$this->input->post('horas'),$this->input->post('email'),$this->input->post('profordem'),$idEspecialidad,$this->input->post('activo'));
		$this->index();
	}
	public function guarda_grupo()
	{
		$this->modelo_registrar->registrar_grupo($this->input->post('generacion'),$this->input->post('clave'),$this->input->post('id_semestre'),$this->input->post('turno'));
		$this->index();
	}
	public function guarda_alumno()
	{
		$this->modelo_registrar->registrar_alumno($this->input->post('nombre'),$this->input->post('email'),$this->input->post('id_grupo'));
		$this->index();
	}
	public function guarda_dependencia()
	{
		$this->modelo_registrar->registrar_dependencia($this->input->post('nombre'),$this->input->post('cantidad'));
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