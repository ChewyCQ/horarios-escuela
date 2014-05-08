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
          <a class="navbar-brand" href="#">Horarios</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">

          	<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-plus"></span> Registrar <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url('inicio/especialidad'); ?>">Área de formación</a></li>
                <li><a href="<?php echo site_url('inicio/maestro'); ?>">Maestro</a></li>
                <li><a href="<?php echo site_url('inicio/materia'); ?>">Materia</a></li>
                <li><a href="<?php echo site_url('inicio/semestre'); ?>">Semestre</a></li>
                <li><a href="<?php echo site_url('inicio/plan'); ?>">Plan</a></li>
                <li><a href="<?php echo site_url('inicio/carrera'); ?>">Carrera</a></li>
                <li><a href="<?php echo site_url('inicio/grupo'); ?>">Grupo</a></li>
                <li><a href="<?php echo site_url('inicio/alumno'); ?>">Alumno</a></li>
                <li><a href="<?php echo site_url('inicio/dependencia'); ?>">Dependencia (CC)</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-pencil"></span> Editar <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url('inicio/edita_area'); ?>">Área de formación</a></li>
                <li><a href="<?php echo site_url('inicio/edita_maestro'); ?>">Maestro</a></li>
                <li><a href="<?php echo site_url('inicio/materia'); ?>">Materia</a></li>
                <li><a href="<?php echo site_url('inicio/semestre'); ?>">Semestre</a></li>
                <li><a href="<?php echo site_url('inicio/plan'); ?>">Plan</a></li>
                <li><a href="<?php echo site_url('inicio/carrera'); ?>">Carrera</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"></span> Asignar <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Area de formación-Materia</a></li>
                <li><a href="#">Maestro-Materia</a></li>
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