<?php 
	class Archivo extends EntidadBase {

		private $idArchivo;
        private $ruta;
        private $nombre;
		private $idTipoArchivo;
		private $cicloEscolar;
		private $fecha;
        
        public function __construct($adapter) {
            $table = "archivos";
            parent::__construct($table, $adapter);
        }

        public function getRuta () {
            return $this->ruta;
        }

        public function setRuta ($id) {
            $this->ruta = $id;
        }

        public function getNombre () {
            return $this->nombre;
        }

        public function setNombre ($id) {
            $this->nombre = $id;
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

    	public function getFecha () {
    		return $this->fecha;
    	}
        
    	public function setFecha ($id) {
    		$this->fecha = $id;
    	}

    	public function getCicloEscolar () {
    		return $this->cicloEscolar;
    	}

    	public function setCicloEscolar ($id) {
    		$this->cicloEscolar = $id;
    	}

        public function save(){
        $query="INSERT INTO archivos VALUES(NULL,
                '".$this->idTipoArchivo."',
                '".$this->nombre."',
                '".$this->ruta."',
                '".$this->cicloEscolar."',
                '".$this->fecha."');";
        $save=$this->db()->query($query);
        return $save;
    }
	}
?>