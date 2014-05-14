<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra alumno</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
  		<div class="form-group">
  			<?php
  				if($idAlumno!=null)
	  			{
	  				?>
	  				<form action="<?php echo site_url('controlador_actualizar/actualiza_alumno');?>?id=<?php echo $idAlumno?>" method="post">
	  				<?php
				}
				else
				{
					?>
					<form action="<?php echo site_url('controlador_registrar/guarda_alumno');?>" method="post">
	  				<?php
	  			}		
	  		?>
	  			<label for="nombre">Nombre del Alumno</label>
				<input type="text" class="form-control" id="nombre_maestro" value="<?php echo $Nombre ?>" placeholder="Nombre" name="nombre" required pattern="<?php echo PATRON_NOMBRE_PERSONA; ?>" oninput="check(this)">
				<label for="email">Email</label>
			    <input type="email" class="form-control" id="email" value="<?php echo $Correo ?>" placeholder="Introduce tu email" name="email" required pattern="<?php echo PATRON_CORREO; ?>">
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

	<?php $this->load->view('comunes/footer'); ?>    
</body>
</html>