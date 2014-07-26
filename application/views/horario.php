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
				<div style="width: 12.3%">&nbsp;</div>
				<div>Lunes</div>
				<div>Martes</div>
				<div>Miercoles</div>
				<div>Jueves</div>
				<div>Viernes</div>
				<!-- <div>Sabado</div> -->
				<!-- <div>Domingo</div> -->
			</div>
			<?php if ($grupo['turno'] == 1): ?>
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
			<?php else: ?>
			<div id="horas">
				<div>14:00</div>
				<div>14:50</div>
				<div>15:40</div>
				<div>16:30</div>
				<div>17:00</div>
				<div>17:40</div>
				<div>18:30</div>
				<div>19:20</div>
				<div>20:10</div>
				<div>21:00</div>
			</div>
			<?php endif ?>


			<!-- <div id="wrap"> -->
			<div id="horario">
				<?php 
					$num_materias = 0;
					$numero = 1;
					foreach ($materias as $materia) {
						for ($horas_semana=1; $horas_semana <= $materia['Horas_semana_escuela'] ; $horas_semana++) { 
							echo "<div id='grupo{$grupo["idGrupo"]}_materia_id{$materia['idMateria']}n{$numero}' title='{$materia['Nombre_materia']}'>{$materia['Clave_materia']}</div>";
							$num_materias++;
							$numero++;
						}
					}
					for ($i=$num_materias; $i < 50; $i++) { 
						echo "<div id='materia_vacio{$i}'>&nbsp;</div>";
					}
				?>
			</div>
			<!-- </div> -->

		<?php $this->load->view('comunes/footer'); ?>  
		<script src="<?php echo base_url(SCRIPTS) ?>"></script>
	</div>
</body>
</html>