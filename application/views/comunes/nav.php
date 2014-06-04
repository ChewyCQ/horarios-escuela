    <!-- Navbar -->
    <div class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url(); ?>">Horarios</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">

          	<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-plus"></span> Registrar <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url('controlador_inicio/especialidad'); ?>">Área de formación</a></li>
                <li><a href="<?php echo site_url('controlador_inicio/maestro'); ?>">Maestro</a></li>
                <li><a href="<?php echo site_url('controlador_inicio/materia'); ?>">Materia</a></li>
                <!-- <li><a href="<?php #echo site_url('controlador_inicio/semestre'); ?>">Semestre</a></li> -->
                <li><a href="<?php echo site_url('controlador_inicio/plan'); ?>">Plan</a></li>
                <li><a href="<?php echo site_url('controlador_inicio/carrera'); ?>">Carrera</a></li>
                <li><a href="<?php echo site_url('controlador_inicio/grupo'); ?>">Grupo</a></li>
                <!-- <li><a href="<?php #echo site_url('controlador_inicio/alumno'); ?>">Alumno</a></li> -->
                <li><a href="<?php echo site_url('controlador_inicio/dependencia'); ?>">Dependencia (CC)</a></li>
                <li><a href="<?php echo site_url('controlador_inicio/ciclo'); ?>">Ciclo escolar</a></li>
                <li><a href="<?php echo site_url('controlador_inicio/datos_escuela'); ?>">Datos de la escuela</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">CSVs</li>
                <li><a href="<?php echo site_url('csv/subir_csv_maestros'); ?>">Maestros</a></li>
                <!-- <li><a href="<?php #echo site_url('csv/subir_csv_materias'); ?>">Materias</a></li> -->
                <!-- <li><a href="<?php #echo site_url('csv/subir_csv_alumnos'); ?>">Alumnos</a></li> -->
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-pencil"></span> Editar <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url('controlador_inicio/edita_area'); ?>">Área de formación</a></li>
                <li><a href="<?php echo site_url('controlador_inicio/edita_maestro'); ?>">Maestro</a></li>
                <li><a href="<?php echo site_url('controlador_inicio/edita_materia'); ?>">Materia</a></li>
                <!-- <li><a href="<?php #echo site_url('controlador_inicio/edita_semestre'); ?>">Semestre</a></li> -->
                <li><a href="<?php echo site_url('controlador_inicio/edita_plan'); ?>">Plan</a></li>
                <li><a href="<?php echo site_url('controlador_inicio/edita_carrera'); ?>">Carrera</a></li>
                <li><a href="<?php echo site_url('controlador_inicio/edita_grupo'); ?>">Grupo</a></li>
                <!-- <li><a href="<?php #echo site_url('controlador_inicio/edita_alumno'); ?>">Alumno</a></li> -->
                <li><a href="<?php echo site_url('controlador_inicio/edita_dependencia'); ?>">Dependencias (CC)</a></li>
                <li><a href="<?php echo site_url('controlador_inicio/edita_ciclo'); ?>">Ciclo escolar</a></li>
                <li><a href="<?php echo site_url('controlador_inicio/edita_materia_semestre'); ?>">Matria-Semestre</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"></span> Asignar <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Area de formación-Materia</a></li>
                <li><a href="<?php echo site_url('controlador_asignar/maestro_materia'); ?>">Maestro-Materia</a></li>
                <li><a href="<?php echo site_url('controlador_asignar/materia_semestre'); ?>">Materia-Semestre</a></li>
              </ul>
            </li>
            <li><a href="#"><span class="glyphicon glyphicon-search"></span> Ver Horarios</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          	<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuario <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Datos</a></li>
                <li><a href="#">Cerrar Sesión</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>