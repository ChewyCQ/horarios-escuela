<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
    <!--Para usar las validaciones-->
    <script type="text/javascript" src="<?php echo base_url()?>assets/validaciones/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/validaciones/Jqueryvalidation.js"></script>
	<script 
	type="text/javascript" src="<?php echo base_url()?>assets/validaciones/additional-methods.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/validaciones/nuevas-funciones.js"></script>
<head>
	<title>Asignar meterias-semestres</title>
	<!--Validaciones-->
	<script type="text/javascript">
		$(function(){
			$('#form').validate({
				rules:{
					horas_escuela: {
						digits: true
					},
					horas_campo: {
						digits: true
					}
				},
				messages:{
					horas_escuela: {
						digits: "<font color='red'>Sólo se aceptan números, sin espacios</font><label></label>"
					},
					horas_campo: {
						digits: "<font color='red'>Sólo se aceptan números, sin espacios</font><label></label>"
					}
				},

			});
		});
	</script>

	<!--Llenado de la tabla-->
	<script>
		$(document).on('ready',function(){
			//Cuando no hay datos que guardar, desactivo el botón de guardar
			$("#guarda").attr("disabled",true);
			getDatos();
		});
		//Obtiene los datos y los va agregando a la tabla
		function getDatos()
		{
			id_materia=$('#materias').val();
			if(id_materia==0)
			{
				$('#tabla').empty();//Limpia la tabla	
			}
			else
			{
				$.getJSON("<?php echo site_url('controlador_inicio/consulta_materia_semestre/');?>?id_materia="+id_materia,function(respuesta_json)
				{
					$('#tabla').empty();//Limpia la tabla				
					//Activo el botón guardar
					$("#guarda").attr("disabled",false);
					//Respuesta de la consulta
					if(respuesta_json!=false)
					{						
						//Agregar el encabezado de la tabla
						cad2="<thead><tr><th><center>Plan</center></th><th><center>Carrera</center></th><th><center>Semestre</center></th><th width='40px'>Agregar</th></tr></thead>";
						$('#tabla').append(cad2);					
						//Agregar los resultados en el resto de la tabla
						cad="";
						for (var i=0;i<respuesta_json.length;i++)
						{
							var cad="<tr><td><center>"
							+respuesta_json[i].Nombre_plan
							+"</center></td><td>"+respuesta_json[i].Nombre_carrera
							+"</td><td>"+respuesta_json[i].Numero_semestre+"</td><td><center>"
							+"<input type='checkbox' value="+respuesta_json[i].idSemestre+" name='semestres[]' class='grupo'>"
							+"</center></td></tr>";						
							$('#tabla').append(cad);
						}						
					}
					else
					{	
						//Cuando no hay datos que guardar, desactivo el botón de guardar
						$("#guarda").attr("disabled",true);
					}	
				});
			}			
		}		
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
				<select class="form-control required" id="materias" onchange="getDatos();" name="id_materia">
					<?php						
						if($id_materia==null){
						   ?> 
						   <option value="0" selected="true">SELECCIONE UNA MATERIA</option>						  
						   <?php
						}
						else
						{
							?> 
						   <option value="0">SELECCIONE UNA MATERIA</option>
							<?php
						}
					?>					
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

				</br>
				<div class="panel panel-success"> 
				  <div class="panel-heading">
				 	 <h3 class="panel-title"><strong>Semestres activos</strong></h3>
				  </div>
				  	<div class="panel-body">
				    	<p>En esta tabla se muestran todos los semestres a los cuales se le puede asociar una materia.</p>
				  	</div>
					<table id="tabla" name="tabla" class="table table-striped table-bordered table-responsive table-condensed table-hover">					
					</table>
				</div>
				
				<label for="horas">Horas a la semana en la escuela</label>
				<input type="text" class="form-control" id="horas_escuela" value="<?php echo $horas_escuela ?>" placeholder="Horas en la escuela" name="horas_escuela">
				</br>
				<label for="horas">Horas a la semana en campo clínico</label>
				<input type="text" class="form-control" id="horas_campo" value="<?php echo $horas_campo ?>" placeholder="Horas en campo" name="horas_campo">
				<br/>	
				<br/>	
				<div align="right">
					<button type="submit" class="btn btn-primary btn-lg" title="Guardar" id="guarda"><span class='glyphicon glyphicon-floppy-save'></span></button>										
					<button type="button" class="btn btn-danger btn-lg" title="Cancelar" onclick="window.location.href='<?php echo site_url('controlador_inicio/index');?>'"><span class='glyphicon glyphicon-floppy-remove'></span></button>
				</div>
			</form>
		</div>
	</div>
	<script src="<?php echo base_url().BOOTSTRAP_JS?>"></script>      
</body>
</html>