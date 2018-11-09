<?php 
	class Alumno extends EntidadBase{
		private $idAlumno;
		private $idSexo;
		private $nombre;
		private $paterno;
		private $materno;
		private $CURP;

		public function __construct() {
       		$table="Alumnos";
        	parent::__construct($table);
    	}

		public function getIdAlumno() {
       		return $this->idAlumno;
    	}
 
    	public function setIdAlumno($id) {
        	$this->idAlumno = $id;
    	}

    	public function getIdSexo() {
       		return $this->idSexo;
    	}
 
    	public function setIdSexo($id) {
        	$this->idSexo = $id;
    	}

    	public function getNombre() {
       		return $this->getNombre;
    	}
 
    	public function setNombre($id) {
        	$this->nombre = $id;
    	}

    	public function getPaterno() {
       		return $this->paterno;
    	}
 
    	public function setPaterno($id) {
        	$this->paterno = $id;
    	}

    	public function getMaterno() {
       		return $this->materno;
    	}
 
    	public function setMaterno($id) {
        	$this->materno = $id;
    	}
	}
?>