<?php
class ConsultasController extends ControladorBase{

    private $conexion;
    private $adapter;

    private $idPregunta;
     
    public function __construct() {
        parent::__construct();
        $this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }

    public function index(){
        if (isset($_SESSION["nombre"])){
            if (isset($_GET["parametro"])){
                if (isset($_GET["id"])){
                    $this->idPregunta = $_GET["parametro"];
                    $pregunta = new Pregunta($this->adapter);
                    $consulta = new Consultas($this->adapter);

                    $res = $pregunta->getById($this->idPregunta,"idPregunta");
                    $allconsultas = $consulta->getBy("idPregunta",$this->idPregunta);

                    $this->view("consultas",array(
                    "allconsultas"=>$allconsultas,
                    "pregunta" => $res,
                    "idFormato" => $_GET["id"]
                    ));
                }
                else {
                    $this->redirect("Formatos", "index");
                } 
            }
            else {
                $this->redirect("Formatos", "index");
            }
        }
        else {
            $this->redirect("login", "index");
        }
    }

    public function agregarConsulta () {
        if (isset($_POST["submit"])){
            if ($_POST["editando"] == 1){
                $this->borrarId($_POST["idConsulta"]);
            }
            $consulta = new Consultas($this->adapter);
            $consulta->setIdPregunta($_POST["idPregunta"]);
            $consulta->setDescripcion($_POST["descripcion"]);
            $consulta->setOrdenar($_POST["ordenar"]);
            if ($consulta->save()){
                echo "si";
                $consulta = new Consultas($this->adapter);
                $res = $consulta->getBy2("idPregunta", $_POST["idPregunta"], "descripcion", $_POST["descripcion"]);
                $i = 0;
                foreach($_POST["criteria"] as $criteria){
                    $nuevoCriterio = new Criterio($this->adapter);
                    if ($i != 0){
                        $nuevoCriterio->setConector($_POST["conjunto"][$i - 1]);
                    }
                    $nuevoCriterio->setCampo($criteria);
                    $nuevoCriterio->setValor($_POST["valor"][$i]);
                    $nuevoCriterio->setOperador($_POST["operador"][$i]);
                    $nuevoCriterio->setIdConsulta($res->idConsulta);
                    $nuevoCriterio->save();
                    /*if ($nuevoCriterio->save()){ 
                        echo "";
                    }
                    else {
                        echo $criteria;
                        echo $_POST["valor"][$i];
                        echo $_POST["operador"][$i];
                        echo $res->idConsulta;
                    }*/
                    $i += 1;
                }
            }
            else {
                echo "no";
            }
        }
        $this->redirectParametroId("Consultas", "index", $_POST["idPregunta"], $_POST["idFormato"]);
    }

    public function borrar () {
        $id = $_POST["id"];
      $criterio = new Criterio($this->adapter);
      $consulta = new Consultas($this->adapter);

      $allcriterios = $criterio->getBy("idConsulta", $id);

      foreach ($allcriterios as $criteria) {
          $criterio->deleteById($criteria->idCriterio, "idCriterio");
      }

      $consulta->deleteById($id, "idConsulta");
      //$this->redirectParametroId("Consultas", "index", $_POST["idPregunta"], $_POST["idFormato"]);
    }

    public function borrarId ($id) {
      $criterio = new Criterio($this->adapter);
      $consulta = new Consultas($this->adapter);

      $allcriterios = $criterio->getBy("idConsulta", $id);

      foreach ($allcriterios as $criteria) {
          $criterio->deleteById($criteria->idCriterio, "idCriterio");
      }

      $consulta->deleteById($id, "idConsulta");
      //$this->redirectParametroId("Consultas", "index", $_POST["idPregunta"], $_POST["idFormato"]);
    }

    public function getConsulta () {
        $consulta = new Consultas($this->adapter);
        $resConsulta = $consulta->getById($_POST["id"], "idConsulta");
        $criterio = new Criterio($this->adapter);
        $allCriterios = $criterio->getBy("idConsulta", $_POST["id"]);
        echo ",";
        echo $resConsulta->descripcion;
        echo ",";
        echo $resConsulta->ordenar;
        echo ",";
        echo count($allCriterios);
        echo ",";
        foreach ($allCriterios as $criterio) {
            echo $criterio->campo;
            echo ",";
            echo $criterio->operador;
            echo ",";
            echo $criterio->valor;
            echo ",";
            echo $criterio->conector;
            echo ",";
        }
    }


}
?>