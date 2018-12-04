<?php
class PreguntasController extends ControladorBase{

	private $conexion;
	private $adapter;

	private $idFormato;
     
    public function __construct() {
        parent::__construct();
    	$this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }

    public function index(){
        if (isset($_SESSION["nombre"])){
        	if (isset($_GET["parametro"])){
        		$this->idFormato = $_GET["parametro"];
        		$formato = new Formato($this->adapter);
        		$pregunta = new Pregunta($this->adapter);

        		$res = $formato->getById($this->idFormato,"idFormato");
        		$allpreguntas = $pregunta->getBy("idFormato",$this->idFormato);

            	$this->view("preguntas",array(
            	"allpreguntas"=>$allpreguntas,
            	"formato" => $res
            	));
        	}
            else{
                $this->redirect("Formatos", "index");
            }
        }
        else {
            $this->redirect("login", "index");
        }
    }

    public function agregarPregunta () {
        if (isset($_POST["submit"])){
            $pregunta = new Pregunta($this->adapter);
            $pregunta->setIdFormato($_POST["idFormato"]);
            $pregunta->setTexto($_POST["text"]);
            $pregunta->setNumero($_POST["numero"]);
            $pregunta->save();
        }
        $this->redirectParametro("Preguntas", "index", $_POST["idFormato"]);
    }

    public function borrar () {
        $id = $_POST["id"];  
        $pregunta = new Pregunta($this->adapter);
        $consulta = new Consultas($this->adapter);
        $criterio = new Criterio($this->adapter);
        $resPreguntas = $pregunta->getById($id, "idPregunta");
        $allConsultas = $consulta->getBy("idPregunta", $id);
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
        $pregunta->deleteById($resPreguntas->idPregunta, "idPregunta");
    }


}
?>