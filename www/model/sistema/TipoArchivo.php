<?php 
	class TipoArchivo extends EntidadBase {
		private $idTipoArchivo;
		private $nombre;

		public function __construct($adapter) {
            $table = "tiposarchivo";
            parent::__construct($table, $adapter);
        }

        public function getIdTipoArchivo () {
        	return $this->idTipoArchivo;
        }

        public function setIdTipoArchivo ($idTipoArchivo) {
        	$this->idTipoArchivo = $idTipoArchivo;
        }

        public function getNombre () {
        	return $this->nombre;
        }

        public function setNombre ($nombre) {
        	$this->nombre = $nombre;
        }
	}
?>