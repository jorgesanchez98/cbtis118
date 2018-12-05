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
        if (isset($_SESSION["nombre"])){
        $usuario = new Usuario($this->adapter);
         
        $allusers = $usuario->getAll("idUsuario");

        $this->view("usuarios",array(
            "allusers"=>$allusers
            ));
        }
        else {
            $this->redirect("login", "index");
        }
    }

    public function getRol ($id) {
        $rol = new Rol($this->adapter);

        $res = $rol->getById($id, "idRol");

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

    public function editar(){
        $id = $_POST["idUsuario"];
            $usuario=new Usuario($this->adapter);
            $usuario->deleteById($id, "idUsuario");
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
            $id = $_POST["id"];
            $usuario=new Usuario($this->adapter);
            $usuario->deleteById($id, "idUsuario");
        }

    public function getUsuario () {
        $usuario = new Usuario($this->adapter);
        $resUsuario = $usuario->getById($_POST["id"], "idUsuario");
        echo ",";
        echo $resUsuario->nombre;
        echo ",";
        echo $resUsuario->paterno;
        echo ",";
        echo $resUsuario->materno;
        echo ",";
        echo $resUsuario->email;
        echo ",";
    }
}
?>
