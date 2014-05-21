<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra alumno</title>
	<?php $this->load->view('comunes/validaciones'); ?>
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
						email: "<font color='red'>Ingrese un email correcto</font>"
					}
				},

			});
		});
	</script>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
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

				<button type="submit" class="btn btn-default">Enviar</button>
			</form>
		</div>
	</div>
	<script src="<?php echo base_url().BOOTSTRAP_JS?>"></script>   
</body>
</html>