<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
	<?php $this->load->view('comunes/header'); ?>
<head>
	<title>Login</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>

	<?php $this->load->view('inicio_sesion.php'); ?>

	<?php $this->load->view('comunes/footer'); ?>
</body>
</html>