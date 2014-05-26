<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Editar áreas</title>

	<!--DataTable-->
	<link href="<?php echo base_url()?>assets/datatable/css/jquery.dataTables.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url()?>assets/datatable/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/datatable/js/jquery.dataTables.js"></script>
	<!--Para los botones de exportar-->
	<link href="<?php echo base_url()?>assets/TableTools/css/dataTables.tableTools.css" rel="stylesheet">	
	<script type="text/javascript" src="<?php echo base_url()?>assets/TableTools/js/dataTables.tableTools.js"></script>

	<script type="text/javascript" language="javascript" class="init">
		$(document).ready(function() {
			$('#tabla').DataTable({
				"aoColumnDefs": [{ "bSortable": false, "aTargets": [1]}],
				dom: 'T<"clear">lfrtip',
				tableTools: {
					"sSwfPath": "<?php echo base_url()?>assets/TableTools/swf/copy_csv_xls_pdf.swf",
					"aButtons": 
					[
		                {
		                    "sExtends": "xls",
		                    "sButtonText": "<img src='<?php echo base_url()?>assets/TableTools/images/excel.png'  width='32' height='32' border=0 />",
		                    "mColumns": [0]
		                },
		                {
		                    "sExtends": "pdf",
		                    "sButtonText": "<img src='<?php echo base_url()?>assets/TableTools/images/pdf2.png'  width='32' height='32' border=0 />",
		                   	"mColumns": [0]
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
	  						<th><center>Áreas de formación</center></th>
							<th width="40px">Opción</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						if (count($areas)>0)
						{
							foreach ($areas as $areas)
							{								
								echo "<tr>";
								echo "<td class='success' height='100%'>".$areas->Nombre_especialidad."</td>";
								echo "<td class='success' align='center' height='100%'>";
								?>
								<form action="<?php echo site_url('controlador_inicio/especialidad');?>?id=<?php echo $areas->idEspecialidad?>" method="post"> <!--Envía el id del dato que se modificará-->
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