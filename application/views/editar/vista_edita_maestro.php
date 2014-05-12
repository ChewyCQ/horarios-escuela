<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Editar áreas</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<div class="btn-group span4">
	    	<a class="btn btn-primary span6" href="#addModal" role="button" data-toggle="modal">Nueva</a>
	    </div>
	    <br/>
	    <br/>
	    <div class="form-group"> 
	   		<div class="table-responsive">
	   			<table class="table table-hover table-bordered">
	   				<tr>
	   					<th>Nombre del maestro</th>
						<th width="40px">Opción</th>
					</tr>
					<?php
					foreach ($maestros as $maestros) {
						?>
						<form action="<?php echo site_url('controlador_inicio/maestro');?>?id=<?php echo $maestros->idMaestro?>" method="post"> <!--Envía el id del dato que se modificará-->
						<?php
							echo "<tr>";
							echo "<td class='success' height='100%'>".$maestros->Nombre."</td>";
							echo "<td class='success' align='center' height='100%'><button type='input' class='btn btn-primary btn-sm' title='Editar registro'><span class='glyphicon glyphicon-ok'></span></button></td>";
							echo "</tr>";
						?>
						</form>		
	                  	<?php
					}
					?>
				</table>		  			
			</div>
		</div>
	</div>
	<?php $this->load->view('comunes/footer'); ?>    
</body>
</html>