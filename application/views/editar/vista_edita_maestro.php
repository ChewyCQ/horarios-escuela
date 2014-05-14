<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Editar maestros</title>

	<link href="<?php echo base_url()?>assets/datatable/css/jquery.dataTables.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url()?>assets/datatable/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/datatable/js/jquery.dataTables.js"></script>

	<script type="text/javascript" language="javascript" class="init">
		$(document).ready(function() {
			$('#tabla').dataTable({"aoColumnDefs": [{ "bSortable": false, "aTargets": [2]}]});
		} );
		//{"aoColumnDefs": [{ "bSortable": false, "aTargets": [1]}]} Desactiva el descendente o ascendente en la columna especificada
	</script>

</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<div class="form-group"> 
		<div class="table-responsive">
  				<table id="tabla" class="display" cellspacing="0" width="100%">
  					<thead>
	  					<tr>
	  						<th><center>Clave del maestro</center></th>
	  						<th><center>Nombre del maestro</center></th>
							<th width="40px">Opción</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						if (count($maestros)>0)
						{
							foreach ($maestros as $maestros) 
							{
								echo "<tr>";
								echo "<td class='success' height='100%'>".$maestros->Clave."</td>";
								echo "<td class='success' height='100%'>".$maestros->Nombre."</td>";
								echo "<td class='success' align='center' height='100%'>";
								?>
								<form action="<?php echo site_url('controlador_inicio/maestro');?>?id=<?php echo $maestros->idMaestro?>" method="post"> <!--Envía el id del dato que se modificará-->
								<?php
								echo "<button type='input' class='btn btn-primary btn-sm' title='Editar registro'><span class='glyphicon glyphicon-edit'></span></button>";
								?>
								</form>		
			                  	<?php
								echo "</td></tr>";
							}
					 	} 							
	                ?>
	                </tbody>
  				</table>
  			</div>
  			</div>
	</div>
	<script src="<?php echo base_url().BOOTSTRAP_JS?>"></script>  
</body>
</html>