<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Subir CSV de las Materias</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
  		<div class="form-group">
			<?php echo $error; ?>
			<?php $atributos_forma = array(
				'class' => 'form', 
				'id' => 'forma_subir'
			); ?>
			<?php $seleccionar = array(
				'type' => 'file', 
				'id' => 'seleccionar_csv', 
				'name' => 'userfile', 
				'size' => '20', 
				'class' => 'input-file',
				'required' => TRUE
			); ?>
			<?php $subir = array(
				'type' => 'submit',
				'value' => 'Subir',
				'class' => 'btn btn-default'
			); ?>
			
			<?php echo form_open_multipart('csv/validar_csv_materias', $atributos_forma);?>
			<label class="control-label" for="filebutton">Seleccionar archivo con extensión csv con la información de las materias.</label>
			<?php echo form_input($seleccionar); ?>
			<br />
			<?php echo form_input($subir); ?> 
			<?php echo form_close(); ?>
		</div>
	</div>

	<?php $this->load->view('comunes/footer'); ?>    
</body>
</html>