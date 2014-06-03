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
	<title>Materias-Semestre</title>
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
			//getPlanes(); //Al iniciar la carga de la vista muestra los resultados dependiendo del que este seleccionado
			$("#horas_escuela").attr("disabled",true);
			$("#horas_campo").attr("disabled",true);
			//Cuando no hay datos que guardar, desactivo el botón de guardar
			$("#guarda").attr("disabled",true);
		});
		//Función para cargar el select de los planes, dependiedo de la carrera que se seleccione
		function getDatos()
		{
			id_materia=$('#materias').val();	
			$.getJSON("<?php echo base_url()?>index.php/controlador_inicio/consulta_materias_semestre/"+id_materia,function(respuesta_json)
			{
				$('#tabla').empty();//Limpia la tabla
				//Activo las cajas de texto de las horas
				$("#horas_escuela").attr("disabled",false);
				$("#horas_campo").attr("disabled",false);
				//Activo el botón guardar
				$("#guarda").attr("disabled",false);
				//Respuesta de la consulta
				if(respuesta_json!=false)
				{	
					//Agregar los value a las cajas de texto con los datos de las horas
					$("#horas_escuela").attr("value", respuesta_json[0].Horas_semana_escuela);
					$("#horas_campo").attr("value", respuesta_json[0].Horas_semana_campo_clinico);
					//Agregar el encabezado de la tabla
					cad2="<thead><tr><th><center>Plan</center></th><th><center>Carrera</center></th><th><center>Horas-escuela</center></th><th><center>Horas-campo</center></th><th><center>Semestre</center></th><th width='40px'>Eliminar</th></tr></thead>";
					$('#tabla').append(cad2);					
					//Agregar los resultados en el resto de la tabla
					cad="";
					for (var i=0;i<respuesta_json.length;i++)
					{
						var cad="<tr><td>"
						+respuesta_json[i].Nombre_plan
						+"</td><td>"+respuesta_json[i].Nombre_carrera
						+"</td><td><center>"+respuesta_json[i].Horas_semana_escuela
						+"</center></td><td><center>"+respuesta_json[i].Horas_semana_campo_clinico
						+"</center></td><td><center>"+respuesta_json[i].Numero_semestre
						+"</center></td><td><center>"
						+"<input type='checkbox' value="+respuesta_json[i].idMateria+','+respuesta_json[i].idSemestre+" name='materia_semestre[]' class='grupo'>"
						+"</center></td></tr>";						
						$('#tabla').append(cad);
					}						
				}
				else
				{	
					//Limpiar las cajas de texto
					$("#horas_escuela").attr("value",'');
					$("#horas_campo").attr("value",'');
					//Desactivar las cajas de texto
					$("#horas_escuela").attr("disabled",true);
					$("#horas_campo").attr("disabled",true);
					//Cuando no hay datos que guardar, desactivo el botón de guardar
					$("#guarda").attr("disabled",true);
				}
				
			});
		}

		//Función para limpiar las cajas de texto y los combos, llamada por el botón de reset
		function Limpia()
		{
			$('#tabla').empty();//Limpia la tabla
			//Limpiar las cajas de texto
			$("#horas_escuela").attr("value",'');
			$("#horas_campo").attr("value",'');
			//Desactivar las cajas de texto
			$("#horas_escuela").attr("disabled",true);
			$("#horas_campo").attr("disabled",true);
			//Cuando no hay datos que guardar, desactivo el botón de guardar
			$("#guarda").attr("disabled",true);
		}
	</script>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">	
  		<div class="form-group">
  			<form id="form" action="<?php echo site_url('controlador_actualizar/actualiza_materia_semestre');?>" method="post">		
				<label for="materia">Materias</label>
				<select class="form-control required" id="materias" onchange="getDatos();" name="id_materia">
					<option value="0" selected="selected">Seleccione una opción</option>
					<?php
					foreach ($materias as $i => $materias)
						echo '<option value="'.$materias->idMateria.'">'.$materias->Nombre_materia.'</option>';	
					?>
				</select>	
				</br>
				<div class="panel panel-danger"> 
				  <div class="panel-heading">Elimina relaciones de Materia-Semestre</div>
				  <div class="panel-body">
				    <p>En esta tabla se muestran los semestres que estan asociados a la materia.</p>
				  </div>
					<table id="tabla" name="tabla" class="table table-striped table-bordered table-responsive table-condensed table-hover">					
					   
					</thead>
					</table>
				</div>	

				<div class="panel panel-info">
					<div class="panel-heading">
				    	<h3 class="panel-title">Editar horas de la materia</h3>
				  	</div>
				  	<div class="panel-body">
				    	<label for="horas">Horas a la semana en la escuela</label>
						<input type="text" class="form-control" id="horas_escuela"  placeholder="Horas en la escuela" name="horas_escuela">
						</br>
						<label for="horas">Horas a la semana en campo clínico</label>
						<input type="text" class="form-control" id="horas_campo" placeholder="Horas en campo" name="horas_campo">		
				  	</div>
				</div>
				<br/>
				<div align="right">
					<button type="submit" class="btn btn-primary btn-lg" title="Guardar" id="guarda"><span class='glyphicon glyphicon-floppy-save'></span></button>
					<button type="reset" class="btn btn-success btn-lg" title="Limpiar formulario" onclick="Limpia();" ><span class='glyphicon glyphicon-refresh'></span></button>				
					<button type="button" class="btn btn-danger btn-lg" title="Cancelar" onclick="window.location.href='<?php echo site_url('controlador_inicio/index');?>'"><span class='glyphicon glyphicon-floppy-remove'></span></button>
				</div>
			</form>
		</div>
	</div>
  <script src="<?php echo base_url().BOOTSTRAP_JS?>"></script>     
</body>
</html>