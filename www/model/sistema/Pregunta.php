<?php 
class Pregunta extends EntidadBase {

	private $idPregunta;
	private $texto;
	private $idFormato;
    private $numero;

	public function __construct($adapter) {
        $table = "pregunta";
        parent::__construct($table, $adapter);
    }

    public function setTexto ($nombre){
        $this->texto = $nombre;
    }

    public function getTexto (){
        return $this->texto;
    }

    public function setIdFormato ($nombre){
        $this->idFormato = $nombre;
    }

    public function getIdFormato (){
        return $this->idFormato;
    }

    public function setNumero ($nombre){
        $this->numero = $nombre;
    }

    public function getNumero (){
        return $this->numero;
    }

    public function save () {
    	$query="INSERT INTO pregunta VALUES(NULL,
                ".'"'.$this->texto.'"'.",
                '".$this->idFormato."',
                '".$this->numero."');";
        $save=$this->db()->query($query);
        return $save;
    }
}

?>