<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
     <!--Para usar el autocompletar-->
    <?php $this->load->view('comunes/autocompletar'); ?>
    <!--Para usar las validaciones-->
    <?php $this->load->view('comunes/validaciones'); ?>
<head>
	<title>Grupo</title>	
	<!--Validaciones-->
	<script type="text/javascript">
		$(function(){
			$('#form').validate({
				rules:{
					generacion: {
						required: true,
						minlength: 4,
						maxlength: 4,
						digits:true
					},
					clave: {
						required: true,
						maxlength: 20,
						digits: true
					},
					cantidad_alumnos: {
						required: true,
						digits: true
					},
					id_plan: {
						min: 1
					}				
				},
				messages:{
					generacion: {
						required: "<font color='red'>Campo obligatorio</font>",
						minlength: "<font color='red'>El número de la generación debe tener cuatro dígitos, sin espacios</font>",
						maxlength: "<font color='red'>El número de la generación debe tener cuatro dígitos, sin espacios</font>",
						digits: "<font color='red'>Solo se aceptan números, sin espacios</font>"
					},
					clave: {
						required: "<font color='red'>Campo obligatorio</font>",						
						maxlength: "<font color='red'>La clave debe tener máximo 20 dígitos, sin espacios</font>",
						digits: "<font color='red'>Solo se aceptan números, sin espacios</font>"
					},
					cantidad_alumnos: {
						required: "<font color='red'>Campo obligatorio</font>",						
						digits: "<font color='red'>Solo se aceptan números, sin espacios</font>"
					},
					id_plan: {
						min: "<font color='red'>Seleccione un plan</font>"
					}
				},

			});
		});
	</script>
	<!--Autocompletado-->
	<script type="text/javascript">
		$(function(){
		  $("#clave").autocomplete({
		    source: "<?php echo site_url('controlador_buscar/get_grupos');?>"
		  });
		});
	</script>	
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<?php
			if($var==1)
			{
				?>
					<div class="alert alert-danger alert-dismissable">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>¡Error!</strong> Ya existe un grupo con la misma clave proporcionada.
					</div>
				<?php
			}

			if($idGrupo!=null)
			{
				?><legend>Editar grupo</legend><?php
			}
			else
			{
				?><legend>Nuevo grupo</legend><?php
			}
		?>		
  		<div class="form-group">
  			<?php
  				if($idGrupo!=null)
	  			{
	  				?>
	  				<form id="form" action="<?php echo site_url('controlador_actualizar/actualiza_grupo');?>?id=<?php echo $idGrupo?>" method="post">
	  				<?php
				}
				else
				{
					?>
					<form id="form" action="<?php echo site_url('controlador_registrar/guarda_grupo');?>" method="post">
	  				<?php
	  			}		
	  		?>  			
		    	<label for="generacion">Generación</label>
				<input type="text" class="form-control" id="generacion" value="<?php echo $Generacion ?>" placeholder="N° de la generación" name="generacion">
				</br>
				<label for="generacion">Clave</label>
				<input type="text" class="form-control required" id="clave" value="<?php echo $Clave ?>" placeholder="Clave del grupo" name="clave">
				</br>
				<label for="cant_alumnos">Cantidad de alumnos</label>
				<input type="text" class="form-control required" id="catidad_alumnos" value="<?php echo $cantidad_alumnos ?>" placeholder="Cantidad de alumnos en el grupo" name="cantidad_alumnos">
				</br>

				<label for="planes">Planes</label>
				<select class="form-control required" id="planes" name="id_plan">
					<option value="0" selected="selected">SELECCIONE UN PLAN</option>
					<?php
					foreach ($planes as $i => $planes)
						if($idPlan==$planes->idPlan)
						{
							echo '<option value="'.$planes->idPlan.'" selected>'.$planes->Nombre_plan.'</option>';
						}
						else
						{
							echo '<option value="'.$planes->idPlan.'">'.$planes->Nombre_plan.'</option>';
						}						
					?>
				</select>
				</br>
				<!--Obtiene el turno que esta por defecto en la BD-->
				<?php
					$sel1 = "";
					$sel2 = "";
					if($turno == 1){
					    $sel1 = "selected";
					}
					if($turno == 2){
					    $sel2 = "selected";
					}
				?>
				<label for="carrera">Turno</label>
				<select class="form-control" id="turno" name="turno">
					<option value="1" <?php echo $sel1;?> >Matutino</option>
					<option value="2" <?php echo $sel2;?> >Vespertino</option>
				</select>

				<br/>
				<div align="right">
					<button type="submit" class="btn btn-primary btn-lg" title="Guardar"><span class='glyphicon glyphicon-floppy-save'></span></button>
					<?php
						if($idGrupo==null)
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
</html>