<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Inicio de sesion</title>
</head>
<body>
	<div class="container">
		<?php 
			$forma = array(
				'role' => 'form',
				'id' => 'forma',
				'class' => 'form-signin',
			);
		?>
		<?php echo form_open('login/validar_login', $forma); ?>
			<br/>
			<br/>
			<br/>	
			<br/>
			<br/>
			<br/>			
			<h2 class="form-signin-heading">Favor de iniciar sesión</h2>
			<input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario" required autofocus>
			<br/>
			<input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Contraseña" required>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
		</form>
	</div>

	<?php $this->load->view('comunes/footer'); ?>    
</body>
</html>