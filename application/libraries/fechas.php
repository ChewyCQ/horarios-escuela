<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
* 
*/
class Fechas
{
	
    public function fecha_dd_mm_aaaa($string_fecha)
    {
        $fecha_separada = explode("/", $string_fecha);
        $dia = $fecha_separada[0];
        $mes = $fecha_separada[1];
        $anio = $fecha_separada[2];
        $fecha_date = $anio.'-'.$mes.'-'.$dia;
        return $fecha_date;
    }
	public function fecha_dd_mes_aaaa($string_fecha)
    {
        //Colocar nuevo formato a la fecha para guardar en la base como date
        $fecha_separada = explode(" ", $string_fecha);
        $dia = $fecha_separada[0];
        $mes = $this->mes_numero(strtolower($fecha_separada[1])); //Utilizo el método mes de la librería de fecha para convertirlo a número
        $anio = $fecha_separada[2];
        $fecha_date = $anio.'-'.$mes.'-'.$dia;
        return $fecha_date;
    }
    //Para cambiar los meses a números
    function mes_numero($mes){
        switch ($mes) {
            case 'enero':
                return '01';
                break;
            case 'febrero':
                return '02';
                break;
            case 'marzo':
                return '03';
                break;
            case 'abril':
                return '04';
                break;
            case 'mayo':
                return '05';
                break;
            case 'junio':
                return '06';
                break;
            case 'julio':
                return '07';
                break;
            case 'agosto':
                return '08';
                break;
            case 'septiembre':
                return '09';
                break;
            case 'octubre':
                return '10';
                break;
            case 'noviembre':
                return '11';
                break;
            case 'diciembre':
                return '12';
                break;
            }
    }

    //Para cambiar los meses a letras
    function mes_letra($mes){
        switch ($mes) {
            case '01':
                $mesletra='Enero';
                break;
            case '02':
                $mesletra='Febrero';
                break;
            case '03':
                $mesletra='Marzo';
                break;
            case '04':
                $mesletra='Abril';
                break;
            case '05':
                $mesletra='Mayo';
                break;
            case '06':
                $mesletra='Junio';
                break;
            case '07':
                $mesletra='Julio';
                break;
            case '08':
                $mesletra='Agosto';
                break;
            case '09':
                $mesletra='Septimbre';
                break;
            case '10':
                $mesletra='Octubre';
                break;
            case '11':
                $mesletra='Noviembre';
                break;
            case '12':
                $mesletra='Diciembre';
                break;
            }
        return $mesletra;
    }
}