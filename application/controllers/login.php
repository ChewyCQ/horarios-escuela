<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper( array('url','form') );
		$this->load->library( array('form_validation', 'session' ) );
	}

	public function index()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if (isset($is_logged_in) && $is_logged_in == TRUE) {
			redirect('controlador_inicio');
		} else {
			$this->load->view('inicio_sesion');
		}
	}
	function validar_login()
	{
		$this->load->model('modelo_login');
		$usuario = $this->modelo_login->validar();

		if ( !is_null($usuario) )
		{
			$data = array(
				'usuario' => $this->input->post('usuario'),
				'is_logged_in' => true
				 );
			$this->modelo_login->registrar_sesion($usuario['idLogin']);
			$this->session->set_userdata($data);
			redirect('controlador_inicio');
		}
		else
		{
			$this->index();
		}
	}
	function logout()
	{
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->session->unset_userdata($key);
			}
		}
		$this->session->sess_destroy();
		$this->index();
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */