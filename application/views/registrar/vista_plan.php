<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra plan</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
  		<div class="form-group">
  			<?php
  				if($idPlan!=null)
	  			{
	  				?>
	  				<form action="<?php echo site_url('controlador_actualizar/actualiza_plan');?>?id=<?php echo $idPlan?>" method="post">
	  				<?php
				}
				else
				{
					?>
					<form action="<?php echo site_url('controlador_registrar/guarda_plan');?>" method="post">
	  				<?php
	  			}		
	  		?>
  				<label for="nombre">Nombre del plan</label>
				<input type="text" class="form-control" id="nombre_plan" value="<?php echo $Nombre_plan ?>" placeholder="Nombre del plan" name="nombre_plan" required pattern="<?php echo PATRON_TEXTO_GUIONES_NUMEROS; ?>" oninput="check(this)">
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

	<?php $this->load->view('comunes/footer'); ?>    
</body>
</html>