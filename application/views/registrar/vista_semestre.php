<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra semestre</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
  		<div class="form-group">
  			<form action="<?php echo site_url('registrar_controlador/guarda_semestre');?>" method="post">
		    	<label for="nombre">Número del semestre</label>
				<input type="text" class="form-control" id="numero_semestre" placeholder="N° Semestre" name="numero_semestre" required pattern="([0-9]{1,2})$" oninput="check(this)">
				<label for="plan">Plan</label>
				<select class="form-control" name="id_plan">
					<?php
					foreach ($planes as $i => $plan)
					   echo '<option value="'.$plan->idPlan.'">'.$plan->Nombre_plan.'</option>';
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