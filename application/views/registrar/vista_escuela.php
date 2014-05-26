<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
	<link href="<?php echo base_url('/assets/jquery_ui/css/smoothness/jquery-ui-1.10.4.custom.css')?>" rel="stylesheet">
<head>
	<title>Datos de la escuela</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<legend>Datos de la escuela</legend>
  		<div class="form-group">
  			<?php 
  				$nombre_escuela = array(
					'type' => 'text', 
					'id' => 'nombre_escuela', 
					'name' => 'nombre_escuela', 
					'class' => 'form-control',
					'value' => $nombre_escuela,
					'placeholder' => $nombre_escuela,
					'required' => TRUE
				);
				$subir = array(
					'type' => 'submit',
					'value' => 'Guardar',
					'class' => 'btn btn-default'
				);
  			 ?>
			<?php echo $error; ?>
			<?php echo form_open('controlador_registrar/guardar_escuela'); ?>

			<label>Nombre de la escuela</label>
			<?php echo form_input($nombre_escuela); ?><br/>
			</br>
			<button type="submit" class="btn btn-default btn-lg" title="Guardar"><span class='glyphicon glyphicon-floppy-save'></span></button>
			<?php #echo form_input($subir); ?> 
			<?php echo form_close(); ?>
		</div>
	</div>
	<?php $this->load->view('comunes/footer'); ?>
	<script src="<?php echo base_url().SCRIPTS?>"></script>
	<!--
	-->
</body>
</html>