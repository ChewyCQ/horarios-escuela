<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlador_buscar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database('default');
		$this->load->model('modelo_buscar');
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
	//Obtiene a los maestros segun los caracteres ingresados
	public function get_maestros()
	{
	    if (isset($_GET['term']))
	    {
	      $q = mb_strtoupper($_GET['term'],'UTF-8'); //Convierte a mayúsculas y usa codificación utf-8 el texto que se buscara
	      $this->modelo_buscar->get_maestros($q);
	    }
	}
	//Obtiene las especialidades segun los caracteres ingresados
	public function get_especialidades()
	{
	    if (isset($_GET['term']))
	    {
	      $q = mb_strtoupper($_GET['term'],'UTF-8');
	      $this->modelo_buscar->get_especialidades($q);
	    }
	}
	//Obtiene las materias segun los caracteres ingresados
	public function get_materias()
	{
	    if (isset($_GET['term']))
	    {
	      $q = mb_strtoupper($_GET['term'],'UTF-8');
	      $this->modelo_buscar->get_materias($q);
	    }
	}
	//Obtiene los planes segun los caracteres ingresados
	public function get_planes()
	{
	    if (isset($_GET['term']))
	    {
	      $q = mb_strtoupper($_GET['term'],'UTF-8');
	      $this->modelo_buscar->get_planes($q);
	    }
	}
	//Obtiene las carreras segun los caracteres ingresados
	public function get_carreras()
	{
	    if (isset($_GET['term']))
	    {
	      $q = mb_strtoupper($_GET['term'],'UTF-8');
	      $this->modelo_buscar->get_carreras($q);
	    }
	}
	//Obtiene los grupos segun los caracteres ingresados
	public function get_grupos()
	{
	    if (isset($_GET['term']))
	    {
	      $q = mb_strtoupper($_GET['term'],'UTF-8');
	      $this->modelo_buscar->get_grupos($q);
	    }
	}
	//Obtiene los alumnos segun los caracteres ingresados
	public function get_alumnos()
	{
	    if (isset($_GET['term']))
	    {
	      $q = mb_strtoupper($_GET['term'],'UTF-8');
	      $this->modelo_buscar->get_alumnos($q);
	    }
	}
	//Obtiene las dependencias segun los caracteres ingresados
	public function get_dependencias()
	{
	    if (isset($_GET['term']))
	    {
	      $q = mb_strtoupper($_GET['term'],'UTF-8');
	      $this->modelo_buscar->get_dependencias($q);
	    }
	}
}