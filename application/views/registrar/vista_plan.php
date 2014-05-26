<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra plan</title>
	<?php $this->load->view('comunes/validaciones'); ?>
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
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<legend>Nuevo plan</legend>
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
				<button type="submit" class="btn btn-default">Enviar</button>
			</form>
		</div>
	</div>

	<script src="<?php echo base_url().BOOTSTRAP_JS?>"></script>  
</body>
</html>