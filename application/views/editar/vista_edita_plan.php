<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Editar planes</title>

	<!--Para cargar los script, usados para generar la tabla y poner botones de exportar-->
	<?php $this->load->view('comunes/tabla_exportar_editar'); ?>

	<script type="text/javascript" language="javascript" class="init">
		$(document).ready(function() {
			$('#tabla').dataTable({
				"aoColumnDefs": [{ "bSortable": false, "aTargets": [2]}],
				dom: 'T<"clear">lfrtip', //Para colocar que exporte en pdf o xls
				tableTools: {
					"sSwfPath": "<?php echo base_url()?>assets/TableTools/swf/copy_csv_xls_pdf.swf",
					"aButtons": 
					[
		                {
		                    "sExtends": "xls",
		                    "sButtonText": "<img src='<?php echo base_url()?>assets/TableTools/images/excel.png'  width='32' height='32' border=0 />",
		                    "mColumns": [0,1]
		                },
		                {
		                    "sExtends": "pdf",
		                    "sButtonText": "<img src='<?php echo base_url()?>assets/TableTools/images/pdf2.png'  width='32' height='32' border=0 />",
		                   	"mColumns": [0,1]
		                }
		            ]
				}
			});
		} );
		//{"aoColumnDefs": [{ "bSortable": false, "aTargets": [1]}]} Desactiva el descendente o ascendente en la columna especificada
	</script>

</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">
		<div class="form-group"> 
		<div class="table-responsive">
  				<table id="tabla" class="display" cellspacing="0" width="100%">
  					<thead>
	  					<tr>
	  						<th><center>Nombre del plan</center></th>
	  						<th><center>Carrera asociada</center></th>
							<th width="40px">Opción</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						if (count($planes)>0)
						{
							foreach ($planes as $planes)
							{								
								echo "<tr>";
								echo "<td class='success' height='100%'>".$planes->Nombre_plan."</td>";
								echo "<td class='success' height='100%'>".$planes->Nombre_carrera."</td>";
								echo "<td class='success' align='center' height='100%'>";
								?>
								<form action="<?php echo site_url('controlador_inicio/plan');?>?id=<?php echo $planes->idPlan?>" method="post"> <!--Envía el id del dato que se modificará-->
								<?php
								echo "<button type='input' class='btn btn-primary btn-sm' title='Editar registro'><span class='glyphicon glyphicon-edit'></span></button>"; 
								?>
								</form>		
		                    	<?php
								echo "</td></tr>";							
		                	}
					 	} 							
	                ?>
	                </tbody>
  				</table>
  			</div>
  			</div>
	</div>
	<script src="<?php echo base_url().BOOTSTRAP_JS?>"></script>  
</body>
</html>