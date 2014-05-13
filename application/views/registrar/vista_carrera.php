<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra carrera</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
  		<div class="form-group">
  			<?php
  				if($idCarrera!=null)
	  			{
	  				?>
	  				<form action="<?php echo site_url('controlador_actualizar/actualiza_carrera');?>?id=<?php echo $idCarrera?>" method="post">
	  				<?php
				}
				else
				{
					?>
					<form action="<?php echo site_url('controlador_registrar/guarda_carrera');?>" method="post">
	  				<?php
	  			}		
	  		?>
		  		<label for="nombre">Nombre de la carrera</label>
				<input type="text" class="form-control" id="nombre_carrera" value="<?php echo $Nombre_carrera ?>" placeholder="Nombre de la carrera" required pattern="<?php echo PATRON_TEXTO_GUIONES; ?>" oninput="check(this)" name="nombre_carrera">
				<br/>
				<button type="submit" class="btn btn-default">Guardar</button>
			</form>
		</div>
	</div>

	<?php $this->load->view('comunes/footer'); ?>    
</body>
</html>