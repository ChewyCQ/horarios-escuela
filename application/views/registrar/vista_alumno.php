<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra alumno</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
  		<div class="form-group">
  			<form action="<?php echo site_url('registrar_controlador/guarda_alumno');?>" method="post">
		    	<label for="nombre">Nombre del Alumno</label>
				<input type="text" class="form-control" id="nombre_maestro" placeholder="Nombre" name="nombre" required pattern="([áéíóúÁÉÍÓÚñÑa-zA-Z\s])*$" oninput="check(this)">
				<label for="email">Email</label>
			    <input type="email" class="form-control" id="email" placeholder="Introduce tu email" name="email" required pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$">
				<label for="clave">Clave del grupo</label>
				<select class="form-control" name="id_grupo">
					<?php
					foreach ($grupos as $i => $grupos)
					   echo '<option value="'.$grupos->idGrupo.'">'.$grupos->Clave.'</option>';
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