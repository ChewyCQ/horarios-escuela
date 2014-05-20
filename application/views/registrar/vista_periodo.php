<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Nuevo ciclo escolar</title>
</head>
<body>
    <?php $this->load->view('comunes/nav'); ?>
    <div class="container">

    <!-- Form Name -->
    <legend>Nuevo ciclo escolar</legend>
    <div class="form-group">
      <?php echo form_open('controlador_inicio/validar_ciclo'); ?>

		<label for="clave">Clave o nombre del semestre</label>
    <input type="text" class="form-control" id="clave" required value="" placeholder="nombre de referencia para el semestre" name="clave" pattern="<?php echo PATRON_TEXTO_CASI_LIBRE; ?>" title="<?php echo TITLE_TEXTO_CASI_LIBRE ?>">
    <br/>

    <label for="anio">Año</label>
    <select id="anio" name="anio" class="form-control">
      <option value="<?php echo date("Y") ?>"><?php echo date("Y") ?></option>
      <option value="<?php echo date("Y")+1 ?>"><?php echo date("Y")+1 ?></option>
    </select>
    <br/>

    <label for="semestre">Semestre</label>
    <select id="semestre" name="semestre" class="form-control">
      <option value="0">enero - junio</option>
      <option value="1">agosto - diciembre</option>
    </select>
    <br/>

		<button type="submit" class="btn btn-default btn-lg" title="Guardar"><span class='glyphicon glyphicon-floppy-save'></button>
		</form>

  	<?php $this->load->view('comunes/footer'); ?>
    </div> <!-- form-group -->
  </div> <!-- container -->

	</div>
</body>
</html>