<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra semestre</title>
	<?php $this->load->view('comunes/validaciones'); ?>
	<script type="text/javascript">
		$(function(){
			$('#form').validate({
				rules:{
					numero_semestre: {
						required: true,
						maxlength: 1,
						digits: true
					}
				},
				messages:{
					numero_semestre: {
						required: "<font color='red'>Campo obligatorio</font>",
						maxlength: "<font color='red'>Máximo 1 dígito</font>",
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
		<legend>Nuevo semestre</legend>
  		<div class="form-group">
	  		<?php
	  			if($idSemestre!=null)
		  		{
		  			?>
		  			<form id="form" action="<?php echo site_url('controlador_actualizar/actualiza_semestre');?>?id=<?php echo $idSemestre?>" method="post">
		  			<?php
				}
				else
				{
					?>
					<form id="form" action="<?php echo site_url('controlador_registrar/guarda_semestre');?>" method="post">
		  			<?php
		  		}		
		  	?>
		  	<label for="numero">Número del semestre</label>
			<input type="text" class="form-control required" id="numero_semestre" placeholder="N° Semestre" name="numero_semestre" value="<?php echo $Numero_semestre?>">
			</br>
			<label for="plan">Plan</label>
			<select class="form-control" name="id_plan">
				<?php
					foreach ($planes as $i => $plan)
						if($idPlan==$plan->idPlan)
						{
							echo '<option value="'.$plan->idPlan.'" selected>'.$plan->Nombre_plan.'</option>';
						}
						else{
							echo '<option value="'.$plan->idPlan.'">'.$plan->Nombre_plan.'</option>';
						}					   
				?>
			</select>
			<br/>
			<button type="submit" class="btn btn-default">Enviar</button>
		</div>
	</div>
	<script src="<?php echo base_url().BOOTSTRAP_JS?>"></script>  
</body>
</html>