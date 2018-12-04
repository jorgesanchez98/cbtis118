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

    public function getOrdenar ($ordenar){
        switch ($ordenar) {
            case '1':
                return 'semestre';
            break;
            case '2':
                return 'sexo';
            break;
            default:
             break;
        }
    }

    public function getConjunto ($conjunto){
        switch ($conjunto) {
            case '1':
                return 'AND';
            break;
            case '2':
                return 'OR';
            break;
            default:
             break;
        }
    }

    public function getCriteria ($criteria){
        switch ($criteria) {
            case '1':
                return 'sexo';
            break;
            case '2':
                return 'carrera';
            break;
            case '3':
                return 'turno';
            break;
            case '4':
                return 'materiasAprobadas';
            break;
            case '5':
                return 'materiasReprobadas';
            break;
            case '6':
                return 'extranjero';
            break;
            default:
                return $criteria;
             break;
        }
    }

    public function getOperador ($operador){
        switch ($operador) {
            case '1':
                return '>';
            break;
            case '2':
                return '<';
            break;
            case '3':
                return '=';
            break;
            default:
             break;
        }
    }

    public function visualizarFormato () {
        $id = $_GET["id"];
        $formato = new Formato($this->adapter);
        $pregunta = new Pregunta($this->adapter);
        $resFormato = $formato->getById($id, "idFormato");
        $allPreguntas = $pregunta->getBy("idFormato", $id);
        $this->view("visualizarFormato",array(
                    "allPreguntas"=>$allPreguntas,
                    "formato" => $resFormato
        ));
    }

    public function getValor ($valor){
        $string = str_replace('ó','',$valor);
        $string = str_replace('Ó','',$string);
        $string = str_replace('á','',$string);
        $string = str_replace('Á','',$string);
        $string = str_replace('í','',$string);
        $string = str_replace('Í','',$string);
        $string = str_replace('é','',$string);
        $string = str_replace('É','',$string);
        $string = str_replace('ú','',$string);
        $string = str_replace('Ú','',$string);
        return $string;
    }

    public function visualizarFormatoHTML ($id){
        $pregunta = new Pregunta($this->adapter);
        $formato = new Formato($this->adapter);
        $allPreguntas = $pregunta->getBy("idFormato", $id);
        if (count($allPreguntas) > 0){
            foreach ($allPreguntas as $pregunta) {
                echo "<div class='row'>";
                echo "<div class='col-1'>".$pregunta->numero."</div>";
                echo "<div class='col-11'>";
                $this->visualizarPreguntaId($pregunta->idPregunta);
                echo "</div>";
                echo "</div>";
            }
        }
    }

    public function visualizarPreguntaId ($id) {
        $pregunta = new Pregunta($this->adapter);
        $consulta = new Consultas($this->adapter);
        $resPregunta = $pregunta->getById($id, "idPregunta");
        $allConsultas = $consulta->getBy("idPregunta", $id);
        echo "<p>".$resPregunta->texto."</p>";
        echo "<br>";
        /*
        if (count($allConsultas) > 0){
            foreach ($allConsultas as $con) {
                echo "<div class='row'>";
                echo "<div class='col-4'>";
                echo $con->descripcion;
                echo "</div>";
                echo "<div class='col-8'>";
                $this->consultaId($con->idConsulta);
                echo "</div>";
                echo "</div>";
            }
        }*/
        echo "<table>";
        echo "<tr>";
        for ($i = 0; $i < count($allConsultas); $i++){
            echo "<th>";
            echo $allConsultas[$i]->descripcion;
            echo "</th>";
        }
        echo "</tr>";
        echo "<tr></tr>";
        echo "<tr>";
        for ($i = 0; $i < count($allConsultas); $i++){
            echo "<td>";
            echo $this->consultaId($allConsultas[$i]->idConsulta);
            echo "</td>";
        }
        echo "</tr>";
        echo "</table";
       //echo "<br>";
    }
    public function visualizarPregunta () {
        $id = $_GET["id"];
        $pregunta = new Pregunta($this->adapter);
        $consulta = new Consultas($this->adapter);
        $resPregunta = $pregunta->getById($id, "idPregunta");
        $allConsultas = $consulta->getBy("idPregunta", $id);
        echo "<p>".$resPregunta->texto."</p>";
        echo "<br>";
        /*
        if (count($allConsultas) > 0){
            foreach ($allConsultas as $con) {
                echo "<div class='row'>";
                echo "<div class='col-4'>";
                echo $con->descripcion;
                echo "</div>";
                echo "<div class='col-8'>";
                $this->consultaId($con->idConsulta);
                echo "</div>";
                echo "</div>";
            }
        }*/
        echo "<table>";
        echo "<tr>";
        for ($i = 0; $i < count($allConsultas); $i++){
            echo "<th>";
            echo $allConsultas[$i]->descripcion;
            echo "</th>";
        }
        echo "</tr>";
        echo "<tr></tr>";
        echo "<tr>";
        for ($i = 0; $i < count($allConsultas); $i++){
            echo "<td>";
            echo $this->consultaId($allConsultas[$i]->idConsulta);
            echo "</td>";
        }
        echo "</tr>";
        echo "</table";
        //echo "<br>";
    }

    public function consultaId ($id) {
            $consulta = new Consultas($this->adapter);
            $criterio = new Criterio($this->adapter);
            $allCriterios = $criterio->getBy("idConsulta", $id);
            $resConsulta = $consulta->getById($id, "idConsulta");


            $sql = "SELECT ";
            $sql .= $this->getOrdenar($resConsulta->ordenar);
            $sql .= ", count(idAlumno) as total FROM alumnos WHERE ";
            $i = 0;
            foreach ($allCriterios as $criterio){
                if ($i != 0){
                    $sql .= " ".$this->getConjunto($criterio->conector)." ";
                }
                $sql .= $this->getCriteria($criterio->campo);
                $sql .= " ".$this->getOperador($criterio->operador)." '";
                $sql .= $this->getValor($criterio->valor)."'";
                $i++;
            }

            $sql .= " GROUP BY ".$this->getOrdenar($resConsulta->ordenar);
            

            if ($consulta->ejecutarSql($sql)){
                $res = $consulta->ejecutarSql($sql);
                echo "<table class='table' border='1px solid gray'>";
                echo "<tr padding-top='15px'>";
                echo "<th>";
                echo $this->getOrdenar($resConsulta->ordenar);
                echo "</th>";
                echo "<th> total </th>";
                echo "</tr>";
                if (is_array($res)){
                    foreach ($res as $r){
                        $s = $this->getOrdenar($resConsulta->ordenar);
                        echo "<tr>";
                        echo "<td>";
                        echo $r->$s;
                        echo "</td>";
                        echo "<td>";
                        echo $r->total;
                        echo "</td>";
                        echo "</tr>";
                    }
                }
                else {
                    $s = $this->getOrdenar($resConsulta->ordenar);
                    echo "<tr>";
                    echo "<td>";
                    echo $res->$s;
                    echo "</td>";
                    echo "<td>";
                    echo $res->total;
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else {
               echo "<table border='1px solid black'>";
                echo "<tr padding-top='15px'>";
                echo "<th>";
                echo $this->getOrdenar($resConsulta->ordenar);
                echo "</th>";
                echo "<th> total </th>";
                echo "</tr>";
                echo "</table>"; 
            }
            echo "<br>";
        }

    public function consulta () {
        if (isset($_POST["id"])){
            $consulta = new Consultas($this->adapter);
            $criterio = new Criterio($this->adapter);
            $allCriterios = $criterio->getBy("idConsulta", $_POST["id"]);
            $resConsulta = $consulta->getById($_POST["id"], "idConsulta");


            $sql = "SELECT ";
            $sql .= $this->getOrdenar($resConsulta->ordenar);
            $sql .= ", count(idAlumno) as total FROM alumnos WHERE ";
            $i = 0;
            foreach ($allCriterios as $criterio){
                if ($i != 0){
                    $sql .= " ".$this->getConjunto($criterio->conector)." ";
                }
                $sql .= $this->getCriteria($criterio->campo);
                $sql .= " ".$this->getOperador($criterio->operador)." '";
                $sql .= $this->getValor($criterio->valor)."'";
                $i++;
            }

            $sql .= " GROUP BY ".$this->getOrdenar($resConsulta->ordenar);

            if ($consulta->ejecutarSql($sql)){
                $res = $consulta->ejecutarSql($sql);
                echo "<table class='table' border='1px solid gray'>";
                echo "<tr padding-top='15px'>";
                echo "<th>";
                echo $this->getOrdenar($resConsulta->ordenar);
                echo "</th>";
                echo "<th> total </th>";
                echo "</tr>";
                if (is_array($res)){
                    foreach ($res as $r){
                        $s = $this->getOrdenar($resConsulta->ordenar);
                        echo "<tr>";
                        echo "<td>";
                        echo $r->$s;
                        echo "</td>";
                        echo "<td>";
                        echo $r->total;
                        echo "</td>";
                        echo "</tr>";
                    }
                }
                else {
                    $s = $this->getOrdenar($resConsulta->ordenar);
                    echo "<tr>";
                    echo "<td>";
                    echo $res->$s;
                    echo "</td>";
                    echo "<td>";
                    echo $res->total;
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else {
               echo "<table border='1px solid black'>";
                echo "<tr padding-top='15px'>";
                echo "<th>";
                echo $this->getOrdenar($resConsulta->ordenar);
                echo "</th>";
                echo "<th> total </th>";
                echo "</tr>";
                echo "</table>"; 
            }
        }

        /*if (isset($_GET["valor"])){
            $sql = "SELECT ";
            if (isset($_GET["ordenar"])){
                $sql .= $this->getOrdenar($_GET["ordenar"]);
            }
            $sql .= ", count(idAlumno) as total FROM alumnos WHERE ";
            $i = 0;
            echo $sql;
            foreach ($_GET["criteria"] as $criteria){
                if ($i != 0){
                    $sql .= " ".$this->getConjunto($_GET["conjunto"][$i - 1])." ";
                }
                $sql .= $this->getCriteria($criteria);
                $sql .= " ".$this->getOperador($_GET["operador"][$i])." '";
                $sql .= $this->getValor($_GET["valor"][$i])."'";
                $i++;
            }

            $sql .= " GROUP BY ".$this->getOrdenar($_GET["ordenar"]);

            echo $sql;
            echo "<br/>";

            $consulta = new Archivo($this->adapter);

            $result = $consulta->ejecutarSql($sql);

            foreach ($result as $res){
                echo $res->total;
            }

        }*/
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

      if (count($allcriterios) > 0){
        foreach ($allcriterios as $criteria) {
          $criterio->deleteById($criteria->idCriterio, "idCriterio");
        }
      }

      $consulta->deleteById($id, "idConsulta");
      //$this->redirectParametroId("Consultas", "index", $_POST["idPregunta"], $_POST["idFormato"]);
    }

    public function borrarId ($id) {
      $criterio = new Criterio($this->adapter);
      $consulta = new Consultas($this->adapter);

      $allcriterios = $criterio->getBy("idConsulta", $id);

      if (count($allcriterios) > 0){
        foreach ($allcriterios as $criteria) {
          $criterio->deleteById($criteria->idCriterio, "idCriterio");
        }
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