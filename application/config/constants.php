<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

// Definidos
define('PATRON_TEXTO_GUIONES', "^([áéíóúÁÉÍÓÚñÑa-zA-Z\s]+)(\-?)([áéíóúÁÉÍÓÚñÑa-zA-Z\s]+)$"); //Esta validación acepta texto con guiones
define('PATRON_TEXTO_GUIONES_NUMEROS', "^([áéíóúÁÉÍÓÚñÑa-zA-Z\s]+)(\d*)([áéíóúÁÉÍÓÚñÑa-zA-Z0-9\s]+)$"); //Esta validación acepta texto con guiones y números
define('PATRON_NOMBRE_PERSONA', "^([áéíóúÁÉÍÓÚñÑa-zA-Z\s]+)(\.?)([áéíóúÁÉÍÓÚñÑa-zA-Z\s]+)$");

define('PATRON_TEXTO_CASI_LIBRE', "^[áéíóúÁÉÍÓÚñÑAA-Z0-9a-z _ . /s - - # ]{2,70}$"); //_
define('TITLE_TEXTO_CASI_LIBRE', "Acepta letras, numeros, espacios, guiones y # y puntos, de 2 hasta 70 caracteres");

define('PATRON_NUMEROS', "^\d*$");
define('PATRON_CORREO', "^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$");
define('BOOTSTRAP_CSS', "assets/bootstrap/css/bootstrap.css");
define('BOOTSTRAP_JS', "assets/bootstrap/js/bootstrap.js");
define('FPDF', "assets/fpdf/fpdf.php");
define('CSS', "assets/css.css");
define('JQUERY', "assets/jquery.js");
define('JQUERY_BOOTSTRAP', "assets/bootstrap/js/jquery.min.js");
define('SCRIPTS', "assets/scripts.js");

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */