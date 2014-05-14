<?php

//Para cambiar los meses a números
function mes_numero($mes){
	$mesnumero='';
	switch ($mes) {
		case 'enero':
			$mesnumero='01';
			break;
		case 'febrero':
			$mesnumero='02';
			break;
		case 'marzo':
			$mesnumero='03';
			break;
		case 'abril':
			$mesnumero='04';
			break;
		case 'mayo':
			$mesnumero='05';
			break;
		case 'junio':
			$mesnumero='06';
			break;
		case 'julio':
			$mesnumero='07';
			break;
		case 'agosto':
			$mesnumero='08';
			break;
		case 'septiembre':
			$mesnumero='09';
			break;
		case 'octubre':
			$mesnumero='10';
			break;
		case 'noviembre':
			$mesnumero='11';
			break;
		case 'diciembre':
			$mesnumero='12';
			break;
		}
	return $mesnumero;
}

//Para cambiar los meses a letras
function mes_letra($mes){
	$mesletra="";
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