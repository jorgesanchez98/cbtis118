<?php 
class Formato extends EntidadBase {

	private $idFormato;
	private $nombre;
	private $descripcion;

	public function __construct($adapter) {
        $table = "formatos";
        parent::__construct($table, $adapter);
    }

    public function setNombre ($nombre){
        $this->nombre = $nombre;
    }

    public function getNombre (){
        return $this->nombre;
    }

    public function setDescripcion ($nombre){
        $this->descripcion = $nombre;
    }

    public function getDescripcion (){
        return $this->descripcion;
    }

    public function save () {
    	$query="INSERT INTO formatos VALUES(NULL,
                '".$this->nombre."',
                '".$this->descripcion."');";
        $save=$this->db()->query($query);
        return $save;
    }
}

?>