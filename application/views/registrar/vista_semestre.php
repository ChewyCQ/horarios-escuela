<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra semestre</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
  		<div class="form-group">
	  		<?php
	  			if($idSemestre!=null)
		  		{
		  			?>
		  			<form action="<?php echo site_url('controlador_actualizar/actualiza_semestre');?>?id=<?php echo $idSemestre?>" method="post">
		  			<?php
				}
				else
				{
					?>
					<form action="<?php echo site_url('controlador_registrar/guarda_semestre');?>" method="post">
		  			<?php
		  		}		
		  	?>
		  	<label for="numero">Número del semestre</label>
			<input type="text" class="form-control" id="numero_semestre" placeholder="N° Semestre" name="numero_semestre" required pattern="([0-9]{1,2})$" oninput="check(this)" value="<?php echo $Numero_semestre?>">
			<label for="plan">Plan</label>
			<select class="form-control" name="id_plan">
				<?php
					foreach ($planes as $i => $plan)
						if($idPlan==$plan->idPlan)
						{
							echo '<option value="'.$plan->idPlan.'" selected>'.$plan->Nombre_plan.'</option>';
						}
						else{
							echo '<option value="'.$plan->idPlan.'">'.$plan->Nombre_plan.'</option>';
						}					   
				?>
			</select>
			<br/>
			<button type="submit" class="btn btn-default">Enviar</button>
		</div>
	</div>
	<?php $this->load->view('comunes/footer'); ?>    
</body>
</html>