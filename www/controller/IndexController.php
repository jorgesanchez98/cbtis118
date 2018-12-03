<?php
class IndexController extends ControladorBase{

	private $conexion;
	private $adapter;
     
    public function __construct() {
        parent::__construct();
    	$this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }
     
    public function index(){
        $archivo = new Archivo($this->adapter);
         
        $allarchivos = $archivo->getAll("idArchivo");

        
        if (isset($_SESSION["nombre"])){
            $this->view("index",array(
            "allarchivos"=>$allarchivos
            ));
        }
        else {
            $this->redirect("login", "index");
        }
        
    }

     public function getTipoArchivo ($id) {
        $tipoArchivo = new TipoArchivo($this->adapter);
        $res = $tipoArchivo->getById($id, "idTipoArchivo");
        return $res->nombre;
    }
}
?>