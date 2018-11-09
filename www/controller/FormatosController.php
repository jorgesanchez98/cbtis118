<?php
class FormatosController extends ControladorBase{

	private $conexion;
	private $adapter;
     
    public function __construct() {
        parent::__construct();
    	$this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }
     
    public function index(){
        $array = array(
            "foo" => "bar",
            "bar" => "foo",
            );
        $this->view("formatos", $array);
    }
}
?>