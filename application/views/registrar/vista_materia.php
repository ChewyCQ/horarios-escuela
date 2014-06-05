<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
    <!--Para usar el autocompletar-->
    <?php $this->load->view('comunes/autocompletar'); ?>
    <!--Para usar las validaciones-->
    <?php $this->load->view('comunes/validaciones'); ?>
<head>
	<title>Materia</title>
	<script type="text/javascript">
		$(function(){
			$('#form').validate({
				rules:{
					nombre_materia: {
						required: true,
						maxlength: 150,
						solo_letras:true
					},
					clave_materia: {
						required: true,
						maxlength: 8,
						tipo_siglema: true
					}
				},
				messages:{
					nombre_materia: {
						required: "<font color='red'>Campo obligatorio</font>",
						maxlength: "<font color='red'>El nombre de la materia debe tener un máximo de 150 caracteres</font>",
						solo_letras: "<font color='red'>Solo se aceptan letras</font>"
					},
					clave_materia: {
						required: "<font color='red'>Campo obligatorio</font>",
						maxlength: "<font color='red'>El siglema debe tener un máximo de 8 caracteres</font>",
						tipo_siglema: "<font color='red'>Solo se permiten letras, números y un guion. Ejemplo(CAEP-00)</font>"
					}
				}

			});
		});
	</script>

	<script>
		function agrega_fila()
		{
			var opcion_seleccionada = $('#especialidad option:selected').text();
			var id = $('#especialidad').val();
			var i=('td').length;
			//Agrego el input a cada columna, para almacenar los id de cada especialidad y así poder recuperarlos para ser guardados
		    var cad="<tr><td><input name='especialidades[]' value='"+id+"' type='hidden'>"+opcion_seleccionada+"</td><td width='40px'><button type='button' onclick='elimina_fila(this);' class='btn btn-primary btn-sm' title='Eliminar'><span class='glyphicon glyphicon-remove'></span></button></td></tr>";
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
		  $("#nombre_materia").autocomplete({
		    source: "<?php echo site_url('controlador_buscar/get_materias');?>"
		  });
		});
	</script>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<?php
			if($idMateria!=null)
			{
				?><legend>Editar materia</legend><?php
			}
			else
			{
				?><legend>Nueva materia</legend><?php
			}
		?>			
  		<div class="form-group">
  			<?php
  				if($idMateria!=null)
	  			{
	  				?>
	  				<form id="form" action="<?php echo site_url('controlador_actualizar/actualiza_materia');?>?id=<?php echo $idMateria?>" method="post">
	  				<?php
				}
				else
				{
					?>
					<form id="form" action="<?php echo site_url('controlador_registrar/guarda_materia');?>" method="post">
	  				<?php
	  			}		
	  		?>
	  		<label for="clave">Siglema/Clave</label>
			<input type="text" class="form-control required" id="clave_materia" placeholder="Siglema del módulo" 
			name="clave_materia"  value="<?php echo $Clave_materia ?>">
			</br>	  		
	  		<label for="nombre">Nombre de la materia</label>
			<input type="text" class="form-control required" id="nombre_materia" placeholder="Nombre materia" 
			name="nombre_materia"  value="<?php echo $Nombre_materia ?>">
			</br>
			<label for="tipo_materia">Tipo de materia</label>
			<!--Código para verificar cual dato del combo esta seleccionado-->
			<?php
				$sel0 = "";
				$sel1 = "";
				$sel2 = "";
				$sel3 = "";
				$sel4 = "";
				if($Tipo_materia == 0){
				    $sel0 = "selected";
				}
				if($Tipo_materia == 1){
				    $sel1 = "selected";
				}
				if($Tipo_materia == 2){
					$sel2 = "selected";
				}
				if($Tipo_materia == 3){
					$sel3 = "selected";
				}
				if($Tipo_materia == 4){
					$sel4 = "selected";
				}
			?>
			<select class="form-control" name="tipo_materia">
			  <option value="0" <?php echo $sel0;?> >Núcleo de Formación Básica</option>
			  <option value="1" <?php echo $sel1;?> >Núcleo de Formación Profesional</option>
			  <option value="2" <?php echo $sel2;?> >Trayectos Técnicos</option>
			  <option value="3" <?php echo $sel3;?> >Trayectos Propedéuticos</option>
			  <option value="4" <?php echo $sel4;?> >Otro</option>
			</select>
			</br>

			<?php
  				if($idMateria!=null) //Si se va a agregar una materia idMateria=null y carga las opciones para agregar especialidades
	  			{
	  				?>
					<div class="row">
						<div class="col-xs-12">
							<div class="panel panel-danger"> 
							  <div class="panel-heading">
							  	<h3 class="panel-title"><strong>Especialidades asociadas a la materia</strong></h3>
							  </div>
							  <div class="panel-body">
							    <p>En esta tabla se muestran todas las especialidades que están asociadas a la materia que se está editando, 
							    si desea borrar una especialidad solamente márquela en su casilla correspondiente. 
							    Si no hay especialidades asociadas podrá agregarlas en la tabla de abajo.</p>
							  </div>
							<table class="table table-striped table-bordered table-responsive table-condensed table-hover">
								<thead>
								<tr>		  						
			  						<th><center>Especialidad</center></th>
									<th width="40px">Elimina</th>
								</tr>
								</thead>
								<tbody>
								<?php 
									if (is_array($materiaEspecialidad))
									{
										foreach ($materiaEspecialidad as $i => $materiaEspecialidad)
										{								
											echo "<tr>";										
											echo "<td class='text-center'>".$materiaEspecialidad->Nombre_especialidad."</td>";
											echo "<td class='text-center'>";
											echo "<input type='checkbox' value=".$materiaEspecialidad->idEspecialidad." name='materia_especialidad[]' class='grupo'>"; 
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
			  <div class="panel-heading">
			 	 <h3 class="panel-title"><strong>Asociar áreas de formación a la materia</strong></h3>
			  </div>
			  <div class="panel-body">
			    <p>En esta tabla se muestran las áreas de formación/especialidades que se desea asociar a la materia.</p>
			  </div>
				<table id="tabla" name="tabla" class="table table-striped table-bordered table-responsive table-condensed table-hover">
				   
				</table>
			</div>
			<label for="especialidad">Especialidad</label>
			<div class="row">
				<div class="col-lg-9">
					<select class="form-control" id="especialidad">
						<?php
						foreach ($especialidades as $i => $especialidad)
							echo '<option value="'.$especialidad->idEspecialidad.'">'.$especialidad->Nombre_especialidad.'</option>';	
						?>
					  </select>
				</div>
				<div class="col-lg-3" align="right">
					<button type="button" class="btn btn-info" title="Agregar" onclick="agrega_fila();">Agregar área <span class='glyphicon glyphicon-plus-sign'></span></button>
				 </div>
			</div>
			</br>
				<div align="right">
					<button type="submit" class="btn btn-primary btn-lg" title="Guardar"><span class='glyphicon glyphicon-floppy-save'></span></button>
					<?php
						if($idMateria==null)
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