<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
     <!--Para usar el autocompletar-->
    <?php $this->load->view('comunes/autocompletar'); ?>
    <!--Para usar las validaciones-->
    <?php $this->load->view('comunes/validaciones'); ?>
<head>
	<title>Carrera</title>
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
	<!--Autocompletado-->
	<script type="text/javascript">
		$(function(){
		  $("#nombre_carrera").autocomplete({
		    source: "<?php echo site_url('controlador_buscar/get_alumnos');?>"
		  });
		});
	</script>	
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<?php
			if($idCarrera!=null)
			{
				?><legend>Editar carrera</legend><?php
			}
			else
			{
				?><legend>Nueva carrera</legend><?php
			}
		?>		
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
				<div align="right">
					<button type="submit" class="btn btn-primary btn-lg" title="Guardar"><span class='glyphicon glyphicon-floppy-save'></span></button>
					<?php
						if($idCarrera==null)
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