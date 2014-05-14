<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra dependencia</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
  		<div class="form-group">
  			<?php
  				if($idDependencia!=null)
	  			{
	  				?>
	  				<form action="<?php echo site_url('controlador_actualizar/actualiza_dependencia');?>?id=<?php echo $idDependencia?>" method="post">
	  				<?php
				}
				else
				{
					?>
					<form action="<?php echo site_url('controlador_registrar/guarda_dependencia');?>" method="post">
	  				<?php
	  			}		
	  		?>
  			
	  			<label for="nombre">Nombre de la dependencia</label>
				<input type="text" class="form-control" id="nombre" placeholder="Nombre" value="<?php echo $Nombre ?>" required pattern="<?php echo PATRON_TEXTO_GUIONES; ?>" oninput="check(this)" name="nombre">
				<label for="numero">Cantidad máxima de alumnos que acepta</label>
				<input type="text" class="form-control" id="cantidad" value="<?php echo $CantidadMaxAlumnos?>" placeholder="Cantidad de alumnos Campo Clínico" name="cantidad" required pattern="([0-9])*$" oninput="check(this)">
				<br/>
				<button type="submit" class="btn btn-default">Guardar</button>
			</form>
		</div>
	</div>

	<?php $this->load->view('comunes/footer'); ?>    
</body>
</html>