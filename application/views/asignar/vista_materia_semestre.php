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
	<title>Asignar meterias-semestres</title>
	<!--Validaciones-->
	<script type="text/javascript">
		$(function(){
			$('#form').validate({
				rules:{
					horas_escuela: {
						required: true,
						digits: true
					},
					horas_campo: {
						digits: true
					}
				},
				messages:{
					horas_escuela: {
						required: "<font color='red'>Campo obligatorio</font>",
						digits: "<font color='red'>Sólo se aceptan números, sin espacios</font><label></label>"
					},
					horas_campo: {
						digits: "<font color='red'>Sólo se aceptan números, sin espacios</font><label></label>"
					}
				},

			});
		});
	</script>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<?php
			if($var==1)
			{
				?>
					<div class="alert alert-danger alert-dismissable">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>¡Error!</strong> Complete correctamente el registro, seleccione los semestres que le corresponden a la materia.
					</div>
				<?php
			}
			else
			{
				if($var==2)
				{
					?>
						<div class="alert alert-danger alert-dismissable">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>¡Error!</strong> La materia ya está asociada a los semestres seleccionados, revise la tabla de materias-semestres y vuelva a intentar.
						</div>
					<?php
				}
			}
		?>	
		<!--Form group de los semestres-->
		<div class="form-group">			
			<form id="form" action="<?php echo site_url('controlador_registrar/guarda_materia_semestre');?>" method="post">
				<h4 class="text-center"><strong>ASIGNAR MATERIA-SEMESTRE</strong></h4>
				<label for="nombre">Nombre de la materia</label>
				<select class="form-control" name="id_materia">
					<?php
						foreach ($materias as $materias)
							if($id_materia==$materias->idMateria)
							{
								echo '<option value="'.$materias->idMateria.'" selected>'.$materias->Nombre_materia.'</option>';								
							}
							else{
								echo '<option value="'.$materias->idMateria.'">'.$materias->Nombre_materia.'</option>';
							}							
					?>
				</select>
				<div class="row">
					</br>
					<div class="col-xs-12">
						<table class="table table-striped table-bordered table-responsive table-condensed table-hover">
							<thead>
							<tr>		  						
		  						<th><center>Plan</center></th>
		  						<th><center>Carrera</center></th>
		  						<th><center>Semestre</center></th>
								<th width="40px"></th>
							</tr>
							</thead>
							<tbody>
							<?php 
								if (count($semestres)>0)
								{
									foreach ($semestres as $semestres)
									{								
										echo "<tr>";										
										echo "<td class='text-center'>".$semestres->Nombre_plan."</td>";
										echo "<td class='text-center'>".$semestres->Nombre_carrera."</td>";
										echo "<td class='text-center'>".$semestres->Numero_semestre."</td>";
										echo "<td class='text-center'>";
										echo "<input type='checkbox' value=".$semestres->idSemestre." name='semestres[]' class='grupo'>"; 
										echo "</td></tr>";							
				                	}
							 	} 							
			                ?>
			                </tbody>
	  					</table>

					</div>
				</div>
				<label for="horas">Horas a la semana en la escuela</label>
				<input type="text" class="form-control" required id="horas_escuela" value="<?php echo $horas_escuela ?>" placeholder="Horas en la escuela" name="horas_escuela">
				</br>
				<label for="horas">Horas a la semana en campo clínico</label>
				<input type="text" class="form-control" id="horas_campo" value="<?php echo $horas_campo ?>" placeholder="Horas en campo" name="horas_campo">
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