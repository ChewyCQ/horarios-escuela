<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra dependencia</title>
	<?php $this->load->view('comunes/validaciones'); ?>
	<script type="text/javascript">
		$(function(){
			$('#form').validate({
				rules:{
					nombre: {
						required: true,
						maxlength: 70,
						solo_letras:true
					},
					cantidad: {
						required: true,
						digits: true
					}
				},
				messages:{
					nombre: {
						required: "<font color='red'>Campo obligatorio</font>",
						maxlength: "<font color='red'>El nombre de la dependencia debe tener un máximo de 70 caracteres</font>",
						solo_letras: "<font color='red'>Solo se aceptan letras</font>"
					},
					cantidad: {
						required: "<font color='red'>Campo obligatorio</font>",
						digits: "<font color='red'>Solo se aceptan números</font>"
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
  				if($idDependencia!=null)
	  			{
	  				?>
	  				<form id="form" action="<?php echo site_url('controlador_actualizar/actualiza_dependencia');?>?id=<?php echo $idDependencia?>" method="post">
	  				<?php
				}
				else
				{
					?>
					<form id="form" action="<?php echo site_url('controlador_registrar/guarda_dependencia');?>" method="post">
	  				<?php
	  			}		
	  		?>
  			
	  			<label for="nombre">Nombre de la dependencia</label>
				<input type="text" class="form-control required" id="nombre" placeholder="Nombre" value="<?php echo $Nombre ?>" name="nombre">
				</br>
				<label for="numero">Cantidad máxima de alumnos que acepta</label>
				<input type="text" class="form-control required" id="cantidad" value="<?php echo $CantidadMaxAlumnos?>" placeholder="Cantidad de alumnos Campo Clínico" name="cantidad">
				<br/>
				<button type="submit" class="btn btn-default">Guardar</button>
			</form>
		</div>
	</div>
	<script src="<?php echo base_url().BOOTSTRAP_JS?>"></script>     
</body>
</html>