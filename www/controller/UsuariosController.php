<?php
class UsuariosController extends ControladorBase{
    public $conectar;
    public $adapter;
     
    public function __construct() {
        parent::__construct();
        $this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }
     
    public function index(){
         
        $usuario = new Usuario($this->adapter);
         
        $allusers = $usuario->getAll();

        $this->view("usuarios",array(
            "allusers"=>$allusers
            ));
    }

    public function getRol ($id) {
        $rol = new Rol($this->adapter);

        $res = $rol->getById($id);

        return $res->nombre;
    }
     
    public function crear(){
        if(isset($_POST["nombre"])&&isset($_POST["paterno"])&&isset($_POST["materno"])&&isset($_POST["email"])&&isset($_POST["password"])&&isset($_POST["idRol"])&&$_POST["nombre"]!=""&&$_POST["paterno"]!=""&&$_POST["materno"]!=""&&$_POST["email"]!=""&&$_POST["password"]!=""&&$_POST["idRol"]!=""){
            $usuario=new Usuario($this->adapter);
            $usuario->setNombre($_POST["nombre"]);
            $usuario->setPaterno($_POST["paterno"]);
            $usuario->setMaterno($_POST["materno"]);
            $usuario->setEmail($_POST["email"]);
            $usuario->setPassword(sha1($_POST["password"]));
            $usuario->setIdRol($_POST["idRol"]);
            $save=$usuario->save();
        }
        $this->redirect("Usuarios", "index");
    }
     
    public function borrar(){
        if(isset($_GET["id"])){
            $id=(int)$_GET["id"];
            $usuario=new Usuario($this->adapter);
            $usuario->deleteById($id);
        }
        $this->redirect();
    }
}
?>
