<?php 
class Rol extends EntidadBase {
    private $idRol;
    private $nombre;
    private $modulo;

    public function __construct($adapter) {
        $table = "roles";
        parent::__construct($table, $adapter);
    }

    public function getIdRol () {
        return $this->idRol;
    }

    public function setIdRol ($idRol){
        $this->idRol = $idRol;
    }

    public function getNombre () {
        return $this->nombre;
    }

    public function setNombre ($nombre) {
        $this->nombre = $nombre;
    }

    public function getModulo () {
        return $this->modulo;
    }

    public function setModulo ($modulo) {
        $this->modulo = $modulo;
    }
}
?>