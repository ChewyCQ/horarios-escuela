<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
    <!--Para poder usar el calendario, importar las librerias-->
    <link href="<?php echo base_url()?>assets/calendar/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url()?>assets/calendar/jquery-1.8.3.min.js" charset="UTF-8"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/calendar/bootstrap-datetimepicker.js" charset="UTF-8"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/calendar/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>

	<!--Para usar las validaciones-->
	<?php $this->load->view('comunes/validaciones'); ?>

	<!--Para el campo autocompletar-->
	<link href="<?php echo base_url()?>assets/autocompletar/css/jquery-ui-1.10.4.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url()?>assets/autocompletar/js/jquery-ui-1.10.4.js"></script>
<head>
	<title>Maestro</title>

	<!--Validaciones-->
	<script type="text/javascript">
		$(function(){
			$('#form').validate({
				rules:{
					clave: {
						required: true,
						minlength: 10,
						maxlength: 10,
						digits:true
					},
					nombre: {
						required: true,
						maxlength: 150,
						nombre_persona: true
					},
					horas: {
						digits: true
					},
					email: {
						email: true
					}
				},
				messages:{
					clave: {
						required: "<font color='red'>Campo obligatorio</font>",
						minlength: "<font color='red'>La clave debe de tener 10 digitos, sin espacios</font>",
						maxlength: "<font color='red'>La clave debe de tener 10 digitos, sin espacios</font>",
						digits: "<font color='red'>La clave debe tener solo números</font><label></label>"
					},
					nombre: {
						required: "<font color='red'>Campo obligatorio</font>",
						maxlength: "<font color='red'>El nombre del maestro debe tener máximo 150 caracteres</font>",
						nombre_persona: "<font color='red'>El nombre debe tener solo letras y máximo un punto (No punto al final)</font>"
					},
					horas: {
						digits: "<font color='red'>Sólo se aceptan números, sin espacios</font><label></label>"
					},
					email: {
						email: "<font color='red'>Sólo se aceptan correos electrónicos, sin espacios</font><label></label>"
					}
				}

			});
		});
	</script>
	<!--Autocompletado-->
	<script type="text/javascript">
		$(function(){
		  $("#nombre_maestro").autocomplete({
		    source: "<?php echo site_url('controlador_buscar/get_maestros');?>"
		  });
		});
	</script>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<?php
			if($idMaestro!=null)
			{
				?><legend>Editar maestro</legend><?php
			}
			else
			{
				?><legend>Nuevo maestro</legend><?php
			}
		?>		
  		<div class="form-group">	
  			<?php
  				if($idMaestro!=null)
	  			{
	  				?>
	  				<form id="form" action="<?php echo site_url('controlador_actualizar/actualiza_maestro');?>?id=<?php echo $idMaestro ?>" method="post">
	  				<?php
				}
				else
				{
					?>
					<form id="form" action="<?php echo site_url('controlador_registrar/guarda_maestro');?>" method="post">
	  				<?php
	  			}		
	  		?>
	  		<label for="clave">Clave</label>
			<input type="text" class="form-control required" id="clave_maestro" value="<?php echo $Clave ?>" placeholder="Clave del maestro" name="clave">		    
		    	
	    	</br>
	    	<label for="nombre">Nombre del maestro</label>
			<input type="text" class="form-control required" id="nombre_maestro" value="<?php echo $Nombre ?>" placeholder="Nombre" name="nombre">
			
			</br>
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
		
			</br>
			<label for="fecha">Fecha de ingreso</label>
			<div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
			  <input class="form-control" size="16" type="text" value="<?php echo $Fecha_ingreso ?>" readonly name="fecha_ingreso">
			  <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
			  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			</div>

			</br>
			<label for="horas">Horas</label>
			<input type="text" class="form-control" id="horas_maestro" value="<?php echo $horas ?>" placeholder="Horas asignadas" name="horas">		    
			
			</br>
		    <label for="email">Email</label>
		    <input type="text" class="form-control" id="email" value="<?php echo $Correo ?>" placeholder="Introduce tu email" name="email">
			
			<!--Código para verificar cual dato del combo esta seleccionado-->
			<?php
				$sel0 = "";
				$sel1 = "";
				$sel2 = "";
				$sel3 = "";
				if($Certificacion == 0){
				    $sel0 = "selected";
				}
				if($Certificacion == 1){
				    $sel1 = "selected";
				}
				if($Certificacion == 2){
					$sel2 = "selected";
				}
			?>
			</br>
			<label for="certificacion">Certificación</label>
			<select class="form-control" name="certificacion">
			  <option value="0" <?php echo $sel0;?> >No tiene</option>
			  <option value="1" <?php echo $sel1;?> >Profordem</option>
			  <option value="2" <?php echo $sel2;?> >Certidem</option>
			</select>
			</br>

			<label for="especialidad">Especialidad</label>
			<select class="form-control" name="id_especialidad">
				<option value="NULL" selected>Ninguna</option>;
				<?php
				foreach ($especialidades as $i => $especialidad)
					if($idEspecialidad==$especialidad->idEspecialidad)
					{
						echo '<option value="'.$especialidad->idEspecialidad.'" selected>'.$especialidad->Nombre_especialidad.'</option>';
					}
					else{
						echo '<option value="'.$especialidad->idEspecialidad.'">'.$especialidad->Nombre_especialidad.'</option>';
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
			</br>		
			<label><input type="checkbox" value="1" name="activo" <?php echo $selecciona_activo;?> > Activo</label>
			</br>
			</br>
				<div align="right">
					<button type="submit" class="btn btn-primary btn-lg" title="Guardar"><span class='glyphicon glyphicon-floppy-save'></span></button>
					<?php
						if($idMaestro==null)
						{
							?><button type="reset" class="btn btn-success btn-lg" title="Limpiar formulario"><span class='glyphicon glyphicon-refresh'></span></button><?php
						}
					?>					
					<button type="button" class="btn btn-danger btn-lg" title="Cancelar" onclick="window.location.href='<?php echo site_url('controlador_inicio/index');?>'"><span class='glyphicon glyphicon-floppy-remove'></span></button>
				</div>
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