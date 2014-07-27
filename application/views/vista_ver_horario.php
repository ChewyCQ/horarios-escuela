<!DOCTYPE html>
<html>
<?php $this->load->view('comunes/header'); ?>
<head>
	<title>Horarios</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<legend>Horario del grupo <?php echo $grupo['Clave']; ?> para el semestre <?php echo $grupo['semestre']; ?></legend>
		<!-- Datos del grupo-->
		<div>
			
		</div>
	</div>

	<div>
		<?php 
			$dias = array("lunes","martes","miercoles","jueves","viernes","sabado","domingo");
			if ($grupo['turno'] == 1) {
				$horas = array("07:00","07:50","08:40","09:30","10:00","10:40","11:30","12:20","13:10","14:00");
			} else {
				$horas = array("14:00","14:50","15:40","16:30","17:20","17:50","18:40","19:30","20:20","21:10");
			}
		?>
		<?php $hidden = array(
			'id_periodo' => $periodo['idPeriodo'],
			'id_grupo' => $grupo['idGrupo'],
			'turno' => $grupo['turno']
			); ?>
  		<!-- Horario -->
		<div id="container">
			<table class="table table-striped table-bordered">
				<caption>Horario</caption>
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th>Lunes</th>
						<th>Martes</th>
						<th>Miercoles</th>
						<th>Jueves</th>
						<th>Viernes</th>
					</tr>
				</thead>
				<tbody>
					<?php for ($j=0; $j < 9; $j++) : ?> <!-- Horas -->
					<tr>
						<td><?php echo $horas[$j]."-".$horas[$j+1] ; ?></td>
						<?php for ($i=0; $i < 5; $i++) : ?> <!-- Dias -->
						<td>
						<?php $encontrado = FALSE; ?>
						<?php foreach ($clases as $clase): ?>
						<?php if (substr($clase['hora_inicio'], 0, 5) == $horas[$j] && $clase['iddia_semana'] == $dias[$i]): ?>
							<?php echo $clase['Nombre_materia']; ?>
							<?php break; ?>
						<?php endif ?>
						<?php if ($j == 3): ?>
							<strong>Receso</strong>
							<?php break; ?>
						<?php endif ?>
						<?php endforeach ?>
						</td>
						<?php endfor; ?>
					</tr>
					<?php endfor;?>
				</tbody>
			</table>
		</div>
		<br/>
		<br/>
  		<!-- Maestros -->
		<div class="container">
			<table class="table table-striped table-bordered">
				<caption>Prestadores de servicios que impartiran los modulos</caption>
				<thead>
					<tr>
						<th>Modulo</th>
						<th>Siglema</th>
						<th>H/S</th>
						<th>Prestador de Servicios Profesionales</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($maestro_materia as $mm): ?>
					<tr>
						<td><?php echo $mm['Nombre_materia']; ?></td>
						<td><?php echo $mm['Clave_materia']; ?></td>
						<td><?php echo ($mm['Horas_semana_escuela'] + $mm['Horas_semana_campo_clinico']); ?></td>
						<td><?php echo $mm['Nombre']; ?></td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<br/><br/>

		<?php $this->load->view('comunes/footer'); ?>  
		<script src="<?php echo base_url(SCRIPTS) ?>"></script>
	</div>
</body>
</html>