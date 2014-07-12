<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Controlador_inicio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		// $this->load->library('session');
		$this->load->model('modelo_inicio');
		$this->load->model('modelo_consultas');
		$this->load->database('default');
		$this->verificar_sesion();
	}

	public function index()
	{
		$this->load->view('lobby');
	}
	public function verificar_sesion()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if (!isset($is_logged_in) || $is_logged_in != TRUE) {
			redirect('login');
			die();
		}
	}
	public function maestro()
	{
		$this->load->library('fechas');
		$idMaestro=$this->input->get('id', TRUE);
		$consulta=$this->modelo_consultas->consulta_maestro($idMaestro);		
		if($consulta != FALSE)
		{
			//Convertir fecha a texto			
			if($consulta->Fecha_ingreso=='0000-00-00')
			{
				$fecha_texto='';
			}
			else
			{
				$fecha_texto=$this->fechas->fecha_dd_mes_aaaa_edita($consulta->Fecha_ingreso);
			}
			$data = array('idMaestro'=>$consulta->idMaestro,'Clave' => $consulta->Clave,'Nombre' => $consulta->Nombre,
				'Nivel' => $consulta->Nivel,'Fecha_ingreso' => $fecha_texto,'horas' => $consulta->horas,
				'Correo' => $consulta->Correo,'Certificacion' => $consulta->Certificacion,'idEspecialidad' => $consulta->idEspecialidad,
				'activo' => $consulta->activo,'especialidades' => $this->modelo_inicio->obtener_especialidades());
		} 
		else
		{
			$data = array('idMaestro'=>'','Clave' => '','Nombre' => '',
				'Nivel' => '','Fecha_ingreso' => '','horas' => '',
				'Correo' => '','Certificacion' => '','idEspecialidad' => '',
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
			$data = array('Clave_materia' => $consulta->Clave_materia,'Nombre_materia' => $consulta->Nombre_materia,'Tipo_materia' => $consulta->Tipo_materia,
						  'idMateria'=>$consulta->idMateria,
						  'especialidades' => $this->modelo_consultas->obtener_especialidades_filtro($idMateria),
						  'materiaEspecialidad' => $this->modelo_consultas->materia_especialidad($idMateria));
		} 
		else
		{
			$data = array('Clave_materia' => '','Nombre_materia' => '','Tipo_materia' => '','idMateria'=>'',
						  'especialidades' => $this->modelo_inicio->obtener_especialidades(),'materia_especialidad'=>'');
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
		$idGrupo=$this->input->get('id', TRUE);
		$consulta=$this->modelo_consultas->consulta_grupo($idGrupo);
		
		if($consulta != FALSE)
		{
			$data = array('idGrupo' => $consulta->idGrupo,'Generacion' => $consulta->Generacion,'Clave'=>$consulta->Clave,'cantidad_alumnos'=>$consulta->cantidad_alumnos,'turno'=>$consulta->turno,'idPlan'=>$consulta->idPlan,'planes'=>$this->modelo_inicio->obtener_plan(),'var' => 0);
		} 
		else
		{
			$data = array('idGrupo' => '','Generacion' => '','Clave'=>'','idSemestre'=>'','turno'=>'','idCarrera'=>'','idPlan'=>'','cantidad_alumnos'=>'','idPlan' => '','planes'=>$this->modelo_inicio->obtener_plan(),'var' => 0);
		}		
		$this->load->view('registrar/vista_grupo',$data);
	}
	public function alumno()
	{
		$idAlumno=$this->input->get('id', TRUE);
		$consulta=$this->modelo_consultas->consulta_alumno($idAlumno);
		
		if($consulta != FALSE)
		{
			$data = array('idAlumno' => $consulta->idAlumno,'Nombre' => $consulta->Nombre,'Correo'=>$consulta->Correo,'idGrupo'=>$consulta->idGrupo,'grupos'=>$this->modelo_inicio->obtener_grupos());
		} 
		else
		{
			$data = array('idAlumno' => '','Nombre' => '','Correo'=>'','idGrupo'=>'','grupos'=>$this->modelo_inicio->obtener_grupos());
		}
		$this->load->view('registrar/vista_alumno',$data);
	}
	public function dependencia()
	{
		$idDependencia=$this->input->get('id', TRUE);
		$consulta=$this->modelo_consultas->consulta_dependencia($idDependencia);
		
		if($consulta != FALSE)
		{
			$data = array('idDependencia' => $consulta->idDependencia, 'Nombre' => $consulta->Nombre,
						  'CantidadMaxAlumnos' => $consulta->CantidadMaxAlumnos,
						  'maestros' => $this->modelo_consultas->obtener_maestros_filtro($idDependencia),
						  'maestro_campo' => $this->modelo_consultas->maestro_campo($idDependencia));
		} 
		else
		{
			$data = array('idDependencia' => '', 'Nombre' => '','CantidadMaxAlumnos' => '',
						  'maestros' => $this->modelo_inicio->obtener_maestros(),
						  'maestro_campo' =>'');
		}
		$this->load->view('registrar/vista_dependencia',$data);
	}
	public function especialidad()
	{
		$idEspecialidad=$this->input->get('id', TRUE);
		$consulta=$this->modelo_consultas->consulta_especialidad($idEspecialidad);
		
		if($consulta != FALSE)
		{
			$data = array('Nombre' => $consulta->Nombre_especialidad,'idEspecialidad'=>$consulta->idEspecialidad);
		} 
		else
		{
			$data = array('Nombre' => '','idEspecialidad'=>'');	
		}	
		$this->load->view('registrar/vista_especialidad',$data);
	}
	public function datos_escuela()
	{
		$this->load->helper('form');
		$this->load->model('modelo_registrar');
		$nombre_escuela = $this->modelo_registrar->get_nombre_escuela();
		$data = array(
			'error' => '',
			'nombre_escuela' => $nombre_escuela
			);
		$this->load->view('registrar/vista_escuela', $data);
	}
	public function ciclo()
	{
		// $this->load->helper('form');
		// $data = array('error' => '');
		$idPeriodo=$this->input->get('id', TRUE);
		$consulta=$this->modelo_consultas->consulta_ciclo($idPeriodo);		
		if($consulta != FALSE)
		{
			$data = array('Periodo' => $consulta->Periodo,'semestre'=>$consulta->semestre,'Anio'=>$consulta->Anio,'idPeriodo'=>$consulta->idPeriodo);
		} 
		else
		{
			$data = array('Periodo' => '','semestre'=>'','Anio'=>'','idPeriodo'=>'');
		}	
		$this->load->view('registrar/vista_periodo',$data);
	}
	// public function validar_ciclo()
	// {
	// 	$periodo['Anio'] = $this->input->post('anio');
	// 	$periodo['semestre'] = $this->input->post('semestre');
	// 	$periodo['Periodo'] = $this->input->post('clave');
	// 	$this->load->model('modelo_registrar');
	// 	$this->modelo_registrar->registrar_periodo($periodo);
	// 	redirect('controlador_inicio');
	// }
	/**
	 * Datos de la escuela (horarios)
	 * @return [type] [description]
	 */
	// public function datos()
	// {
	// 	$idMateria=$this->input->get('id', TRUE);
	// 	$consulta=$this->modelo_consultas->consulta_materia($idMateria);
		
	// 	if($consulta != FALSE)
	// 	{
	// 		$data = array('Nombre_materia' => $consulta->Nombre_materia,'Tipo_materia' => $consulta->Tipo_materia,'idMateria'=>$consulta->idMateria,'especialidades' => $this->modelo_inicio->obtener_especialidades());
	// 	} 
	// 	else
	// 	{
	// 		$data = array('Nombre_materia' => '','Tipo_materia' => '','idMateria'=>'','especialidades' => $this->modelo_inicio->obtener_especialidades());
	// 	}	
	// 	$this->load->view('registrar/vista_materia',$data);
	// }

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
	public function edita_grupo()
	{
		$datos['grupos']=$this->modelo_inicio->obtener_grupos();
		$this->load->view('editar/vista_edita_grupo',$datos);
	}
	public function edita_alumno()
	{
		$datos['alumnos']=$this->modelo_consultas->consulta_alumno_grupo();
		$this->load->view('editar/vista_edita_alumno',$datos);
	}
	public function edita_dependencia()
	{
		$datos['dependencias']=$this->modelo_inicio->obtener_dependencias();
		$this->load->view('editar/vista_edita_dependencia',$datos);
	}
	public function edita_ciclo()
	{
		$datos['ciclos']=$this->modelo_inicio->obtener_ciclos();
		$this->load->view('editar/vista_edita_ciclo',$datos);
	}
	public function edita_materia_semestre()
	{
		$datos = array('materias'=>$this->modelo_inicio->obtener_materias(),
					   'var' => '',
					   'id_materia' => '',
					   'horas_escuela' => '',
					   'horas_campo' => ''
					 );
		$this->load->view('editar/vista_edita_materia_semestre',$datos);
	}
	public function edita_maestro_materia()
	{
		$datos = array('maestros'=>$this->modelo_inicio->obtener_maestros(),
						  'id_maestro' => '',
						  'var' => ''
						  );
		$this->load->view('editar/vista_edita_maestro_materia',$datos);
	}
	public function consulta_carrera_plan($idCarrera)
	{
		echo json_encode($this->modelo_consultas->carrera_plan($idCarrera)); //Codifica el resultado de la consulta a formato de json
    }
    public function consulta_carrera_semestre($idPlan)
	{
		echo json_encode($this->modelo_consultas->carrera_semestre($idPlan)); //Codifica el resultado de la consulta a formato de json
    }
    public function consulta_materias_semestre($idMateria)
	{
		echo json_encode($this->modelo_consultas->materia_semestre($idMateria)); //Codifica el resultado de la consulta a formato de json
    }
    public function consulta_maestro_materia()
	{
		$idMaestro=$this->input->get('id_maestro', TRUE);
		echo json_encode($this->modelo_consultas->maestro_materia($idMaestro)); //Codifica el resultado de la consulta a formato de json
    }
    public function consulta_maestro_materia_resto()
	{
		$idMaestro=$this->input->get('id_maestro', TRUE);
		echo json_encode($this->modelo_consultas->materias_sin_asociar($idMaestro)); //Codifica el resultado de la consulta a formato de json
    }
    public function consulta_semestre_carrera_plan()
    {
    	$idMateria=$this->input->get('id_materia', TRUE);
    	echo json_encode($this->modelo_consultas->semestre_carrera_plan($idMateria)); //Codifica el resultado de la consulta a formato de json
    }
    public function consulta_materia_semestre()
    {
    	$idMateria=$this->input->get('id_materia', TRUE);
    	echo json_encode($this->modelo_consultas->semestres_sin_asociar($idMateria)); //Codifica el resultado de la consulta a formato de json
    }
    public function consulta_maestro_puede_materia()
    {
    	$idMaestro=$this->input->get('id_maestro', TRUE);
    	echo json_encode($this->modelo_consultas->maestro_puede_materia($idMaestro)); //Codifica el resultado de la consulta a formato de json
    }
}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */