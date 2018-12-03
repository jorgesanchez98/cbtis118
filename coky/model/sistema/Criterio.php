<?php 
class Criterio extends EntidadBase {

	private $idCriterio;
	private $campo;
	private $operador;
	private $valor;
	private $conector;
	private $idConsulta;

    public function __construct($adapter) {
        $table = "criterio";
        parent::__construct($table, $adapter);
    }

    public function setIdConsulta ($id){
    	$this->idConsulta = $id;
    }

    public function getIdConsulta (){
    	return $this->idConsulta;
    }

    public function setIdCriterio ($id){
    	$this->idCriterio = $id;
    }

    public function getIdCriterio (){
    	return $this->idCriterio;
    }

    public function setCampo ($id){
    	$this->campo = $id;
    }

    public function getCampo (){
    	return $this->campo;
    }

    public function setOperador ($id){
    	$this->operador = $id;
    }

    public function getOperador (){
    	return $this->operador;
    }

    public function setValor ($id){
    	$this->valor = $id;
    }

    public function getValor (){
    	return $this->valor;
    }

    public function setConector ($id){
    	$this->conector = $id;
    }

    public function getConector (){
    	return $this->conector;
    }

    public function save () {
    	$query="INSERT INTO criterio VALUES(NULL,
                '".$this->campo."',
                '".$this->operador."',
                '".$this->conector."',
                '".$this->idConsulta."',
                '".$this->valor."');";
        echo $query;
        $save=$this->db()->query($query);
        return $save;
    }
}
?>