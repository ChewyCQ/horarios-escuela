<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Registra grupo</title>
	<script type="text/javascript" src="<?php echo base_url()?>assets/jquery.min.js"></script>
	<script>
		$(document).on('ready',function(){
			//getPlanes(); //Al iniciar la carga de la vista muestra los resultados dependiendo del que este seleccionado		   
		    $("#semestres").attr("disabled",true);
		    $("#planes").attr("disabled",true);
		});
		//Función para cargar el select de los planes, dependiedo de la carrera que se seleccione
		function getPlanes()
		{
			id_carrera=$('#carreras').val();
			$("#planes").attr("disabled",false); //Habilito el combo	
			$('#semestres').empty();//Limpia el select
			$("#semestres").attr("disabled",true); //Desactivo el combo		
			$.getJSON('<?php echo base_url()?>index.php/controlador_inicio/consulta_carrera_plan/'+id_carrera,function(respuesta_json)
			{
				if(respuesta_json!=false)
				{
					$('#planes').empty();//Limpia el select
					cad="<option value='0' selected>Seleccione una opción</option>";
					$('#planes').append(cad);
					$.each(respuesta_json, function(index,datos){
						option=$('<option></option>',{
							value: datos.idPlan,
							text: datos.Nombre_plan
						});
						$('#planes').append(option);
					});
				}
				else
				{	
					$("#planes").attr("disabled",true); //Desactivo el combo
					$("#semestres").attr("disabled",true); //Desactivo el combo
					$('#planes').empty();//Limpia el select	
					$('#semestres').empty();//Limpia el select
					cad1="<option value='0'>No hay planes asociados</option>";
					$('#planes').append(cad1);
					cad2="<option value='0'>No hay semestres asociados</option>";
					$('#semestres').append(cad2);
				}
				
			});
		}
		//Función para cargar el select de los semestres, dependiedo del plan que se seleccione
		function getSemestres(id_plan)
		{
			id_plan=$('#planes').val();
			$("#semestres").attr("disabled",false);
			$.getJSON('<?php echo base_url()?>index.php/controlador_inicio/consulta_carrera_semestre/'+id_plan,function(respuesta_json)
			{
				if(respuesta_json!=false)
				{
					$('#semestres').empty();//Limpia el select			
					$.each(respuesta_json, function(index,datos){
						option=$('<option></option>',{
							value: datos.idSemestre,
							text: datos.Numero_semestre
						});
						$('#semestres').append(option);
					});
				}
				else
				{
					$("#semestres").attr("disabled",true);
					$('#semestres').empty();//Limpia el select	
					cad="<option value='0'>No hay semestres asociados</option>";
					$('#semestres').append(cad);
				}
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
				<select class="form-control" id="carreras" onchange="getPlanes();" name="id_carrera">
					<option value="0" selected="selected">Seleccione una opción</option>
					<?php
					foreach ($carreras as $i => $carreras)
						echo '<option value="'.$carreras->idCarrera.'">'.$carreras->Nombre_carrera.'</option>';
					?>
				</select>

				<label for="planes">Planes</label>
				<select class="form-control" id="planes" onchange="getSemestres();" name="id_plan"></select>

				<label for="semestres">Semestres</label>
				<select class="form-control" id="semestres" name="id_semestre"></select>

				<label for="carrera">Turno</label>
				<select class="form-control" id="turno" name="turno">
					<option value="1">Matutino</option>
					<option value="2">Vespertino</option>
				</select>

				<br/>
				<button type="submit" class="btn btn-default">Enviar</button>
			</form>
		</div>
	</div>
  <?php $this->load->view('comunes/footer'); ?>    
</body>
</html>