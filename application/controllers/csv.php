<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csv extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','file','url'));
        // $this->load->library('session');
        $this->verificar_sesion();
    }

    public function index()
    {
        redirect('controlador_inicio');
    }

    public function verificar_sesion()
    {
        $this->load->library('session');
        $is_logged_in = $this->session->userdata('is_logged_in');

        if (!isset($is_logged_in) || $is_logged_in != TRUE) {
            redirect('login');
            die();
        }
    }
    public function subir_csv_maestros()
    {
        if(file_exists('./subidos/maestros.csv'))
        {
            unlink('./subidos/maestros.csv');
        }
        $data = array(
            'title' => "Subir CSV de los Maestros",
            'error' => ""
            );
        $this->load->view('registrar/vista_csv_maestros', $data);
    }
    public function subir_csv_alumnos()
    {
        if(file_exists('./subidos/alumnos.csv'))
        {
            unlink('./subidos/alumnos.csv');
        }
        $data = array(
            'title' => "Subir CSV de los Alumnos",
            'error' => ""
            );
        $this->load->view('registrar/vista_csv_alumnos', $data);
    }
    function validar_csv_maestros()
    {
        $this->load->helper(array('form', 'url','file'));

        $config['upload_path'] = './subidos/';
        $config['allowed_types'] = 'csv';
        $config['file_name']    = 'maestros';
        $config['max_size']     = '0'; //sin limite de tamano

        $this->load->library('upload', $config);
        if(file_exists('./subidos/maestros.csv'))
        {
            unlink('./subidos/maestros.csv');
        }

        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            $data = array(
                'title' => "Subir CSV de los Maestros",
                'error' => $error
                );
            $this->load->view('registrar/vista_csv_maestros', $error);
        }
        else //Si se subio correctamente
        {
            // $data = array('upload_data' => $this->upload->data());
            $data['title'] = 'Datos extraidos del CSV'; 
            $data['maestros'] = $this->leer_csv('./subidos/maestros.csv');
            $data['maestros'] = $this->asegurar_arreglo_maestros($data['maestros'],FALSE);
            $data['maestros'] = $this->texto_a_utf8($data['maestros']);
            $this->load->view('registrar/vista_csv_maestros_subidos', $data);
        }
    }
    /**
     * Retorna un arreglo con los datos extraidos de un csv.
     * @param  String $value Direccion al archivo csv
     * @return Array        Arreglo con los datos del csv, las columnas son las referencias del arreglo.
     */
    function leer_csv($value)
    {
        $this->load->helper('file');
        $this->load->library('csvimport');
        return $this->csvimport->get_array($value);
    }
    /**
     * Recibe un arreglo compuesto de arreglos y codifica los strings del arreglo interno a utf-8
     * @param  Array $variable Arreglo con otros arreglos dentro con los datos a ser cambiados.
     * @return Array           El mismo arreglo recibido pero con los strings en codificacion utf-8
     */
    function texto_a_utf8($variable)
    {
        foreach ($variable as $key => $value) {
            if (isset($variable[$key]) && is_array($variable[$key])) {
                foreach ($variable[$key] as $atributo => $value) {
                    if (is_string($variable[$key][$atributo])) {
                        $variable[$key][$atributo] = utf8_encode($variable[$key][$atributo]);
                    } 
                }
            }
        }
        return $variable;
    }
    function asegurar_arreglo_maestros($maestros,$base)
    {
        $this->load->library('fechas');
        $nuevo = array();
        foreach ($maestros as $key => $value) {
            $temp = array();
            if( ! isset($maestros[$key]['clave']))
            {
                $temp['clave'] = '';
            }
            else{
                $temp['clave'] = $maestros[$key]['clave'];
            }
            if( ! isset($maestros[$key]['nombre']))
            {
                $temp['nombre'] = '';
            }
            else{
                $temp['nombre'] = strtoupper($maestros[$key]['nombre']);
            }
            if( ! isset($maestros[$key]['nivel']))
            {
                $temp['nivel'] = '';
            }
            else{
                $temp['nivel'] = strtoupper($maestros[$key]['nivel']);
            }
            if( ! isset($maestros[$key]['fecha de ingreso']))
            {
                $temp['fecha de ingreso'] = '';
            }
            else{
                if($base)
                {
                    $temp['fecha de ingreso'] = $this->fechas->fecha_dd_mm_aaaa($maestros[$key]['fecha de ingreso']);
                }
                else
                {
                    $temp['fecha de ingreso'] = $maestros[$key]['fecha de ingreso'];
                }
            }
            if( ! isset($maestros[$key]['correo']))
            {
                $temp['correo'] = '';
            }
            else{
                $temp['correo'] = strtolower($maestros[$key]['correo']);
            }
            if( ! isset($maestros[$key]['certificacion']))
            {
                $temp['certificacion'] = 'No';
            }
            else{
                if($base)
                {
                    // strcmp no sirve, ni idea de pq
                    if ( $maestros[$key]['certificacion'] == 'profordem' ) 
                    {
                        $temp['certificacion'] = 1;
                    }
                    else
                    {
                        if ( $maestros[$key]['certificacion'] == 'certidem')  {
                            $temp['certificacion'] = 2;
                        }
                        else
                        {
                            $temp['certificacion'] = 0;
                        }
                    }
                }
                else
                {
                    $temp['certificacion'] = $maestros[$key]['certificacion'];
                }
            }
            array_push($nuevo, $temp);
        }
        return $nuevo;
    }
    public function guardar_maestros()
    {
        $maestros = $this->leer_csv('./subidos/maestros.csv');
        $maestros = $this->asegurar_arreglo_maestros($maestros,TRUE);
        $maestros = $this->texto_a_utf8($maestros);
        delete_files("./subidos/");
        $this->load->model('csv_modelo');
        $this->csv_modelo->insertar_maestros($maestros);
        redirect('/controlador_inicio/index'); //redirigir a las vista de los maestros subidos
    }

}

/* End of file csv.php */
/* Location: ./application/controllers/csv.php */