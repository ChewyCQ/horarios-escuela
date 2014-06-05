<!DOCTYPE html>
<html>
<?php $this->load->view('comunes/header'); ?>
<head>
	<title>Horarios</title>
	<style type="text/css" media="screen">
		#sortMe{
			border: 1px solid silver;
		}
		#sortMe div {
			margin: 5px;
			padding: 10px;
			background: #E5E5E5;
		}
	</style>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
  		
		<div id="wrap">
			<div id="sortMe">
				<div id="item_1">Prueba 1</div>
				<div id="item_2">Prueba 2</div>
				<div id="item_3">Prueba 3</div>
				<div id="item_4">Prueba 4</div>
				<div id="item_5">Prueba 5</div>
			</div>
		</div>

		<?php $this->load->view('comunes/footer'); ?>  
		<script src="<?php echo base_url().SCRIPTS ?>"></script>
	</div>
</body>
</html>