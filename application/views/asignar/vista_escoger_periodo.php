<!DOCTYPE html>
<html>
<?php $this->load->view('comunes/header'); ?>
<head>
	<title>Horarios</title>
</head>
<body>
	<?php $this->load->view('comunes/nav'); ?>
	<div class="container">

		<?php 
			$form = array(
				'class' => 'form-horizontal' 
				);
		?>

		<?php echo form_open('controlador_asignar/escoger_grupo_del_periodo_a_asignar', $form); ?>
			<fieldset>
				<legend>Ciclo escolar a asignar horarios</legend>

				<div class="form-group">
					<label class="col-md-4 control-label" for="id_periodo">Periodos escolares del año</label>
					<div class="col-md-3">
						<select id="id_periodo" name="id_periodo" class="form-control">
							<?php 
							foreach ($periodos as $periodo) {
								echo "<option value='{$periodo['idPeriodo']}'>{$periodo['Periodo']}</option>";
							}
							?>
						</select>
					</div>
				</div>

				<!-- <div class="form-group"> -->
					<label class="col-md-4 control-label" for="enviar"></label>
					<div class="col-md-4">
						<button id="enviar" class="btn btn-primary">Seleccionar</button>
					</div>
				<!-- </div> -->

			</fieldset>
		</form>

		<?php $this->load->view('comunes/footer'); ?>  
		<script src="<?php echo base_url().SCRIPTS ?>"></script>
	</div>
</body>
</html>