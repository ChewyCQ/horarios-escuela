<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Datos extraidos del CSV</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<table class="table table-striped table-bordered table-responsive table-condensed table-hover">
			<caption>Datos de los maestros del CSV</caption>
			<thead>
				<tr>
					<th>Clave</th>
					<th>Nombre</th>
					<th>Nivel<br/>(PA/PB/PC/TA)</th>
					<th>Fecha ingreso<br/>(dd/mm/aa)</th>
					<th>Correo</th>
					<th>Certificado</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($maestros as $maestro) {
					echo "<tr>";
					echo "<td class='text-center'>{$maestro['clave']}</div></td>";
					echo "<td>{$maestro['nombre']}</div></td>";
					echo "<td class='text-center'>{$maestro['nivel']}</td>"; 
					echo "<td class='text-center'>{$maestro['fecha de ingreso']}</td>";
					echo "<td class='text-center'>{$maestro['correo']}</td>";
					echo "<td class='text-center'>{$maestro['certificacion']}</td>";
					echo "</tr>";
				}; ?>
			</tbody>
		</table>
		<div>
			<?php 
				$_POST['$maestros'] = $maestros;
				echo form_open('csv/guardar_maestros');
				$boton = array(
				    'name' => 'button',
				    'id' => 'button',
				    'value' => 'true',
				    'type' => 'submit',
				    'content' => 'Guardar',
				    'class' => 'btn btn-success pull-right',
				    'onclick' => base_url()."index.php/csv/guardar_maestros",
				    'action' => base_url()."index.php/csv/guardar_maestros"
				);
				echo form_button($boton); 
				echo form_close();
			?>
		</div>
	</div>

	<?php $this->load->view('comunes/footer'); ?>    
</body>
</html>