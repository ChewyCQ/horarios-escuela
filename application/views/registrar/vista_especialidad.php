<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
    <!--Para usar el autocompletar-->
    <?php $this->load->view('comunes/autocompletar'); ?>
    <!--Para usar las validaciones-->
    <?php $this->load->view('comunes/validaciones'); ?>
<head>
	<title>Registra especialidad/área</title>	
	<script type="text/javascript">
		$(function(){
			$('#form').validate({
				rules:{
					nombre_especialidad: {
						required: true,
						maxlength: 70,
						solo_letras:true
					}
				},
				messages:{
					nombre_especialidad: {
						required: "<font color='red'>Campo obligatorio</font>",
						maxlength: "<font color='red'>El nombre de la especialidad debe tener un máximo de 70 caracteres</font>",
						solo_letras: "<font color='red'>Solo se aceptan letras</font>"
					}
				},

			});
		});
	</script>
	<!--Autocompletado-->
	<script type="text/javascript">
		$(function(){
		  $("#nombre_especialidad").autocomplete({
		    source: "<?php echo site_url('controlador_buscar/get_especialidades');?>"
		  });
		});
	</script>	
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<legend>Nueva área de formación/especialidad</legend>
  		<div class="form-group">
  			<?php
  				if($idEspecialidad!=null)
	  			{
	  				?>
	  				<form id="form" action="<?php echo site_url('controlador_actualizar/actualiza_especialidad');?>?id=<?php echo $idEspecialidad ?>" method="post">
	  				<?php
				}
				else
				{
					?>
					<form id="form" action="<?php echo site_url('controlador_registrar/guarda_especialidad');?>" method="post">
	  				<?php
	  			}		
	  		?>
	  		  			
	  		<label for="nombre">Nombre de la especialidad / área de formación</label>
	  		<input type="text" class="form-control required" value="<?php echo $Nombre ?>" id="nombre_especialidad" placeholder="Nombre de la especialidad" name="nombre_especialidad">
			<br/>	
			<button type="submit" class="btn btn-default">Guardar</button>
			</form>
		</div>
	</div>
	<script src="<?php echo base_url().BOOTSTRAP_JS?>"></script>    
</body>
</html>