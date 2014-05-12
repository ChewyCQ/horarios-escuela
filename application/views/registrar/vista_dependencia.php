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
  			<form action="<?php echo site_url('controlador_registrar/guarda_dependencia');?>" method="post">
	  			<label for="nombre">Nombre de la dependencia</label>
				<input type="text" class="form-control" id="nombre" placeholder="Nombre" required pattern="<?php echo PATRON_TEXTO_GUIONES; ?>" oninput="check(this)" name="nombre">
				<label for="numero">Cantidad máxima de alumnos que acepta</label>
				<input type="text" class="form-control" id="cantidad" placeholder="Cantidad de alumnos Campo Clínico" name="cantidad" required pattern="([0-9])*$" oninput="check(this)">
				<br/>
				<button type="submit" class="btn btn-default">Guardar</button>
			</form>
		</div>
	</div>

	<?php $this->load->view('comunes/footer'); ?>    
</body>
</html>