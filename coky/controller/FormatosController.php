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

    public function borrar () {
        $id = $_POST["id"];
        $formato = new Formato($this->adapter);
        $pregunta = new Pregunta($this->adapter);
        $consulta = new Consultas($this->adapter);
        $criterio = new Criterio($this->adapter);
        $resFormato = $formato->getById($id, "idFormato");
        $allPreguntas = $pregunta->getBy("idFormato", $id);
        if (count($allPreguntas) > 0){
            foreach ($allPreguntas as $pre) {
                $allConsultas = $consulta->getBy("idPregunta", $pre->idPregunta);
                if (count($allConsultas) > 0){
                    foreach ($allConsultas as $con) {
                        $allCriterios = $criterio->getBy("idConsulta", $con->idConsulta);
                        if (count($allCriterios) > 0){
                            foreach ($allCriterios as $crit) {
                                $criterio->deleteById($crit->idCriterio,"idCriterio");
                            }
                        }
                        $consulta->deleteById($con->idConsulta, "idConsulta");
                    }
                }
                $pregunta->deleteById($pre->idPregunta, "idPregunta");
            }
        }
        $formato->deleteById($resFormato->idFormato, "idFormato");
        
    }

}
?>