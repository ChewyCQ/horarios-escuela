<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra materia</title>
	<script type="text/javascript" src="<?php echo base_url()?>assets/jquery1.3.2.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){ 
			//Checkbox
			$("input[name=checktodos]").change(function(){
				$('input[type=checkbox]').each( function() {			
					if($("input[name=checktodos]:checked").length == 1){
						this.checked = true;
					} else {
						this.checked = false;
					}
				});
			});
		 
		});
	</script>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<!--Form group de los semestres-->
		<div class="form-group">
			<form action="<?php echo site_url('controlador_registrar/guarda_materia_semestre');?>" method="post">
				<h4 class="text-center"><strong>ASIGNAR MATERIA-SEMESTRE</strong></h4>
				<label for="nombre">Nombre de la materia</label>
				<select class="form-control" name="id_materia">
					<?php
						foreach ($materias as $materias)
							echo '<option value="'.$materias->idMateria.'">'.$materias->Nombre_materia.'</option>';	
					?>
				</select>
				<div class="row">
					</br>
					<div class="col-xs-12">
						<table id="tabla" class="table table-condensed table-hover table-bordered">
							<tr>
		  						<th><center>Semestre</center></th>
		  						<th><center>Plan</center></th>
		  						<th><center>Carrera</center></th>
								<th width="40px"><input name="checktodos" type="checkbox" /></th>
							</tr>
							<?php 
								if (count($semestres)>0)
								{
									foreach ($semestres as $semestres)
									{								
										echo "<tr>";
										echo "<td class='success' height='100%'>".$semestres->Numero_semestre."</td>";
										echo "<td class='success' height='100%'>".$semestres->Nombre_plan."</td>";
										echo "<td class='success' height='100%'>".$semestres->Nombre_carrera."</td>";
										echo "<td class='success' align='center' height='100%'>";
										echo "<input type='checkbox' value=".$semestres->idSemestre." name='semestres[]' class='grupo'>"; 
										echo "</td></tr>";							
				                	}
							 	} 							
			                ?>
	  					</table>

					</div>
				</div>
				<label for="horas">Horas por semana</label>
				<input type="text" class="form-control" id="horas" placeholder="Horas a la semana" name="horas" required pattern="([0-9]{1,2})$" oninput="check(this)">
				<br/>	
				<button type="submit" class="btn btn-default">Enviar</button>	
			</form>
		</div>
	</div>
	<?php $this->load->view('comunes/footer'); ?>    
</body>
</html>