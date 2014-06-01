<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('comunes/header'); ?>
     <!--Para usar el autocompletar-->
    <?php $this->load->view('comunes/autocompletar'); ?>
    <!--Para usar las validaciones-->
    <?php $this->load->view('comunes/validaciones'); ?>
<head>
	<title>Ciclo escolar</title>
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
            nombre_semestre: "<font color='red'>Sólo se aceptan letras, números y carácter # (no al inicio o al final)</font>"
          }
        },

      });
    });
  </script>

</head>
<body>
    <?php $this->load->view('comunes/nav'); ?>
    <div class="container">    
    <?php
      if($idPeriodo!=null)
      {
        ?><legend>Editar ciclo escolar</legend><?php
      }
      else
      {
        ?><legend>Nuevo ciclo escolar</legend><?php
      }
    ?>    
    <!-- Form Name -->
    <div class="form-group">
       <?php
          if($idPeriodo!=null)
          {
            ?>
            <form id="form" action="<?php echo site_url('controlador_actualizar/actualiza_ciclo');?>?id=<?php echo $idPeriodo ?>" method="post">
            <?php
        }
        else
        {
            ?>
            <form id="form" action="<?php echo site_url('controlador_registrar/guarda_periodo');?>" method="post">
            <?php
          }   
        ?>
   
    <!--<?php echo form_open('controlador_inicio/validar_ciclo'); ?>-->

		<label for="clave">Clave o nombre del semestre</label>
    <input type="text" class="form-control required" id="clave" value="<?php echo $Periodo ?>" placeholder="nombre de referencia para el semestre" name="clave">
    <br/>

    <!--Código para verificar cual dato del combo esta seleccionado-->
      <?php
        $sel1 = "";
        $sel2 = "";
        if($Anio == date("Y")){
            $sel1 = "selected";
        }
        if($Anio == date("Y")+1){
            $sel2 = "selected";
        }
      ?>

    <label for="anio">Año</label>
    <select id="anio" name="anio" class="form-control">
      <option value="<?php echo date("Y") ?>" <?php echo $sel1;?> ><?php echo date("Y") ?></option>
      <option value="<?php echo date("Y")+1 ?>" <?php echo $sel2;?> ><?php echo date("Y")+1?></option>
    </select>
    <br/>

    <!--Código para verificar cual dato del combo esta seleccionado-->
      <?php
        $sel1 = "";
        $sel2 = "";
        if($semestre == 1){
            $sel1 = "selected";
        }
        if($semestre == 2){
            $sel2 = "selected";
        }
      ?>
    <label for="semestre">Semestre</label>
    <select id="semestre" name="semestre" class="form-control">
      <option value="1" <?php echo $sel1;?> >ENERO - JUNIO</option>
      <option value="2" <?php echo $sel2;?> >AGOSTO - DICIEMBRE</option>
    </select>
    <br/>
		    <div align="right">
          <button type="submit" class="btn btn-primary btn-lg" title="Guardar"><span class='glyphicon glyphicon-floppy-save'></span></button>
          <?php
            if($idPeriodo==null)
            {
              ?><button type="reset" class="btn btn-success btn-lg" title="Limpiar formulario"><span class='glyphicon glyphicon-refresh'></span></button><?php
            }
          ?>          
          <button type="button" class="btn btn-danger btn-lg" title="Cancelar" onclick="window.location.href='<?php echo site_url('controlador_inicio/index');?>'"><span class='glyphicon glyphicon-floppy-remove'></span></button>
        </div>
		</form>

  	<script src="<?php echo base_url().BOOTSTRAP_JS?>"></script>     
    </div> <!-- form-group -->
  </div> <!-- container -->

	</div>
</body>
</html>