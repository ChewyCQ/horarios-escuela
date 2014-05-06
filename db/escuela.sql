-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-05-2014 a las 11:03:05
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `escuela`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE IF NOT EXISTS `alumno` (
  `idAlumno` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(70) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  PRIMARY KEY (`idAlumno`),
  KEY `fk_alumno_grupo1_idx` (`idGrupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE IF NOT EXISTS `carrera` (
  `idCarrera` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_carrera` varchar(70) NOT NULL,
  PRIMARY KEY (`idCarrera`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`idCarrera`, `Nombre_carrera`) VALUES
(1, 'Enfermeria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE IF NOT EXISTS `clase` (
  `idClase` int(11) NOT NULL AUTO_INCREMENT,
  `idMaestro` int(11) NOT NULL,
  `idPeriodo` int(11) NOT NULL,
  `idHorario` int(11) NOT NULL,
  `idMateria` int(11) NOT NULL,
  PRIMARY KEY (`idClase`),
  KEY `fk_materia_has_maestro_maestro1_idx` (`idMaestro`),
  KEY `idPeriodo_idx` (`idPeriodo`),
  KEY `idHorario_idx` (`idHorario`),
  KEY `fk_maestro_materia_materia1_idx` (`idMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_alumno`
--

CREATE TABLE IF NOT EXISTS `clase_alumno` (
  `idRegistro` int(11) NOT NULL,
  `idAlumno` int(11) NOT NULL,
  PRIMARY KEY (`idRegistro`,`idAlumno`),
  KEY `fk_registro_maestro_materia_has_alumno_alumno1_idx` (`idAlumno`),
  KEY `fk_registro_maestro_materia_has_alumno_registro_maestro_mat_idx` (`idRegistro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_en_dependencia`
--

CREATE TABLE IF NOT EXISTS `clase_en_dependencia` (
  `idClase` int(11) NOT NULL,
  `idDependencia` int(11) NOT NULL,
  PRIMARY KEY (`idClase`,`idDependencia`),
  KEY `fk_clase_has_dependencia_dependencia1_idx` (`idDependencia`),
  KEY `fk_clase_has_dependencia_clase1_idx` (`idClase`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencia`
--

CREATE TABLE IF NOT EXISTS `dependencia` (
  `idDependencia` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(70) NOT NULL,
  `CantidadMaxAlumnos` int(11) NOT NULL,
  PRIMARY KEY (`idDependencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuela`
--

CREATE TABLE IF NOT EXISTS `escuela` (
  `idEscuela` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(70) NOT NULL,
  PRIMARY KEY (`idEscuela`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad_materia`
--

CREATE TABLE IF NOT EXISTS `especialidad_materia` (
  `idMateria` int(11) NOT NULL,
  `idEspecialidad` int(11) NOT NULL,
  PRIMARY KEY (`idMateria`,`idEspecialidad`),
  KEY `fk_materia_has_especialidad_especialidad1_idx` (`idEspecialidad`),
  KEY `fk_materia_has_especialidad_materia1_idx` (`idMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `idGrupo` int(11) NOT NULL AUTO_INCREMENT,
  `Generacion` varchar(5) NOT NULL,
  `Clave` varchar(20) NOT NULL,
  `idSemestre` int(11) NOT NULL,
  PRIMARY KEY (`idGrupo`),
  KEY `fk_grupo_semestre1_idx` (`idSemestre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE IF NOT EXISTS `horario` (
  `idHorario` int(11) NOT NULL AUTO_INCREMENT,
  `Inicio` time NOT NULL,
  `Fin` time NOT NULL,
  PRIMARY KEY (`idHorario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_escuela`
--

CREATE TABLE IF NOT EXISTS `horario_escuela` (
  `idHorario_escuela` int(11) NOT NULL AUTO_INCREMENT,
  `Duracion_clase` int(11) NOT NULL,
  `Inicio_turno_matutino` time NOT NULL,
  `Fin_turno_matutino` time NOT NULL,
  `Inicio_turno_vespertino` time NOT NULL,
  `Fin_turno_vespertino` time NOT NULL,
  PRIMARY KEY (`idHorario_escuela`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `idLogin` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(45) NOT NULL,
  `Contraseña` varchar(40) NOT NULL,
  PRIMARY KEY (`idLogin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro`
--

CREATE TABLE IF NOT EXISTS `maestro` (
  `idMaestro` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(70) NOT NULL,
  `Nivel` varchar(45) NOT NULL,
  `Fecha_ingreso` date NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Profordem` int(11) NOT NULL,
  `idEspecialidad` int(11) NOT NULL,
  PRIMARY KEY (`idMaestro`),
  KEY `fk_maestro_especialidad1_idx` (`idEspecialidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro_campo_clinico`
--

CREATE TABLE IF NOT EXISTS `maestro_campo_clinico` (
  `idMaestro` int(11) NOT NULL,
  `idDependencia` int(11) NOT NULL,
  PRIMARY KEY (`idMaestro`,`idDependencia`),
  KEY `fk_maestro_has_dependencia_dependencia1_idx` (`idDependencia`),
  KEY `fk_maestro_has_dependencia_maestro1_idx` (`idMaestro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro_disponibilidad`
--

CREATE TABLE IF NOT EXISTS `maestro_disponibilidad` (
  `idMaestro` int(11) NOT NULL,
  `idHorario` int(11) NOT NULL,
  PRIMARY KEY (`idMaestro`,`idHorario`),
  KEY `fk_maestro_has_Horario_Horario1_idx` (`idHorario`),
  KEY `fk_maestro_has_Horario_maestro_idx` (`idMaestro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro_especialidad`
--

CREATE TABLE IF NOT EXISTS `maestro_especialidad` (
  `idEspecialidad` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(70) NOT NULL,
  PRIMARY KEY (`idEspecialidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro_puede_materia`
--

CREATE TABLE IF NOT EXISTS `maestro_puede_materia` (
  `idMateria` int(11) NOT NULL,
  `idMaestro` int(11) NOT NULL,
  PRIMARY KEY (`idMateria`,`idMaestro`),
  KEY `fk_materia_has_maestro_maestro1_idx` (`idMaestro`),
  KEY `fk_materia_has_maestro_materia1_idx` (`idMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE IF NOT EXISTS `materia` (
  `idMateria` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_materia` varchar(150) NOT NULL,
  `Tipo_materia` int(11) NOT NULL,
  PRIMARY KEY (`idMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_semestre`
--

CREATE TABLE IF NOT EXISTS `materia_semestre` (
  `idMateria` int(11) NOT NULL,
  `idSemestre` int(11) NOT NULL,
  `Horas_por_semana` float NOT NULL,
  PRIMARY KEY (`idMateria`,`idSemestre`),
  KEY `fk_materia_has_semestre_semestre1_idx` (`idSemestre`),
  KEY `fk_materia_has_semestre_materia1_idx` (`idMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE IF NOT EXISTS `periodo` (
  `idPeriodo` int(11) NOT NULL AUTO_INCREMENT,
  `Periodo` varchar(45) NOT NULL,
  `Anio` int(11) NOT NULL,
  PRIMARY KEY (`idPeriodo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan`
--

CREATE TABLE IF NOT EXISTS `plan` (
  `idPlan` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_plan` varchar(70) NOT NULL,
  `idCarrera` int(11) NOT NULL,
  PRIMARY KEY (`idPlan`),
  KEY `fk_plan_carrera1_idx` (`idCarrera`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `plan`
--

INSERT INTO `plan` (`idPlan`, `Nombre_plan`, `idCarrera`) VALUES
(1, 'Enfermeria 2013', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receso`
--

CREATE TABLE IF NOT EXISTS `receso` (
  `idReceso` int(11) NOT NULL AUTO_INCREMENT,
  `Hora_inicio` time NOT NULL,
  `Hora_fin` time NOT NULL,
  PRIMARY KEY (`idReceso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestre`
--

CREATE TABLE IF NOT EXISTS `semestre` (
  `idSemestre` int(11) NOT NULL AUTO_INCREMENT,
  `Numero_semestre` int(11) NOT NULL,
  `idPlan` int(11) NOT NULL,
  PRIMARY KEY (`idSemestre`),
  KEY `fk_semestre_plan1_idx` (`idPlan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE IF NOT EXISTS `sesion` (
  `idSesion` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha_hora_inicio` datetime NOT NULL,
  `Fecha_hora_fin` datetime NOT NULL,
  `idLogin` int(11) NOT NULL,
  PRIMARY KEY (`idSesion`),
  KEY `fk_sesion_login1_idx` (`idLogin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `fk_alumno_grupo1` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clase`
--
ALTER TABLE `clase`
  ADD CONSTRAINT `fk_maestro_materia_materia1` FOREIGN KEY (`idMateria`) REFERENCES `materia` (`idMateria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materia_maestro_maestro1` FOREIGN KEY (`idMaestro`) REFERENCES `maestro` (`idMaestro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idHorario` FOREIGN KEY (`idHorario`) REFERENCES `horario` (`idHorario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idPeriodo` FOREIGN KEY (`idPeriodo`) REFERENCES `periodo` (`idPeriodo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clase_alumno`
--
ALTER TABLE `clase_alumno`
  ADD CONSTRAINT `fk_registro_maestro_materia_has_alumno_alumno1` FOREIGN KEY (`idAlumno`) REFERENCES `alumno` (`idAlumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_registro_maestro_materia_has_alumno_registro_maestro_mater1` FOREIGN KEY (`idRegistro`) REFERENCES `clase` (`idClase`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clase_en_dependencia`
--
ALTER TABLE `clase_en_dependencia`
  ADD CONSTRAINT `fk_clase_has_dependencia_clase1` FOREIGN KEY (`idClase`) REFERENCES `clase` (`idClase`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clase_has_dependencia_dependencia1` FOREIGN KEY (`idDependencia`) REFERENCES `dependencia` (`idDependencia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `especialidad_materia`
--
ALTER TABLE `especialidad_materia`
  ADD CONSTRAINT `fk_materia_has_especialidad_especialidad1` FOREIGN KEY (`idEspecialidad`) REFERENCES `maestro_especialidad` (`idEspecialidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materia_has_especialidad_materia1` FOREIGN KEY (`idMateria`) REFERENCES `materia` (`idMateria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `fk_grupo_semestre1` FOREIGN KEY (`idSemestre`) REFERENCES `semestre` (`idSemestre`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `maestro`
--
ALTER TABLE `maestro`
  ADD CONSTRAINT `fk_maestro_especialidad1` FOREIGN KEY (`idEspecialidad`) REFERENCES `maestro_especialidad` (`idEspecialidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `maestro_campo_clinico`
--
ALTER TABLE `maestro_campo_clinico`
  ADD CONSTRAINT `fk_maestro_has_dependencia_dependencia1` FOREIGN KEY (`idDependencia`) REFERENCES `dependencia` (`idDependencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_maestro_has_dependencia_maestro1` FOREIGN KEY (`idMaestro`) REFERENCES `maestro` (`idMaestro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `maestro_disponibilidad`
--
ALTER TABLE `maestro_disponibilidad`
  ADD CONSTRAINT `fk_maestro_has_Horario_Horario1` FOREIGN KEY (`idHorario`) REFERENCES `horario` (`idHorario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_maestro_has_Horario_maestro` FOREIGN KEY (`idMaestro`) REFERENCES `maestro` (`idMaestro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `maestro_puede_materia`
--
ALTER TABLE `maestro_puede_materia`
  ADD CONSTRAINT `fk_materia_has_maestro_maestro1` FOREIGN KEY (`idMaestro`) REFERENCES `maestro` (`idMaestro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materia_has_maestro_materia1` FOREIGN KEY (`idMateria`) REFERENCES `materia` (`idMateria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `materia_semestre`
--
ALTER TABLE `materia_semestre`
  ADD CONSTRAINT `fk_materia_has_semestre_materia1` FOREIGN KEY (`idMateria`) REFERENCES `materia` (`idMateria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materia_has_semestre_semestre1` FOREIGN KEY (`idSemestre`) REFERENCES `semestre` (`idSemestre`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `fk_plan_carrera1` FOREIGN KEY (`idCarrera`) REFERENCES `carrera` (`idCarrera`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `semestre`
--
ALTER TABLE `semestre`
  ADD CONSTRAINT `fk_semestre_plan1` FOREIGN KEY (`idPlan`) REFERENCES `plan` (`idPlan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD CONSTRAINT `fk_sesion_login1` FOREIGN KEY (`idLogin`) REFERENCES `login` (`idLogin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
