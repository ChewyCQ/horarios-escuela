<!DOCTYPE html>
<html>
<?php $this->load->view('comunes/header'); ?>
<head>
	<title>Horarios</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
  		
  		<div id="tabla_horario">
  		</div>
	  			
			<div id="dias">
				<div>Asignación</div>
				<div>Lunes</div>
				<div>Martes</div>
				<div>Miercoles</div>
				<div>Jueves</div>
				<div>Viernes</div>
				<div>Sabado</div>
				<div>Domingo</div>
			</div>

			<div id="horas">
				<div>7:00</div>
				<div>7:50</div>
				<div>8:40</div>
				<div>9:30</div>
				<div>10:00</div>
				<div>10:40</div>
				<div>11:30</div>
				<div>12:20</div>
				<div>13:10</div>
				<div>14:00</div>
			</div>

			<!-- <div id="wrap"> -->
			<div id="horario">
				<?php 
					foreach ($materias as $materia) {
						echo "<div id='{$materia['idMateria']}' title='{$materia['Clave_materia']}'>{$materia['Nombre_materia']}</div>";
					}
				?>
			</div>
			<!-- </div> -->

		<?php $this->load->view('comunes/footer'); ?>  
		<script src="<?php echo base_url().SCRIPTS ?>"></script>
	</div>
</body>
</html>