<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
    <!--Para poder usar el calendario, importar las librerias-->
    <link href="<?php echo base_url()?>assets/calendar/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<!--<script type="text/javascript" src="<?php echo base_url()?>assets/calendar/bootstrap-datetimepicker.min.js"></script>-->
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
  			<?php
  				if($idMaestro!=null)
	  			{
	  				?>
	  				<form action="<?php echo site_url('controlador_actualizar/actualiza_maestro');?>?id=<?php echo $idMaestro ?>" method="post">
	  				<?php
				}
				else
				{
					?>
					<form action="<?php echo site_url('controlador_registrar/guarda_maestro');?>" method="post">
	  				<?php
	  			}		
	  		?>
	  		<label for="clave">Clave</label>
			<input type="text" class="form-control" id="clave_maestro" value="<?php echo $Clave ?>" placeholder="Clave del maestro" name="clave" required pattern="<?php echo PATRON_NUMEROS; ?>" oninput="check(this)">		    
		    	
	    	<label for="nombre">Nombre del maestro</label>
			<input type="text" class="form-control" id="nombre_maestro" value="<?php echo $Nombre ?>" placeholder="Nombre" name="nombre" required pattern="<?php echo PATRON_NOMBRE_PERSONA; ?>" oninput="check(this)">
		
			<label for="nivel">Nivel del maestro</label>
			<!--Código para verificar cual dato del combo esta seleccionado-->
			<?php
				$sel0 = "";
				$sel1 = "";
				$sel2 = "";
				$sel3 = "";
				if($Nivel == 'PB'){
				    $sel0 = "selected";
				}
				if($Nivel == 'PC'){
				    $sel1 = "selected";
				}
				if($Nivel == 'TA'){
					$sel2 = "selected";
				}
				if($Nivel == 'PA'){
					$sel3 = "selected";
				}
			?>
			<select class="form-control" name="nivel">
			  <option <?php echo $sel0;?> >PB</option>
			  <option <?php echo $sel1;?> >PC</option>
			  <option <?php echo $sel2;?> >TA</option>
			  <option <?php echo $sel3;?> >PA</option>
			</select>
		
			<label for="fecha">Fecha de ingreso</label>
			</br>
			<div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
			  <input class="form-control" size="16" type="text" value="<?php echo $Fecha_ingreso ?>" readonly name="fecha_ingreso">
			  <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
			  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			</div>

			<label for="horas">Horas</label>
			<input type="text" class="form-control" id="horas_maestro" value="<?php echo $horas ?>" placeholder="Horas asignadas" name="horas" pattern="<?php echo PATRON_NUMEROS; ?>" oninput="check(this)">		    
		
		    <label for="email">Email</label>
		    <input type="email" class="form-control" id="email" value="<?php echo $Correo ?>" placeholder="Introduce tu email" name="email" pattern="<?php echo PATRON_CORREO; ?>">
			<!--Verifica que este seleccionado el checkbox, si es así establece la variable para seleccionarlo-->
			<?php
				$selecciona_profordem = "";
				if($Profordem == 1){
				    $selecciona_profordem = "checked";
				}
			?>	
			<label><input type="checkbox" value="1" name="profordem" <?php echo $selecciona_profordem;?> > Cuenta con PROFORDEMS</label>
			</br>
			<label for="especialidad">Especialidad</label>
			<select class="form-control" name="id_especialidad">
				<option value="NULL" selected>Ninguna</option>;
				<?php
				foreach ($especialidades as $i => $especialidad)
					if($idEspecialidad==$especialidad->idEspecialidad)
					{
						echo '<option value="'.$especialidad->idEspecialidad.'" selected>'.$especialidad->Nombre.'</option>';
					}
					else{
						echo '<option value="'.$especialidad->idEspecialidad.'">'.$especialidad->Nombre.'</option>';
					}	
				?>
			</select>

			<!--Verifica que este seleccionado el checkbox, si es así establece la variable para seleccionarlo-->
			<?php
				$selecciona_activo = "";
				if($activo == 1){
				    $selecciona_activo = "checked";
				}
			?>			
			<label><input type="checkbox" value="1" name="activo" <?php echo $selecciona_activo;?> > Activo</label>
			</br>
			</br>
			<button type="submit" class="btn btn-default btn-lg" title="Guardar"><span class='glyphicon glyphicon-floppy-save'></span></button>
			<button type="button" class="btn btn-default btn-lg" title="Cancelar" onclick="window.location.href='<?php echo site_url('controlador_inicio/index');?>'"><span class='glyphicon glyphicon-floppy-remove'></span></button>
			</form>
		</div>
	</div>
	<script src="<?php echo base_url().BOOTSTRAP_JS?>"></script>  
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