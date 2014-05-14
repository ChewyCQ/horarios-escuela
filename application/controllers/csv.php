<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csv extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','file','url'));
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
                $data['maestros'] = $this->asegurar_arreglo_maestros($data['maestros']);
                $data['maestros'] = $this->texto_a_utf8($data['maestros']);
                    // echo "<pre>";
                    // var_dump($data);
                    // echo "</pre>";
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
    function asegurar_arreglo_maestros($maestros)
    {
        foreach ($maestros as $key => $value) {
            if( ! isset($maestros[$key]['clave']))
            {
                $maestros[$key]['clave'] = '';
            }
            if( ! isset($maestros[$key]['nombre']))
            {
                $maestros[$key]['nombre'] = '';
            }
            if( ! isset($maestros[$key]['nivel']))
            {
                $maestros[$key]['nivel'] = '';
            }
            if( ! isset($maestros[$key]['fecha de ingreso']))
            {
                $maestros[$key]['fecha de ingreso'] = '';
            }
            if( ! isset($maestros[$key]['correo']))
            {
                $maestros[$key]['correo'] = '';
            }
            if( ! isset($maestros[$key]['profordem']))
            {
                $maestros[$key]['profordem'] = '';
            }
        }
        return $maestros;
    }
    public function guardar_maestros()
    {
        $maestros = $this->leer_csv('./subidos/maestros.csv');
        $maestros = $this->asegurar_arreglo_maestros($maestros);
        $maestros = $this->texto_a_utf8($maestros);
        delete_files("./subidos/");
        $this->load->model('csv_modelo');
        $this->csv_modelo->insertar_maestros($maestros);
        redirect('/controlador_inicio/index'); //redirigir a las vista de los maestros subidos
    }

}

/* End of file csv.php */
/* Location: ./application/controllers/csv.php */