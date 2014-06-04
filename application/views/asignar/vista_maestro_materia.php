<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
    <!--Para usar las validaciones-->
    <script type="text/javascript" src="<?php echo base_url()?>assets/validaciones/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/validaciones/Jqueryvalidation.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/validaciones/additional-methods.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/validaciones/nuevas-funciones.js"></script>
<head>
	<title>Asignar maestro-materia</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">	
		<!--Form group de los semestres-->
		<div class="form-group">			
			<form id="form" action="<?php echo site_url('controlador_registrar/guarda_materia_semestre');?>" method="post">
				<h4 class="text-center"><strong>ASIGNAR MAESTRO-MATERIA</strong></h4>
				<label for="nombre">Maestros</label>
				<select class="form-control" name="id_maestro">
					<?php
						foreach ($maestros as $maestros)
							echo '<option value="'.$maestros->idMaestro.'">'.$maestros->Nombre.'</option>';							
					?>
				</select>
				<div class="row">
					</br>
					<div class="col-xs-12">						

					</div>
				</div>
				
				<br/>	
				<br/>	
				<div align="right">
					<button type="submit" class="btn btn-primary btn-lg" title="Guardar"><span class='glyphicon glyphicon-floppy-save'></span></button>
					<button type="reset" class="btn btn-success btn-lg" title="Limpiar formulario"><span class='glyphicon glyphicon-refresh'></span></button>											
					<button type="button" class="btn btn-danger btn-lg" title="Cancelar" onclick="window.location.href='<?php echo site_url('controlador_inicio/index');?>'"><span class='glyphicon glyphicon-floppy-remove'></span></button>
				</div>
			</form>
		</div>
	</div>
	<script src="<?php echo base_url().BOOTSTRAP_JS?>"></script>      
</body>
</html>