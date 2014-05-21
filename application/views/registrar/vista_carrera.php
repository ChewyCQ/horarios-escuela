<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra carrera</title>
	<?php $this->load->view('comunes/validaciones'); ?>
	<script type="text/javascript">
		$(function(){
			$('#form').validate({
				rules:{
					nombre_carrera: {
						required: true,
						maxlength: 70,
						nombre_guion:true
					}
				},
				messages:{
					nombre_carrera: {
						required: "<font color='red'>Campo obligatorio</font>",
						maxlength: "<font color='red'>El nombre de la carrera debe tener un máximo de 70 caracteres</font>",
						nombre_guion: "<font color='red'>Solo se aceptan letras, un guion medio (No guion medio al final)</font>"
					}
				},

			});
		});
	</script>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
  		<div class="form-group">
  			<?php
  				if($idCarrera!=null)
	  			{
	  				?>
	  				<form id="form" action="<?php echo site_url('controlador_actualizar/actualiza_carrera');?>?id=<?php echo $idCarrera?>" method="post">
	  				<?php
				}
				else
				{
					?>
					<form id="form" action="<?php echo site_url('controlador_registrar/guarda_carrera');?>" method="post">
	  				<?php
	  			}		
	  		?>
		  		<label for="nombre">Nombre de la carrera</label>
				<input type="text" class="form-control required" id="nombre_carrera" value="<?php echo $Nombre_carrera ?>" placeholder="Nombre de la carrera" name="nombre_carrera">
				<br/>
				<button type="submit" class="btn btn-default">Guardar</button>
			</form>
		</div>
	</div>
	<script src="<?php echo base_url().BOOTSTRAP_JS?>"></script>    
</body>
</html>