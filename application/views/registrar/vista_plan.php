<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
    <!--Para usar el autocompletar-->
    <?php $this->load->view('comunes/autocompletar'); ?>
    <!--Para usar las validaciones-->
    <?php $this->load->view('comunes/validaciones'); ?>
<head>
	<title>Plan de estudio</title>
	<script type="text/javascript">
		$(function(){
			$('#form').validate({
				rules:{
					nombre_plan: {
						required: true,
						maxlength: 70,
						letras_numeros: true
					}
				},
				messages:{
					nombre_plan: {
						required: "<font color='red'>Campo obligato</font>",
						maxlength: "<font color='red'>Máximo 70 caracteres</font>",
						letras_numeros: "<font color='red'>Solo letras y números. (No números al inicio)</font>"
					}
				},

			});
		});
	</script>
	<!--Autocompletado-->
	<script type="text/javascript">
		$(function(){
		  $("#nombre_plan").autocomplete({
		    source: "<?php echo site_url('controlador_buscar/get_planes');?>"
		  });
		});
	</script>	
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<?php
			if($idPlan!=null)
			{
				?><legend>Editar plan</legend><?php
			}
			else
			{
				?><legend>Nuevo plan</legend><?php
			}
		?>			
  		<div class="form-group">
  			<?php
  				if($idPlan!=null)
	  			{
	  				?>
	  				<form id="form" action="<?php echo site_url('controlador_actualizar/actualiza_plan');?>?id=<?php echo $idPlan?>" method="post">
	  				<?php
				}
				else
				{
					?>
					<form id="form" action="<?php echo site_url('controlador_registrar/guarda_plan');?>" method="post">
	  				<?php
	  			}		
	  		?>
  				<label for="nombre">Nombre del plan</label>
				<input type="text" class="form-control required" id="nombre_plan" name="nombre_plan" value="<?php echo $Nombre_plan ?>" placeholder="Nombre del plan" name="nombre_plan">
				</br>
				<label for="tipo_materia">Carrera</label>
				<select class="form-control" name="id_carrera">
					<?php
					foreach ($carreras as $i => $carrera)
						if($idCarrera==$carrera->idCarrera)
						{
							echo '<option value="'.$carrera->idCarrera.'" selected>'.$carrera->Nombre_carrera.'</option>';
						}
						else{
							echo '<option value="'.$carrera->idCarrera.'">'.$carrera->Nombre_carrera.'</option>';
						}					   
					?>
				</select>
				<br/>
				<div align="right">
					<button type="submit" class="btn btn-primary btn-lg" title="Guardar"><span class='glyphicon glyphicon-floppy-save'></span></button>
					<?php
						if($idPlan==null)
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