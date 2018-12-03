<?php
class FormatosController extends ControladorBase{

	private $conexion;
	private $adapter;
     
    public function __construct() {
        parent::__construct();
    	$this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }

    public function redirectIndex() {
        echo "hola";
        $this->redirect("Formatos", "index");
    }
     
    public function index(){
        $formato = new Formato($this->adapter);
         
        $allformatos = $formato->getAll("idFormato");

        if (isset($_SESSION["nombre"])){
            $this->view("formatos",array(
            "allformatos"=>$allformatos
            ));
        }
        else {
            $this->redirect("login", "index");
        }
    }

    public function subirFormato () {
        if (isset($_POST["submit"])){
            $formato = new Formato($this->adapter);
            $formato->setNombre($_POST["nombre"]);
            $formato->setDescripcion($_POST["descripcion"]);
            $formato->save();
        }
        $this->redirect("Formatos", "index");
    }

    public function borrar ($id) {
      $formato = new Formato($this->adapter);

      if ($formato->deleteById($id, "idFormato")){
        //$allformatos = $formato->getAll("idArchivo");
        $this->redirect("Formatos", "index");
      }
      else {
        trigger_error("Fatal error", E_USER_ERROR);
      }
    }

}
?>