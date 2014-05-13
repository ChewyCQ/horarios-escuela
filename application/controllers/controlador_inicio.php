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
		include('/assets/fecha.php'); //Librerías que convierte la fecha a número y a letra	
	}

	public function index()
	{
		$data = array('title' => "Ejemplo");
		$this->load->view('prueba', $data /*FALSE*/);
	}
	public function maestro()
	{
		$idMaestro=$this->input->get('id', TRUE);
		$consulta=$this->modelo_consultas->consulta_maestro($idMaestro);		
		if($consulta != FALSE)
		{
			//Convertir fecha a texto
			$fecha_separada = explode("-",$consulta->Fecha_ingreso);
			$anio=$fecha_separada[0];
			$mes_texto= mes_letra($fecha_separada[1]); //Utilizo el método mes de la librería de fecha para convertirlo a letra
			$dia=$fecha_separada[2];
			$fecha_texto=$dia.' '.$mes_texto.' '.$anio;

			$data = array('idMaestro'=>$consulta->idMaestro,'Clave' => $consulta->Clave,'Nombre' => $consulta->Nombre,
				'Nivel' => $consulta->Nivel,'Fecha_ingreso' => $fecha_texto,'horas' => $consulta->horas,
				'Correo' => $consulta->Correo,'Profordem' => $consulta->Profordem,'idEspecialidad' => $consulta->idEspecialidad,
				'activo' => $consulta->activo,'especialidades' => $this->modelo_inicio->obtener_especialidades());
		} 
		else
		{
			$data = array('idMaestro'=>'','Clave' => '','Nombre' => '',
				'Nivel' => '','Fecha_ingreso' => '','horas' => '',
				'Correo' => '','Profordem' => '','idEspecialidad' => '',
				'activo' => '','especialidades' => $this->modelo_inicio->obtener_especialidades());
		}	
		$this->load->view('registrar/vista_maestro',$data);

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
		$idPlan=$this->input->get('id', TRUE);
		$consulta=$this->modelo_consultas->consulta_plan($idPlan);
		
		if($consulta != FALSE)
		{
			$data = array('idPlan' => $consulta->idPlan,'Nombre_plan' => $consulta->Nombre_plan,'idCarrera' => $consulta->idCarrera,'carreras' => $this->modelo_inicio->obtener_carreras());
		} 
		else
		{
			$data = array('idPlan' => '','Nombre_plan' => '','idCarrera' => '','carreras' => $this->modelo_inicio->obtener_carreras());
		}	
		$this->load->view('registrar/vista_plan',$data);

	}
	public function carrera()
	{
		$idCarrera=$this->input->get('id', TRUE);
		$consulta=$this->modelo_consultas->consulta_carrera($idCarrera);
		
		if($consulta != FALSE)
		{
			$data = array('idCarrera' => $consulta->idCarrera,'Nombre_carrera' => $consulta->Nombre_carrera);
		} 
		else
		{
			$data = array('idCarrera' => '','Nombre_carrera' => '');
		}	
		$this->load->view('registrar/vista_carrera',$data);	
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
		$datos['carreras']=$this->modelo_inicio->obtener_carreras();
		$this->load->view('editar/vista_edita_carrera',$datos);
	}

}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */