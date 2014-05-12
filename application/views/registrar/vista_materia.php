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
  			<?php
  				if($idMateria!=null)
	  			{
	  				?>
	  				<form action="<?php echo site_url('controlador_actualizar/actualiza_materia');?>?id=<?php echo $idMateria?>" method="post">
	  				<?php
				}
				else
				{
					?>
					<form action="<?php echo site_url('controlador_registrar/guarda_materia');?>" method="post">
	  				<?php
	  			}		
	  		?>
	  		<label for="nombre">Nombre de la materia</label>
			<input type="text" class="form-control" id="nombre_materia" placeholder="Nombre materia" 
			required pattern="<?php echo PATRON_TEXTO_GUIONES; ?>" oninput="check(this)" name="nombre_materia"  value="<?php echo $Nombre_materia ?>">
			<label for="tipo_materia">Tipo de materia</label>
			<!--Código para verificar cual dato del combo esta seleccionado-->
			<?php
				$sel0 = "";
				$sel1 = "";
				$sel2 = "";
				$sel3 = "";
				if($Tipo_materia == 0){
				    $sel0 = "selected";
				}
				if($Tipo_materia == 1){
				    $sel1 = "selected";
				}
				if($Tipo_materia == 2){
					$sel2 = "selected";
				}
				if($Tipo_materia == 3){
					$sel3 = "selected";
				}
			?>
			<select class="form-control" name="tipo_materia">
			  <option value="0" <?php echo $sel0;?> >Núcleo de Formación Básica</option>
			  <option value="1" <?php echo $sel1;?> >Núcleo de Formación Profesional</option>
			  <option value="2" <?php echo $sel2;?> >Trayectos Técnicos</option>
			  <option value="3" <?php echo $sel3;?> >Trayectos Propedéuticos</option>
			</select>
			<br/>
			<button type="submit" class="btn btn-default">Enviar</button>
		</div>
	</div>

	<?php $this->load->view('comunes/footer'); ?>    
</body>
</html>