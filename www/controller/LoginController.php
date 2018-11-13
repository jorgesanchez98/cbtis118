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
        $array = array(
            "foo" => "bar",
            "bar" => "foo",
            );
        $this->view("login", $array);
    }

    public function login(){
        $usuario = new Usuario($this->adapter);
        $allusers = $usuario->getAll();
        if (isset($_POST["nombre"])&&$_POST["nombre"]!=""){
            if (($_SESSION["rol"]=$usuario->checkUserPass($allusers, $_POST["nombre"], $_POST["password"]))!=false) {
                $_SESSION["nombre"]=$_POST["nombre"];
                
                $this->redirect("Importar", "index");
            }
            else{
                $this->redirect("login", "index");
            }
        }
        else{
            $this->redirect("login", "index");
        }
        
    }
}
?>
