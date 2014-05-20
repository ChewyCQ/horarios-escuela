// Fecha con bootstrap
// $('.form_datetime').datetimepicker({
//       language:  'es',
//       weekStart: 1,
//       todayBtn:  1,
//       autoclose: 1,
//       todayHighlight: 1,
//       startView: 2,
//       forceParse: 0,
//       showMeridian: 1
//     });
//   $('.form_date').datetimepicker({
//       language:  'es',
//       weekStart: 1,
//       todayBtn:  1,
//       autoclose: 1,
//       todayHighlight: 1,
//       startView: 2,
//       minView: 2,
//       forceParse: 0
//     });
//   $('.form_time').datetimepicker({
//       language:  'es',
//       weekStart: 1,
//       todayBtn:  1,
//       autoclose: 1,
//       todayHighlight: 1,
//       startView: 1,
//       minView: 0,
//       maxView: 1,
//       forceParse: 0
//     });

// 
function agrega_fila()
{
	var opcion_seleccionada = $('#especialidad option:selected').text();
	var id = $('#especialidad').val();
	var i=('td').length;
	var cad="<tr><td><input name='especialidades[]' value='"+id+"' type='hidden'>"+opcion_seleccionada+"</td><td width='40px'><button type='button' onclick='elimina_fila(this);' class='btn btn-primary btn-sm' title='Eliminar'><span class='glyphicon glyphicon-remove'></span></button></td></tr>";
	$('#tabla').append(cad);
}
// Evento que selecciona la fila y la elimina 
function elimina_fila(boton)
{
	$(boton).parent().parent().remove();
}