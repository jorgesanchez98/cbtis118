-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2018 a las 05:12:06
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

/*CREATE TABLE alumnos (
  idAlumno int(10) NOT NULL AUTO_INCREMENT,
    sexo char(1) NOT NULL,
    CURP char(18) NOT NULL,
    generacion varchar(10) NOT NULL,
    turno varchar(10) NOT NULL,
    carrera varchar(30) NOT NULL,
    semestre int(2) NOT NULL,
    numMaterias int(2) NOT NULL,
    calificacionTotal int(3) NOT NULL,
    PRIMARY KEY (idAlumno)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";*/


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cbtis118`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAlumnoID` (IN `nom` VARCHAR(30), IN `p` VARCHAR(30), IN `m` VARCHAR(30), IN `CURP` VARCHAR(18), IN `sex` VARCHAR(50), OUT `id` MEDIUMINT(30))  BEGIN
	SET @RES := (SELECT idAlumno FROM Alumnos WHERE Alumnos.CURP = CURP);
	IF(FOUND_ROWS()>0) THEN
		SELECT @RES as 'idAlumno' into id;
	ELSE
		CALL getSexoID(sex,@idSex);
		INSERT INTO Alumnos (idSexo,nombre,paterno,materno,CURP) SELECT  @idSex,nom,p,m,CURP;
		SELECT LAST_INSERT_ID() into id;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCarreraID` (IN `carr` VARCHAR(100), OUT `id` MEDIUMINT(255))  BEGIN
	SET @RES = (SELECT idCarrera FROM Carreras WHERE nombre=carr);
	IF(FOUND_ROWS()>0) THEN
		SELECT @RES INTO id;
	ELSE
		INSERT INTO Carreras (nombre) VALUES (carr);
		SELECT LAST_INSERT_ID() INTO id;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCicloEscolarID` (IN `an` INT(10), IN `et` INT(10), OUT `id` MEDIUMINT(255))  BEGIN
	SET @RES = (SELECT idCicloEscolar FROM CiclosEscolares WHERE ano=an AND etapa=et);
	IF(FOUND_ROWS()>0) THEN 
		SELECT @RES INTO id;
	ELSE
		INSERT INTO CiclosEscolares (ano,etapa) VALUES (an,et);
		SELECT LAST_INSERT_ID() INTO id;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getGrupoID` (IN `carr` VARCHAR(100), IN `turn` VARCHAR(50), IN `sem` INT(10), IN `let` VARCHAR(10), IN `an` INT(10), IN `et` INT(10), IN `mat` VARCHAR(100), OUT `id` MEDIUMINT(255))  BEGIN
	CALL getCarreraID(carr,@carreraID);
	CALL getTurnoID(turn,@turnoID);
	CALL getCicloEscolarID(an,et,@cicloID);
	CALL getMateriaID(mat,@materiaID);
	SET @RES = (SELECT idGrupo FROM Grupos WHERE idCarrera=@carreraID AND idCicloEscolar=@cicloID AND idMateria=@materiaID AND idTurno=@turnoID AND semestre=sem AND letra=let);
	IF(FOUND_ROWS()>0) THEN
		SELECT @RES INTO id;
	ELSE
		INSERT INTO Grupos (idCarrera,idCicloEscolar,idMateria,idTurno, semestre, letra) SELECT @carreraID, @cicloID, @materiaID, @turnoID, sem, let;
		SELECT LAST_INSERT_ID() INTO id;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getInscripcionID` (IN `carr` VARCHAR(100), IN `turn` VARCHAR(50), IN `sem` INT(10), IN `let` VARCHAR(10), IN `nom` VARCHAR(100), IN `pat` VARCHAR(50), IN `mat` VARCHAR(50), IN `CUR` VARCHAR(18), IN `sex` VARCHAR(50), IN `mater` VARCHAR(100), IN `cal` INT(10), IN `an` INT(10), IN `et` INT(10), OUT `id` MEDIUMINT(255))  BEGIN
	CALL getAlumnoID(nom, pat, mat, CUR, sex, @AlumnoID);
	CALL getGrupoID(carr,turn,sem,let,an,et,mater,@GrupoID);
	SET @RES = (SELECT idInscripcion FROM Inscripciones WHERE idGrupo=@GrupoID AND idAlumno=@AlumnoID);
	IF(FOUND_ROWS()>0) THEN
		SELECT @RES INTO id;
	ELSE
		INSERT INTO Inscripciones (idGrupo,idAlumno,calificacion) SELECT @AlumnoID, @GrupoID, cal;
		SELECT LAST_INSERT_ID() INTO id;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getMateriaID` (IN `nom` VARCHAR(100), OUT `id` MEDIUMINT(255))  BEGIN
	SET @RES = (SELECT idMateria FROM Materias WHERE nombre=nom);
	IF(FOUND_ROWS()>0) THEN
		SELECT @RES INTO id;
	ELSE
		INSERT INTO Materias (nombre) VALUES(nom);
		SELECT LAST_INSERT_ID() INTO id;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getSexoID` (IN `nom` VARCHAR(20), OUT `id` INT(30))  BEGIN
	SET @RES := (SELECT idSexo FROM Sexos WHERE nombre = nom);
	IF (FOUND_ROWS()>0) THEN
    		SELECT @RES as 'idSexo' INTO id;
	ELSE
		INSERT INTO Sexos (nombre) VALUES(nom);
		SELECT LAST_INSERT_ID() as 'idSexo' INTO id;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getTurnoID` (IN `nom` VARCHAR(30), OUT `id` INT(3))  BEGIN
	SET @RES = (SELECT idTurno FROM Turnos WHERE nombre=nom);
	IF(FOUND_ROWS()>0) THEN
		SELECT @RES INTO id;
	ELSE
		INSERT INTO Turnos (nombre) VALUES(nom);
		SELECT LAST_INSERT_ID() INTO id;
	END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `idAlumno` mediumint(255) NOT NULL,
  `idSexo` int(100) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `paterno` varchar(30) NOT NULL,
  `materno` varchar(30) NOT NULL,
  `CURP` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `idArchivo` mediumint(255) NOT NULL,
  `idTipoArchivo` int(10) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `ruta` char(40) NOT NULL,
  `cicloEscolar` varchar(30) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`idArchivo`, `idTipoArchivo`, `nombre`, `ruta`, `cicloEscolar`, `fecha`) VALUES
(1, 1, 'Estudiantes', '23456789.12345', '2018-2019', '2018-10-09'),
(2, 1, 'Nuevo Excel', '5bda7aa9c0e166.80300078.xlsx', '2016-2017', '2018-11-01'),
(3, 1, 'Prueba Importar', '5bda7af723dc75.98000917.xlsx', '2016-2017', '2018-11-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `idCarrera` mediumint(255) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclosescolares`
--

CREATE TABLE `ciclosescolares` (
  `idCicloEscolar` mediumint(255) NOT NULL,
  `ano` mediumint(255) NOT NULL,
  `etapa` mediumint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `idGrupo` mediumint(255) NOT NULL,
  `idProfesor` mediumint(255) DEFAULT NULL,
  `idCarrera` mediumint(255) NOT NULL,
  `idCicloEscolar` mediumint(255) NOT NULL,
  `idMateria` mediumint(255) NOT NULL,
  `idTurno` int(3) NOT NULL,
  `semestre` mediumint(255) NOT NULL,
  `horas` mediumint(255) DEFAULT NULL,
  `letra` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `idInscripcion` mediumint(255) NOT NULL,
  `idGrupo` mediumint(255) NOT NULL,
  `idAlumno` mediumint(255) NOT NULL,
  `calificacion` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `idMateria` mediumint(255) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `idProfesor` mediumint(255) NOT NULL,
  `idSexo` int(100) DEFAULT NULL,
  `nombre` varchar(30) NOT NULL,
  `CURP` varchar(18) DEFAULT NULL,
  `RFC` varchar(13) DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` mediumint(255) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `modulo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `nombre`, `modulo`) VALUES
(1, 'Planeación', 'Planeación'),
(2, 'Planeacion', 'Planeacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexos`
--

CREATE TABLE `sexos` (
  `idSexo` int(100) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposarchivo`
--

CREATE TABLE `tiposarchivo` (
  `idTipoArchivo` int(10) NOT NULL,
  `nombre` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tiposarchivo`
--

INSERT INTO `tiposarchivo` (`idTipoArchivo`, `nombre`) VALUES
(1, 'Detalle Calificación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `idTurno` int(3) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` mediumint(255) NOT NULL,
  `idRol` mediumint(255) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `paterno` varchar(30) NOT NULL,
  `materno` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `idRol`, `nombre`, `paterno`, `materno`, `email`, `password`) VALUES
(2, 1, 'Rodrigo', 'Domínguez', 'López', 'ro@dominguez', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(3, 1, 'Juan', 'Perez', 'Juan', 'juan@hotmail.com', '3DA541559918A808C2402BBA5012F6C60B27661C'),
(4, 1, 'Juan', 'Perez', 'Juan', 'juan@hotmail.com', '3DA541559918A808C2402BBA5012F6C60B27661C');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`idAlumno`),
  ADD UNIQUE KEY `CURP` (`CURP`),
  ADD KEY `idSexo` (`idSexo`);

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`idArchivo`),
  ADD KEY `idTipoArchivo` (`idTipoArchivo`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`idCarrera`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `ciclosescolares`
--
ALTER TABLE `ciclosescolares`
  ADD PRIMARY KEY (`idCicloEscolar`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`idGrupo`),
  ADD KEY `idProfesor` (`idProfesor`),
  ADD KEY `idCarrera` (`idCarrera`),
  ADD KEY `idCicloEscolar` (`idCicloEscolar`),
  ADD KEY `idTurno` (`idTurno`),
  ADD KEY `idMateria` (`idMateria`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`idInscripcion`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`idMateria`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`idProfesor`),
  ADD UNIQUE KEY `CURP` (`CURP`),
  ADD UNIQUE KEY `RFC` (`RFC`),
  ADD KEY `idSexo` (`idSexo`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `sexos`
--
ALTER TABLE `sexos`
  ADD PRIMARY KEY (`idSexo`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `tiposarchivo`
--
ALTER TABLE `tiposarchivo`
  ADD PRIMARY KEY (`idTipoArchivo`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`idTurno`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `idAlumno` mediumint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `idArchivo` mediumint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `idCarrera` mediumint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ciclosescolares`
--
ALTER TABLE `ciclosescolares`
  MODIFY `idCicloEscolar` mediumint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `idGrupo` mediumint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `idInscripcion` mediumint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `idMateria` mediumint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `idProfesor` mediumint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` mediumint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sexos`
--
ALTER TABLE `sexos`
  MODIFY `idSexo` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiposarchivo`
--
ALTER TABLE `tiposarchivo`
  MODIFY `idTipoArchivo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `idTurno` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` mediumint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`idSexo`) REFERENCES `sexos` (`idSexo`);

--
-- Filtros para la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD CONSTRAINT `archivos_ibfk_1` FOREIGN KEY (`idTipoArchivo`) REFERENCES `tiposarchivo` (`idTipoArchivo`);

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`idProfesor`) REFERENCES `profesores` (`idProfesor`),
  ADD CONSTRAINT `grupos_ibfk_2` FOREIGN KEY (`idCarrera`) REFERENCES `carreras` (`idCarrera`),
  ADD CONSTRAINT `grupos_ibfk_3` FOREIGN KEY (`idCicloEscolar`) REFERENCES `ciclosescolares` (`idCicloEscolar`),
  ADD CONSTRAINT `grupos_ibfk_4` FOREIGN KEY (`idTurno`) REFERENCES `turnos` (`idTurno`),
  ADD CONSTRAINT `grupos_ibfk_5` FOREIGN KEY (`idMateria`) REFERENCES `materias` (`idMateria`);

--
-- Filtros para la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD CONSTRAINT `profesores_ibfk_1` FOREIGN KEY (`idSexo`) REFERENCES `sexos` (`idSexo`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
