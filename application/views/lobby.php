<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
	<?php $this->load->view('comunes/header'); ?>
<head>
	<title>Pagina principal</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>

	<br/>
	<br/>
	<img src="<?php echo base_url()?>assets/img/logo.png" class="img-responsive center-block">
	
	<?php $this->load->view('comunes/footer'); ?>
</body>
</html>