<!DOCTYPE html>
<html>
<?php $this->load->view('comunes/header'); ?>
<head>
	<title>Horarios</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<legend>Horario del grupo <?php echo $grupo['Clave']; ?> para el semestre<?php echo $grupo['semestre']; ?></legend>
		<!-- Datos del grupo-->
		<div>
			
		</div>
	</div>

	<div>
		<?php 
			if ($grupo['turno'] == 1) {
				$horas = array("7:00","7:50","8:40","9:30","10:00","10:40","11:30","12:20","13:10","14:00");
			} else {
				$horas = array("14:00","14:50","15:40","16:30","17:20","17:50","18:40","19:30","20:20","21:10");
			}
		?>
		<?php $hidden = array(
			'id_periodo' => $periodo['idPeriodo'],
			'id_grupo' => $grupo['idGrupo'],
			'turno' => $grupo['turno']
			); ?>
		<?php echo form_open('controlador_asignar/guardar_horario'); ?>
  		<?php echo form_hidden($hidden); ?>
  		<!-- Horario -->
		<div id="form_horario">
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
					<?php for ($j=0; $j < 9; $j++) : ?>
					<tr>
						<td><?php echo $horas[$j]."-".$horas[$j+1] ; ?></td>
						<!-- receso -->
						<?php if ($j == 3): ?> 
							<?php for ($i=0; $i < 5; $i++) : ?>
							<td><select name="<?php echo "hora_{$i}_{$j}" ?>" class="form-control">
							<option value="0">Receso</option>
							<?php foreach ($materias as $materia): ?>
								<option value="<?php echo $materia['idMateria'] ?>"><?php echo $materia['Nombre_materia']; ?></option>
							<?php endforeach ?>
								</select></td>
							<?php endfor; ?>
							<?php continue; ?>
						<?php endif ?>
						<?php for ($i=0; $i < 5; $i++) : ?>
						<td><select name="<?php echo "hora_{$i}_{$j}" ?>" class="form-control">
							<option value="0">&nbsp;</option>
							<?php foreach ($materias as $materia): ?>
								<option value="<?php echo $materia['idMateria'] ?>"><?php echo $materia['Nombre_materia']; ?></option>
							<?php endforeach ?>
						</select></td>
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
					<?php foreach ($materias as $materia): ?>
					<tr>
						<td><?php echo $materia['Nombre_materia']; ?></td>
						<td><?php echo $materia['Clave_materia']; ?></td>
						<td><?php echo ($materia['Horas_semana_escuela'] + $materia['Horas_semana_campo_clinico']); ?></td>
						<td><select name="<?php echo "maestro_idmat_{$materia['idMateria']}" ?>" class="form-control">
							<option value="0">&nbsp;</option>
							<?php foreach ($maestros as $maestro): ?>
								<option value="<?php echo $maestro['idMaestro'] ?>"><?php echo $maestro['Nombre'] ?></option>
							<?php endforeach ?>
						</select></td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<div class="container">
			<?php $submit = array(
				'class' => "btn btn-primary", 
				'value' => "Guardar"
				); ?>
			<?php echo form_submit($submit); ?><br/><br/>
		</div>

		<?php $this->load->view('comunes/footer'); ?>  
		<script src="<?php echo base_url(SCRIPTS) ?>"></script>
	</div>
</body>
</html>