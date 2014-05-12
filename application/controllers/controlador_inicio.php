<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Controlador_inicio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('modelo_inicio');
		$this->load->model('modelo_consultas');
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
		$idMaestro=$this->input->get('id', TRUE);
		$datos['especialidades'] = $this->modelo_inicio->obtener_especialidades(); //Asignamos a un array el resultado de la consulta
		$this->load->view('registrar/vista_maestro');
	}
	public function materia()
	{
		$idMateria=$this->input->get('id', TRUE);
		$consulta=$this->modelo_consultas->consulta_materia($idMateria);
		
		if($consulta != FALSE)
		{
			$data = array('Nombre_materia' => $consulta->Nombre_materia,'Tipo_materia' => $consulta->Tipo_materia,'idMateria'=>$consulta->idMateria);
		} 
		else
		{
			$data = array('Nombre_materia' => '','Tipo_materia' => '','idMateria'=>'');
		}	
		$this->load->view('registrar/vista_materia',$data);
	}
	public function semestre()
	{
		$idSemestre=$this->input->get('id', TRUE);
		$consulta=$this->modelo_consultas->consulta_semestre($idSemestre);
		
		if($consulta != FALSE)
		{
			$data = array('Numero_semestre' => $consulta->Numero_semestre,'idPlan' => $consulta->idPlan,'idSemestre'=>$consulta->idSemestre,'planes' => $this->modelo_inicio->obtener_plan());
		} 
		else
		{
			$data = array('Numero_semestre' => '','idPlan' =>'','idSemestre'=>'','planes' => $this->modelo_inicio->obtener_plan());
		}	
		$this->load->view('registrar/vista_semestre',$data);		
	}
	public function plan()
	{
		$datos['carreras'] = $this->modelo_inicio->obtener_carreras(); //Asignamos a un array el resultado de la consulta
		$this->load->view('registrar/vista_plan',$datos);

	}
	public function carrera()
	{
		$this->load->view('registrar/vista_carrera');
	}
	public function grupo()
	{
		$datos['semestres'] = $this->modelo_inicio->obtener_semestres();
		$this->load->view('registrar/vista_grupo',$datos);
	}
	public function alumno()
	{
		$datos['grupos'] = $this->modelo_inicio->obtener_grupos();
		$this->load->view('registrar/vista_alumno',$datos);
	}
	public function dependencia()
	{
		$this->load->view('registrar/vista_dependencia');
	}
	public function especialidad()
	{
		$idEspecialidad=$this->input->get('id', TRUE);
		$consulta=$this->modelo_consultas->consulta_especialidad($idEspecialidad);
		
		if($consulta != FALSE)
		{
			$data = array('Nombre' => $consulta->Nombre,'idEspecialidad'=>$consulta->idEspecialidad);
		} 
		else
		{
			$data = array('Nombre' => '','idEspecialidad'=>'');	
		}	
		$this->load->view('registrar/vista_especialidad',$data);
	}

	//Vistas para editar los registros
	public function edita_area()
	{
		$datos['areas']=$this->modelo_inicio->obtener_areas();
		$this->load->view('editar/vista_edita_area',$datos);
	}
	public function edita_maestro()
	{
		$datos['maestros']=$this->modelo_inicio->obtener_maestros();
		$this->load->view('editar/vista_edita_maestro',$datos);
	}
	public function edita_materia()
	{
		$datos['materias']=$this->modelo_inicio->obtener_materias();
		$this->load->view('editar/vista_edita_materia',$datos);
	}
	public function edita_semestre()
	{
		$datos['semestres']=$this->modelo_consultas->obtener_semestres_plan();
		$this->load->view('editar/vista_edita_semestre',$datos);
	}
	public function edita_plan()
	{
		$datos['planes']=$this->modelo_consultas->obtener_planes_carrera();
		$this->load->view('editar/vista_edita_plan',$datos);
	}
	public function edita_carrera()
	{
		$this->load->view('editar/datatable');
	}

}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */