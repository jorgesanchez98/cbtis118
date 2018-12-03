<?php 
class Consultas extends EntidadBase {

	private $idConsulta;
	private $ordenar;
	private $idPregunta;
	private $descripcion;

    public function __construct($adapter) {
        $table = "consulta";
        parent::__construct($table, $adapter);
    }

    public function setIdConsulta ($id){
    	$this->idConsulta = $id;
    }

    public function getIdConsulta (){
    	return $this->idConsulta;
    }

    public function setOrdenar ($id){
    	$this->ordenar = $id;
    }

    public function getOrdenar (){
    	return $this->ordenar;
    }

    public function setIdPregunta ($id){
    	$this->idPregunta = $id;
    }

    public function getPregunta (){
    	return $this->idPregunta;
    }

    public function setDescripcion ($id){
    	$this->descripcion = $id;
    }

    public function getDescripcion (){
    	return $this->descripcion;
    }

    public function save () {
    	$query="INSERT INTO consulta VALUES(NULL,
                '".$this->idPregunta."',
                '".$this->descripcion."',
                '".$this->ordenar."');";
        $save=$this->db()->query($query);
        echo $query;
        return $save;
    }
}
?>