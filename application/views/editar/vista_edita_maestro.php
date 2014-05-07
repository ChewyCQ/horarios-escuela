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
  			<form action="<?php echo site_url('registrar_controlador/guarda_especialidad');?>" method="post">
	  			<div class="table-responsive">
	  				<table class="table table-hover table-bordered">
  						<thead>
  							<tr>
						      <th>Nombre del Maestro</th>
						      <th>Nivel del Maestro</th>
						      <th>Correo</th>
						      <th width="40px">Opción</th>
						    </tr>
						</thead>
						<tbody>
							<?php
								foreach ($maestros as $maestros) {//Lo que tenemos en la variable prueba
									echo "<tr>";
									echo "<td class='success' height='100%'>".$maestros->Nombre."</td>"; 
									echo "<td class='success' height='100%'>".$maestros->Nivel."</td>"; 
									echo "<td class='success' height='100%'>".$maestros->Correo."</td>"; 
									echo "<td class='success' align='center' height='100%'><button type='button' class='btn btn-primary btn-sm' title='Editar registro'><span class='glyphicon glyphicon-ok'></span></button></td>"; //Inserta una celda con el valor Provincia
									echo "</tr>";
								}
							?>
					  	</tbody>
					</table>		  			
				</div>
			</form>
		</div>
	</div>
	<?php $this->load->view('comunes/footer'); ?>    
</body>
</html>