<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
<head>
	<title>Nuevo ciclo escolar</title>
  <?php $this->load->view('comunes/validaciones'); ?>
  <script type="text/javascript">
    $(function(){
      $('#form').validate({
        rules:{
          clave: {
            required: true,
            minlength: 2,
            maxlength: 70,
            nombre_semestre:true
          }
        },
        messages:{
          clave: {
            required: "<font color='red'>Campo obligatorio</font>",
            minlength: "<font color='red'>El nombre del grupo debe tener un máximo de 2 caracteres</font>",
            maxlength: "<font color='red'>El nombre del grupo debe tener un máximo de 70 caracteres</font>",
            nombre_semestre: "<font color='red'>Solo se aceptan letras, numeros y caracteres (. _ - #)</font>"
          }
        },

      });
    });
  </script>

</head>
<body>
    <?php $this->load->view('comunes/nav'); ?>
    <div class="container">

    <!-- Form Name -->
    <legend>Nuevo ciclo escolar</legend>
    <div class="form-group">
    <form id="form" action="<?php echo site_url('controlador_registrar/validar_ciclo');?>" method="post">
    <!--<?php echo form_open('controlador_inicio/validar_ciclo'); ?>-->

		<label for="clave">Clave o nombre del semestre</label>
    <input type="text" class="form-control required" id="clave" value="" placeholder="nombre de referencia para el semestre" name="clave">
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

  	<script src="<?php echo base_url().BOOTSTRAP_JS?>"></script>     
    </div> <!-- form-group -->
  </div> <!-- container -->

	</div>
</body>
</html>