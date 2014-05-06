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
  			<form action="<?php echo site_url('registrar_controlador/guarda_especialidad');?>" method="post">
	  			<label for="nombre">Nombre de la especialidad</label>
				<input type="text" class="form-control" id="nombre_especialidad" placeholder="Nombre de la especialidad" required pattern="([áéíóúÁÉÍÓÚñÑa-zA-Z\s]{2,70})*$" oninput="check(this)" name="nombre_especialidad">
				<br/>
				<button type="submit" class="btn btn-default">Guardar</button>
			</form>
		</div>
	</div>

	<?php $this->load->view('comunes/footer'); ?>    
</body>
</html>