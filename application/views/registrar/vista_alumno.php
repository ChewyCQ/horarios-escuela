<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
     <!--Para usar el autocompletar-->
    <?php $this->load->view('comunes/autocompletar'); ?>
    <!--Para usar las validaciones-->
    <?php $this->load->view('comunes/validaciones'); ?>
<head>
	<title>Alumno</title>
	<script type="text/javascript">
		$(function(){
			$('#form').validate({
				rules:{
					nombre: {
						required: true,
						maxlength: 150,
						nombre_persona: true
					},
					email: {
						email: true
					}
				},
				messages:{
					nombre: {
						required: "<font color='red'>Campo obligatorio</font>",
						maxlength: "<font color='red'>El nombre del alumno debe tener máximo 150 caracteres</font>",
						nombre_persona: "<font color='red'>El nombre debe tener solo letras y máximo un punto (No punto al final)</font>"
					},
					email: {
						email: "<font color='red'>Sólo se aceptan correos electrónicos, sin espacios</font>"
					}
				},

			});
		});
	</script>
	<!--Autocompletado-->
	<script type="text/javascript">
		$(function(){
		  $("#nombre_alumno").autocomplete({
		    source: "<?php echo site_url('controlador_buscar/get_alumnos');?>"
		  });
		});
	</script>	
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<?php
			if($idAlumno!=null)
			{
				?><legend>Editar alumno</legend><?php
			}
			else
			{
				?><legend>Nuevo alumno</legend><?php
			}
		?>			
  		<div class="form-group">
  			<?php
  				if($idAlumno!=null)
	  			{
	  				?>
	  				<form id="form" action="<?php echo site_url('controlador_actualizar/actualiza_alumno');?>?id=<?php echo $idAlumno?>" method="post">
	  				<?php
				}
				else
				{
					?>
					<form id="form" action="<?php echo site_url('controlador_registrar/guarda_alumno');?>" method="post">
	  				<?php
	  			}		
	  		?>
	  			<label for="nombre">Nombre del Alumno</label>
				<input type="text" class="form-control required" id="nombre_alumno" value="<?php echo $Nombre ?>" placeholder="Nombre" name="nombre">
				</br>
				<label for="email">Email</label>
			    <input type="email" class="form-control" id="email" value="<?php echo $Correo ?>" placeholder="Introduce tu email" name="email">
				</br>
				<label for="clave">Clave del grupo</label>
				<select class="form-control" name="id_grupo">
					<?php
					foreach ($grupos as $i => $grupos)
						if($idGrupo==$carrera->idGrupo)
						{
							echo '<option value="'.$grupos->idGrupo.'" selected>'.$grupos->Clave.'</option>';
						}
						else{
							echo '<option value="'.$grupos->idGrupo.'">'.$grupos->Clave.'</option>';
						}						   
					?>
				</select>
				<br/>
				<div align="right">
					<button type="submit" class="btn btn-primary btn-lg" title="Guardar"><span class='glyphicon glyphicon-floppy-save'></span></button>
					<?php
						if($idAlumno==null)
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