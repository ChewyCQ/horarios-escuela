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
	  				foreach ($especialidades as $i => $especialidades);	
	  				?>
	  				<form action="<?php echo site_url('actualizar_controlador/actualiza_especialidad');?>?id=<?php echo $especialidades->idEspecialidad?>" method="post">
	  				<label for="nombre">Nombre de la especialidad / área de formación</label>
	  				<input type="text" class="form-control" value="<?php echo $especialidades->Nombre ?>" id="nombre_especialidad" placeholder="Nombre de la especialidad" required pattern="([áéíóúÁÉÍÓÚñÑa-zA-Z\s]{2,70})*$" oninput="check(this)" name="nombre_especialidad">
	  				<?php

				}
				else
				{
					?>
					<form action="<?php echo site_url('registrar_controlador/guarda_especialidad');?>" method="post">
	  				<label for="nombre">Nombre de la especialidad / área de formación</label>
	  				<input type="text" class="form-control" value="" id="nombre_especialidad" placeholder="Nombre de la especialidad" required pattern="([áéíóúÁÉÍÓÚñÑa-zA-Z\s]{2,70})*$" oninput="check(this)" name="nombre_especialidad">
	  				<?php
	  			}
  						
	  			?>	  			
	  			<br/>
				<button type="submit" class="btn btn-default">Guardar</button>
			</form>
		</div>
	</div>

	<?php $this->load->view('comunes/footer'); ?>    
</body>
</html>