<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra especialidad/área</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
  		<div class="form-group">
  			<?php
  				if($idEspecialidad!=null)
	  			{
	  				?>
	  				<form action="<?php echo site_url('controlador_actualizar/actualiza_especialidad');?>?id=<?php echo $idEspecialidad ?>" method="post">
	  				<?php
				}
				else
				{
					?>
					<form action="<?php echo site_url('controlador_registrar/guarda_especialidad');?>" method="post">
	  				<?php
	  			}		
	  		?>
	  		  			
	  		<label for="nombre">Nombre de la especialidad / área de formación</label>
	  		<input type="text" class="form-control" value="<?php echo $Nombre ?>" id="nombre_especialidad" placeholder="Nombre de la especialidad" required pattern="<?php echo PATRON_TEXTO_GUIONES; ?>" oninput="check(this)" name="nombre_especialidad">
			<br/>	
			<button type="submit" class="btn btn-default">Guardar</button>
			</form>
		</div>
	</div>

	<?php $this->load->view('comunes/footer'); ?>    
</body>
</html>