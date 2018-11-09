<?php 
	class Archivo extends EntidadBase {

		private $idArchivo;
		private $idTipoArchivo;
		private $hash;
		private $fecha;
        
        public function __construct($adapter) {
            $table = "Archivos";
            parent::__construct($table, $adapter);
        }

    	public function getIdArchivo () {
    		return $this->idArchivo;
    	}

    	public function setIdArchivo ($id) {
    		$this->idArchivo = $id;
    	}

    	public function getIdTipoArchivo () {
    		return $this->idTipoArchivo;
    	}

    	public function setIdTipoArchivo ($id) {
    		$this->idTipoArchivo = $id;
    	}

    	public function getHash () {
    		return $this->hash;
    	}
        
    	public function setHash ($id) {
    		$this->hash = $id;
    	}

    	public function getFecha () {
    		return $this->fecha;
    	}

    	public function setFecha ($id) {
    		$this->fecha = $id;
    	}

    	public function insert ($values) {
    		$this->insert($values);
    	}

        public function save(){
        $query="INSERT INTO Archivos (idTipoArchivo, hash)VALUES(
                '".$this->idTipoArchivo."',
                '".$this->hash."');";
        $save=$this->db()->query($query);
        return $save;
    }
	}
?>