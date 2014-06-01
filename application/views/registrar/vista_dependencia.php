<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
     <!--Para usar el autocompletar-->
    <?php $this->load->view('comunes/autocompletar'); ?>
    <!--Para usar las validaciones-->
    <?php $this->load->view('comunes/validaciones'); ?>
<head>
	<title>Dependencia</title>
	<script type="text/javascript">
		$(function(){
			$('#form').validate({
				rules:{
					nombre: {
						required: true,
						maxlength: 70,
						solo_letras:true
					},
					cantidad: {
						required: true,
						digits: true
					}
				},
				messages:{
					nombre: {
						required: "<font color='red'>Campo obligatorio</font>",
						maxlength: "<font color='red'>El nombre de la dependencia debe tener un máximo de 70 caracteres</font>",
						solo_letras: "<font color='red'>Sólo se aceptan letras</font>"
					},
					cantidad: {
						required: "<font color='red'>Campo obligatorio</font>",
						digits: "<font color='red'>Sólo se aceptan números, sin espacios</font>"
					}
				},

			});
		});
	</script>

	<script>
		function agrega_fila()
		{
			var opcion_seleccionada = $('#maestro option:selected').text();
			var id = $('#maestro').val();
			var i=('td').length;
			//Agrego el input a cada columna, para almacenar los id de cada especialidad y así poder recuperarlos para ser guardados
		    var cad="<tr><td><input name='maestros[]' value='"+id+"' type='hidden'>"+opcion_seleccionada+"</td><td width='40px'><button type='button' onclick='elimina_fila(this);' class='btn btn-primary btn-sm' title='Eliminar'><span class='glyphicon glyphicon-remove'></span></button></td></tr>";
		    $('#tabla').append(cad);
		}
		// Evento que selecciona la fila y la elimina 
 		function elimina_fila(boton)
  		{
    		$(boton).parent().parent().remove();
  		}
	</script>
	<!--Autocompletado-->
	<script type="text/javascript">
		$(function(){
		  $("#nombre").autocomplete({
		    source: "<?php echo site_url('controlador_buscar/get_dependencias');?>"
		  });
		});
	</script>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<?php
			if($idDependencia!=null)
			{
				?><legend>Editar dependencia</legend><?php
			}
			else
			{
				?><legend>Nueva dependencia</legend><?php
			}
		?>			
  		<div class="form-group">
  			<?php
  				if($idDependencia!=null)
	  			{
	  				?>
	  				<form id="form" action="<?php echo site_url('controlador_actualizar/actualiza_dependencia');?>?id=<?php echo $idDependencia?>" method="post">
	  				<?php
				}
				else
				{
					?>
					<form id="form" action="<?php echo site_url('controlador_registrar/guarda_dependencia');?>" method="post">
	  				<?php
	  			}		
	  		?>
  			
	  			<label for="nombre">Nombre de la dependencia</label>
				<input type="text" class="form-control required" id="nombre" placeholder="Nombre" value="<?php echo $Nombre ?>" name="nombre">
				</br>
				<label for="numero">Cantidad máxima de alumnos que acepta</label>
				<input type="text" class="form-control required" id="cantidad" value="<?php echo $CantidadMaxAlumnos?>" placeholder="Cantidad de alumnos Campo Clínico" name="cantidad">
				<br/>
				<?php
	  				if($idDependencia!=null) //Si se va a agregar una materia idMateria=null y carga las opciones para agregar especialidades
		  			{
		  				?>
						<div class="row">
							<div class="col-xs-12">
								<div class="panel panel-danger"> 
								  <div class="panel-heading">Maestros asociados a este campo</div>
								  <div class="panel-body">
								    <p>En esta tabla se muestran todos los maestros que están asociadas a la dependencia que se está editando, 
								    si desea borrar un maestro solamente márquelo en su casilla correspondiente. 
								    Si no hay maestros asociados podrá agregarlos en la tabla de abajo.</p>
								  </div>
								<table class="table table-striped table-bordered table-responsive table-condensed table-hover">
									<thead>
									<tr>		  						
				  						<th><center>Maestro</center></th>
										<th width="40px">Elimina</th>
									</tr>
									</thead>
									<tbody>
									<?php 
										if (is_array($maestro_campo))
										{
											foreach ($maestro_campo as $maestro_campo)
											{								
												echo "<tr>";										
												echo "<td class='text-center'>".$maestro_campo->Nombre."</td>";
												echo "<td class='text-center'>";
												echo "<input type='checkbox' value=".$maestro_campo->idMaestro." name='maestro_campo[]' class='grupo'>"; 
												echo "</td></tr>";							
						                	}
									 	} 							
					                ?>
					                </tbody>
			  					</table>
			  					</div>
							</div>
						</div>
						<?php
					}	
				?>
				<div class="panel panel-primary"> 
				  <div class="panel-heading">Agregar maestros</div>
				  <div class="panel-body">
				    <p>En esta tabla se muestran los maestros que se desea asociar a la dependencia.</p>
				  </div>
					<table id="tabla" name="tabla" class="table table-striped table-bordered table-responsive table-condensed table-hover">
					   
					</table>
				</div>
				<label for="especialidad">Maestros</label>
				<div class="row">
					<div class="col-lg-10">
						<select class="form-control" id="maestro">
							<?php
							foreach ($maestros as $i => $maestros)
								echo '<option value="'.$maestros->idMaestro.'">'.$maestros->Nombre.'</option>';	
							?>
						  </select>
					</div>
					<div class="col-lg-2" align="right">						
						<button type="button" class="btn btn-info" title="Agregar" onclick="agrega_fila();">Agregar maestro <span class='glyphicon glyphicon-plus-sign'></span></button>
					 </div>
				</div>
				</br>
				<div align="right">
					<button type="submit" class="btn btn-primary btn-lg" title="Guardar"><span class='glyphicon glyphicon-floppy-save'></span></button>
					<?php
						if($idDependencia==null)
						{
							?><button type="reset" class="btn btn-success btn-lg" title="Limpiar formulario"><span class='glyphicon glyphicon-refresh'></span></button><?php
						}
					?>					
					<button type="button" class="btn btn-danger btn-lg" title="Cancelar" onclick="window.location.href='<?php echo site_url('controlador_inicio/index');?>'"><span class='glyphicon glyphicon-floppy-remove'></span></button>
				</div>
			</form>
		</div>
	</div>
	<script src="<?php echo base_url().BOOTSTRAP_JS?>"></script>     
</body>
</html>