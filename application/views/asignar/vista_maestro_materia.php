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
			id_maestro=$('#maestros').val();
			if(id_maestro==0)
			{
				$('#tabla').empty();//Limpia la tabla	
				$('#tabla_dos').empty();//Limpia la tabla
			}
			else
			{
				$.getJSON("<?php echo site_url('controlador_inicio/consulta_maestro_materia/');?>?id_maestro="+id_maestro,function(respuesta_json)
				{
					$('#tabla').empty();//Limpia la tabla				
					//Activo el botón guardar
					$("#guarda").attr("disabled",false);
					//Respuesta de la consulta
					if(respuesta_json!=false)
					{						
						//Agregar el encabezado de la tabla
						cad2="<thead><tr><th><center>Siglema</center></th><th><center>Módulo</center></th><th width='40px'>Agregar</th></tr></thead>";
						$('#tabla').append(cad2);					
						//Agregar los resultados en el resto de la tabla
						cad="";
						for (var i=0;i<respuesta_json.length;i++)
						{
							var cad="<tr><td><center>"
							+respuesta_json[i].Clave_materia
							+"</center></td><td>"+respuesta_json[i].Nombre_materia
							+"</td><td><center>"
							+"<input type='checkbox' value="+respuesta_json[i].idMateria+" name='materias_recomendacion[]' class='grupo'>"
							+"</center></td></tr>";						
							$('#tabla').append(cad);
						}						
					}	
				});
				getDatos_dos(); //Mando llamar el método para que llene la segunda tabla
			}			
		}

		//Obtiene los datos y los va agregando a la tabla_dos
		function getDatos_dos()
		{
			id_maestro=$('#maestros').val();
			$.getJSON("<?php echo site_url('controlador_inicio/consulta_maestro_materia_resto/');?>?id_maestro="+id_maestro,function(respuesta_json)
			{
				$('#tabla_dos').empty();//Limpia la tabla				
				//Activo el botón guardar
				$("#guarda").attr("disabled",false);
				//Respuesta de la consulta
				if(respuesta_json!=false)
				{						
					//Agregar el encabezado de la tabla
					cad2="<thead><tr><th><center>Siglema</center></th><th><center>Módulo</center></th><th width='40px'>Agregar</th></tr></thead>";
					$('#tabla_dos').append(cad2);					
					//Agregar los resultados en el resto de la tabla
					cad="";
					for (var i=0;i<respuesta_json.length;i++)
					{
						var cad="<tr><td><center>"
						+respuesta_json[i].Clave_materia
						+"</center></td><td>"+respuesta_json[i].Nombre_materia
						+"</td><td><center>"
						+"<input type='checkbox' value="+respuesta_json[i].idMateria+" name='materias_resto[]' class='grupo'>"
						+"</center></td></tr>";						
						$('#tabla_dos').append(cad);
					}						
				}
				
			});
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
					  <strong>¡Error!</strong> Complete correctamente el registro, seleccione los módulos que desea asociar al prestador de servicios profesionales.
					</div>
				<?php
			}
		?>		
		<!--Form group de los semestres-->
		<div class="form-group">			
			<form id="form" action="<?php echo site_url('controlador_registrar/guarda_maestro_puede_materia');?>" method="post">
				<h4 class="text-center"><strong>ASIGNAR MAESTRO-MATERIA</strong></h4>
				<label for="nombre">Maestros</label>
				<select class="form-control required" id="maestros" onchange="getDatos();" name="id_maestro">
					<?php
						
						if($id_maestro==null){
						   ?> 
						   <option value="0" selected="true">SELECCIONE UN MAESTRO</option>						  
						   <?php
						}
						else
						{
							?> 
						   <option value="0">SELECCIONE UN MAESTRO</option>
							<?php
						}
					?>						
					<?php
						foreach ($maestros as $maestros)
							if($id_maestro==$maestros->idMaestro)
							{
								echo '<option value="'.$maestros->idMaestro.'" selected>'.$maestros->Nombre.'</option>';								
							}
							else{
								echo '<option value="'.$maestros->idMaestro.'">'.$maestros->Nombre.'</option>';	
							}					
					?>
				</select>
				</br>
				<div class="panel panel-warning"> 
				  <div class="panel-heading">
				 	 <h3 class="panel-title"><strong>Módulos recomendados para el prestador de servicios profesionales</strong></h3>
				  </div>
				  	<div class="panel-body">
				    	<p>En esta tabla se muestran todos los módulos que se recomiendan para que los imparta el prestador de servicios profesionales, 
				    	   la selección de los módulos se seleccionan dependiendo de su especialidad.</p>
				  	</div>
					<table id="tabla" name="tabla" class="table table-striped table-bordered table-responsive table-condensed table-hover">					
					</table>
				</div>

				<div class="panel panel-success"> 
				  <div class="panel-heading">
				 	 <h3 class="panel-title"><strong>Resto de los módulos</strong></h3>
				  </div>
				  	<div class="panel-body">
				    	<p>En esta tabla se muestran todos los módulos disponibles para ser asignados al prestador de servicios profesionales.</p>
				  	</div>
					<table id="tabla_dos" name="tabla_dos" class="table table-striped table-bordered table-responsive table-condensed table-hover">					
					</table>
				</div>	
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