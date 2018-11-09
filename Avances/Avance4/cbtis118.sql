/*Etan*/

CREATE TABLE IF NOT EXISTS Sexos
(
idSexo int(100) NOT NULL AUTO_INCREMENT,
nombre varchar(50) NOT NULL UNIQUE,
PRIMARY KEY(idSexo)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS Alumnos
(
idAlumno mediumint(255) NOT NULL AUTO_INCREMENT,
idSexo int(100) NOT NULL,
nombre varchar(30) NOT NULL,
paterno varchar(30) NOT NULL,
materno varchar(30) NOT NULL,
CURP varchar(18) NOT NULL UNIQUE,
PRIMARY KEY(idAlumno),
FOREIGN KEY(idSexo) REFERENCES Sexos(idSexo)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS Profesores
(
idProfesor mediumint(255) NOT NULL AUTO_INCREMENT,
idSexo int(100),
nombre varchar(30) NOT NULL,
CURP varchar(18) UNIQUE,
RFC varchar(13) UNIQUE,
sexo varchar(1),
PRIMARY KEY(idProfesor),
FOREIGN KEY(idSexo) REFERENCES Sexos(idSexo)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS Carreras
(
idCarrera mediumint(255) NOT NULL AUTO_INCREMENT, 
nombre varchar(30) NOT NULL UNIQUE,
PRIMARY KEY(idCarrera)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS CiclosEscolares
(
idCicloEscolar mediumint(255) NOT NULL AUTO_INCREMENT,
ano mediumint(255)  NOT NULL,
etapa mediumint(255)  NOT NULL,
PRIMARY KEY(idCicloEscolar)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS TiposArchivo
(
idTipoArchivo int(10) NOT NULL AUTO_INCREMENT,
nombre char(255) NOT NULL,
PRIMARY KEY(idTipoArchivo)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS Archivos
(
idArchivo int(10) NOT NULL AUTO_INCREMENT,
idTipoArchivo int(10) NOT NULL,
hash char(255) NOT NULL UNIQUE,
fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY(idArchivo),
FOREIGN KEY(idTipoArchivo) REFERENCES TiposArchivo(idTipoArchivo)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS Turnos
(
idTurno int(3) NOT NULL AUTO_INCREMENT,
nombre varchar(30) NOT NULL UNIQUE,
PRIMARY KEY(idTurno)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS Materias
(
 idMateria mediumint(255) NOT NULL AUTO_INCREMENT,
 nombre varchar(100) NOT NULL UNIQUE,
 PRIMARY KEY(idMateria)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS Grupos
(
idGrupo mediumint(255) NOT NULL AUTO_INCREMENT,
idProfesor mediumint(255),
idCarrera mediumint(255) NOT NULL,
idCicloEscolar mediumint(255) NOT NULL,
idMateria mediumint(255) NOT NULL,
idTurno int(3) NOT NULL,
semestre mediumint(255) NOT NULL,
horas mediumint(255) ,
letra varchar(1) NOT NULL,
PRIMARY KEY(idGrupo),
FOREIGN KEY (idProfesor) REFERENCES Profesores(idProfesor),
FOREIGN KEY (idCarrera) REFERENCES Carreras(idCarrera),
FOREIGN KEY (idCicloEscolar) REFERENCES CiclosEscolares(idCicloEscolar),
FOREIGN KEY (idTurno) REFERENCES Turnos(idTurno),
FOREIGN KEY (idMateria) REFERENCES Materias(idMateria)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS Inscripciones
(
idInscripcion mediumint(255) NOT NULL AUTO_INCREMENT,
idGrupo  mediumint(255) NOT NULL,
idAlumno mediumint(255) NOT NULL,
calificacion int(10) NOT NULL,
 PRIMARY KEY(idInscripcion)
/* FOREIGN KEY (idGrupo) REFERENCES Grupos(idGrupo)*/
/* FOREIGN KEY (idAlumno) REFERENCES Alumnos(idAlumno) ON UPDATE CASCADE */
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

DROP PROCEDURE IF EXISTS getSexoID;
DELIMITER $$
CREATE PROCEDURE 
getSexoID(IN nom VARCHAR(20), OUT id int(30))
BEGIN
	SET @RES := (SELECT idSexo FROM Sexos WHERE nombre = nom);
	IF (FOUND_ROWS()>0) THEN
    		SELECT @RES as 'idSexo' INTO id;
	ELSE
		INSERT INTO Sexos (nombre) VALUES(nom);
		SELECT LAST_INSERT_ID() as 'idSexo' INTO id;
	END IF;
END;$$
DELIMITER ;


DROP PROCEDURE IF EXISTS getAlumnoID;
DELIMITER $$
CREATE PROCEDURE getAlumnoID(IN nom varchar(30), IN p varchar(30), IN m varchar(30), IN CURP varchar(18), IN sex varchar(50), OUT id mediumint(30)) 
BEGIN
	SET @RES := (SELECT idAlumno FROM Alumnos WHERE Alumnos.CURP = CURP);
	IF(FOUND_ROWS()>0) THEN
		SELECT @RES as 'idAlumno' into id;
	ELSE
		CALL getSexoID(sex,@idSex);
		INSERT INTO Alumnos (idSexo,nombre,paterno,materno,CURP) SELECT  @idSex,nom,p,m,CURP;
		SELECT LAST_INSERT_ID() into id;
	END IF;
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS getTurnoID;
DELIMITER $$
CREATE PROCEDURE getTurnoID(IN nom varchar(30), OUT id int(3))
BEGIN
	SET @RES = (SELECT idTurno FROM Turnos WHERE nombre=nom);
	IF(FOUND_ROWS()>0) THEN
		SELECT @RES INTO id;
	ELSE
		INSERT INTO Turnos (nombre) VALUES(nom);
		SELECT LAST_INSERT_ID() INTO id;
	END IF;
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS getMateriaID;
DELIMITER $$
CREATE PROCEDURE getMateriaID(IN nom varchar(100), OUT id mediumint(255))
BEGIN
	SET @RES = (SELECT idMateria FROM Materias WHERE nombre=nom);
	IF(FOUND_ROWS()>0) THEN
		SELECT @RES INTO id;
	ELSE
		INSERT INTO Materias (nombre) VALUES(nom);
		SELECT LAST_INSERT_ID() INTO id;
	END IF;
END$$
DELIMITER ;


DROP PROCEDURE IF EXISTS getCicloEscolarID;
DELIMITER $$
CREATE PROCEDURE getCicloEscolarID(IN an int(10), IN et int(10), OUT id mediumint(255))
BEGIN
	SET @RES = (SELECT idCicloEscolar FROM CiclosEscolares WHERE ano=an AND etapa=et);
	IF(FOUND_ROWS()>0) THEN 
		SELECT @RES INTO id;
	ELSE
		INSERT INTO CiclosEscolares (ano,etapa) VALUES (an,et);
		SELECT LAST_INSERT_ID() INTO id;
	END IF;
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS getCarreraID;
DELIMITER $$
CREATE PROCEDURE getCarreraID(IN carr VARCHAR(100), OUT id mediumint(255))
BEGIN
	SET @RES = (SELECT idCarrera FROM Carreras WHERE nombre=carr);
	IF(FOUND_ROWS()>0) THEN
		SELECT @RES INTO id;
	ELSE
		INSERT INTO Carreras (nombre) VALUES (carr);
		SELECT LAST_INSERT_ID() INTO id;
	END IF;
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS getGrupoID; /*CALL getGrupoID("Electrónica","MATUTINO",4,"A",2018,2,"Programacion en C",@ok);*/
DELIMITER $$
CREATE PROCEDURE getGrupoID(IN carr VARCHAR(100), IN  turn VARCHAR(50), IN sem INT(10), IN let VARCHAR(10),IN an INT(10), IN et INT(10), IN mat VARCHAR(100), OUT id mediumint(255))
BEGIN
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
DELIMITER ;
DROP PROCEDURE IF EXISTS getInscripcionID;
DELIMITER $$
CREATE PROCEDURE getInscripcionID(IN carr VARCHAR(100), IN  turn VARCHAR(50), IN sem INT(10), IN let VARCHAR(10), IN nom VARCHAR(100),IN pat VARCHAR(50),IN mat VARCHAR(50), IN CUR VARCHAR(18),IN sex varchar(50),IN mater VARCHAR(100),IN cal INT(10),IN an INT(10), IN et INT(10),OUT id mediumint(255))
BEGIN
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


