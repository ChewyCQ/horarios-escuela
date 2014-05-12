<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Editar áreas</title>

	<link href="<?php echo base_url()?>assets/datatable/css/jquery.dataTables.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url()?>assets/datatable/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/datatable/js/jquery.dataTables.js"></script>

	<script type="text/javascript" language="javascript" class="init">
		$(document).ready(function() {
			$('#tabla').dataTable();
		} );
	</script>

</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<div class="form-group"> 
  				<table id="tabla" class="display" cellspacing="0" width="100%">
  					<thead>
	  					<tr>
	  						<th>Áreas de formación</th>
							<th width="40px">Opción</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($areas as $areas) {
								?>
								<form action="<?php echo site_url('controlador_inicio/especialidad');?>?id=<?php echo $areas->idEspecialidad?>" method="post"> <!--Envía el id del dato que se modificará-->
								<?php
								echo "<tr>";
								echo "<td class='success' height='100%'>".$areas->Nombre ."</td>";
								echo "<td class='success' align='center' height='100%'><button type='input' class='btn btn-primary btn-sm' title='Editar registro'><span class='glyphicon glyphicon-ok'></span></button></td>"; 
								echo "</tr>";
								?>
								</form>		
		                    	<?php
		                	}
	                	?>
	                </tbody>
  				</table>
  			</div>
	</div>
	<script src="<?php echo base_url().BOOTSTRAP_JS?>"></script>  
</body>
</html>