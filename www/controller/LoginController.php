<?php
class LoginController extends ControladorBase{
	private $conexion;
	private $adapter;
     
    public function __construct() {    
        parent::__construct();
    	$this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }
     
    public function index(){
        if (isset($_POST["nombre"]))
            $_SESSION["nombre"]=$_POST["nombre"];
        $array = array(
            "foo" => "bar",
            "bar" => "foo",
            );
        $this->view("login", $array);
    }
}
?>
