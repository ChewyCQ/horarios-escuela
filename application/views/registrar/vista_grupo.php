<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra grupo</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
  		<div class="form-group">
  			<?php
  				if($idGrupo!=null)
	  			{
	  				?>
	  				<form action="<?php echo site_url('controlador_actualizar/actualiza_grupo');?>?id=<?php echo $idGrupo?>" method="post">
	  				<?php
				}
				else
				{
					?>
					<form action="<?php echo site_url('controlador_registrar/guarda_grupo');?>" method="post">
	  				<?php
	  			}		
	  		?>  			
		    	<label for="generacion">Generación</label>
				<input type="text" class="form-control" id="generacion" value="<?php echo $Generacion ?>" placeholder="N° de la generación" name="generacion" required pattern="([0-9]{1,4})$" oninput="check(this)">
				<label for="generacion">Clave</label>
				<input type="text" class="form-control" id="clave" value="<?php echo $Clave ?>" placeholder="Clave del grupo" name="clave" required pattern="([áéíóúÁÉÍÓÚñÑa-zA-Z0-9\s]{1,20})*$" oninput="check(this)">
				<label for="semestre">Semestre</label>
				<select class="form-control" name="id_semestre">
					<?php
					foreach ($semestres as $i => $semestres)
						if($idSemestre==$semestres->idSemestre)
						{
							echo '<option value="'.$semestres->idSemestre.'" selected>'.$semestres->Numero_semestre.'</option>';
						}
						else{
							echo '<option value="'.$semestres->idSemestre.'">'.$semestres->Numero_semestre.'</option>';
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