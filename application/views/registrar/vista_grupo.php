<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra grupo</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
  		<div class="form-group">
  			<form action="<?php echo site_url('registrar_controlador/guarda_grupo');?>" method="post">
		    	<label for="generacion">Generación</label>
				<input type="text" class="form-control" id="generacion" placeholder="N° de la generación" name="generacion" required pattern="([0-9]{1,4})$" oninput="check(this)">
				<label for="generacion">Clave</label>
				<input type="text" class="form-control" id="clave" placeholder="Clave del grupo" name="clave" required pattern="([0-9])*$" oninput="check(this)">
				<label for="semestre">Semestre</label>
				<select class="form-control" name="id_semestre">
					<?php
					foreach ($semestres as $i => $semestres)
					   echo '<option value="'.$semestres->idSemestre.'">'.$semestres->Numero_semestre.'</option>';
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