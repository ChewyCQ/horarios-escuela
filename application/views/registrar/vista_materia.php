<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra materia</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
  		<div class="form-group">
  			<form action="<?php echo site_url('registrar_controlador/guarda_materia');?>" method="post">
	  			<label for="nombre">Nombre de la materia</label>
				<input type="text" class="form-control" id="nombre_materia" placeholder="Nombre materia" 
				required pattern="<?php echo PATRON_NOMBRE; ?>" oninput="check(this)" name="nombre_materia">
				<label for="tipo_materia">Tipo de materia</label>
				<select class="form-control" name="tipo_materia">
				  <option value="0">Núcleo de Formación Básica</option>
				  <option value="1">Núcleo de Formación Profesional</option>
				  <option value="2">Trayectos Técnicos</option>
				  <option value="3">Trayectos Propedéuticos</option>
				</select>
				<br/>
				<button type="submit" class="btn btn-default">Enviar</button>
			</form>
		</div>
	</div>

	<?php $this->load->view('comunes/footer'); ?>    
</body>
</html>