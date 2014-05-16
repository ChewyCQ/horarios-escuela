<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra grupo</title>
	<script type="text/javascript" src="<?php echo base_url()?>assets/jquery.min.js"></script>
	<script>
		$(document).on('ready',function(){
			getSemestres(); //Al iniciar la carga de la vista muestra los resultados dependiendo del que este seleccionado
			//$('#semestres').change(getSemestres);
		});
		//Función para cargar el select de los semestres, dependiedo de la carrera que se seleccione
		function getSemestres()
		{
			id_carrera=$('#carreras').val();
			$.getJSON('<?php echo base_url()?>index.php/controlador_inicio/consulta_carrera_semestre/'+id_carrera,function(respuesta_json)
			{
				$('#semestres').empty();//Limpia el select
				$.each(respuesta_json, function(index,datos){
					option=$('<option></option>',{
						value: datos.idSemestre,
						text: datos.Numero_semestre,
						class: 'clase'
					});
					$('#semestres').append(option);
				});
			});
		}
	</script>
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
				
				<label for="carrera">Carreras</label>
				<select class="form-control" id="carreras" onchange="getSemestres();">
					<?php
					foreach ($carreras as $i => $carreras)
						echo '<option value="'.$carreras->idCarrera.'">'.$carreras->Nombre_carrera.'</option>';
					?>
				</select>

				<label for="semestre">Semestre</label>
				<select class="form-control" id="semestres" name="id_semestre"></select>
				<br/>
				<button type="submit" class="btn btn-default">Enviar</button>
			</form>
		</div>
	</div>
  <?php $this->load->view('comunes/footer'); ?>    
</body>
</html>