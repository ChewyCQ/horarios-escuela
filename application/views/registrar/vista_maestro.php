<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
    <!--Para poder usar el calendario, importar las librerias-->
    <link href="<?php echo base_url()?>assets/calendar/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url()?>assets/calendar/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/calendar/jquery-1.8.3.min.js" charset="UTF-8"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/calendar/bootstrap-datetimepicker.js" charset="UTF-8"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/calendar/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<head>
	<title>Registra maestro</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
  		<div class="form-group">	
  			<form action="<?php echo site_url('registrar_controlador/guarda_maestro');?>" method="post">		    
		    	<label for="nombre">Nombre del maestro</label>
				<input type="text" class="form-control" id="nombre_maestro" placeholder="Nombre" name="nombre" required pattern="<?php echo PATRON_NOMBRE_PERSONA; ?>" oninput="check(this)">
			
				<label for="nivel">Nivel del maestro</label>
				<input type="text" class="form-control" id="nivel_maestro" placeholder="Nivel de estudios" name="nivel" required pattern="<?php echo PATRON_NOMBRE_PERSONA; ?>" oninput="check(this)"> 
			
				<label for="fecha">Fecha de ingreso</label>
				</br>
				<div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
				  <input class="form-control" size="16" type="text" value="" readonly name="fecha_ingreso">
				  <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
				  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
				</div>
			
			    <label for="email">Email</label>
			    <input type="email" class="form-control" id="email" placeholder="Introduce tu email" name="email" required pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$">
				<label><input type="checkbox" value="1" name="profordem"> Cuenta con PROFORDEMS</label>
				</br>
				<label for="especialidad">Especialidad</label>
				<select class="form-control" name="id_especialidad">
					<?php
					foreach ($especialidades as $i => $especialidad)
					   echo '<option value="'.$especialidad->idEspecialidad.'">'.$especialidad->Nombre.'</option>';
					?>
				</select>
				<br/>
				<button type="submit" class="btn btn-default">Enviar</button>
			</form>
		</div>
	</div>

	<?php $this->load->view('comunes/footer'); ?>    
</body>
<!--Para poder usar el calendario-->
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
      language:  'es',
      weekStart: 1,
      todayBtn:  1,
      autoclose: 1,
      todayHighlight: 1,
      startView: 2,
      forceParse: 0,
      showMeridian: 1
    });
  $('.form_date').datetimepicker({
      language:  'es',
      weekStart: 1,
      todayBtn:  1,
      autoclose: 1,
      todayHighlight: 1,
      startView: 2,
      minView: 2,
      forceParse: 0
    });
  $('.form_time').datetimepicker({
      language:  'es',
      weekStart: 1,
      todayBtn:  1,
      autoclose: 1,
      todayHighlight: 1,
      startView: 1,
      minView: 0,
      maxView: 1,
      forceParse: 0
    });
</script>
</html>