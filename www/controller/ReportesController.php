<?php
class ReportesController extends ControladorBase{
    public $conectar;
    public $adapter;
     
    public function __construct() {
        parent::__construct();
        $this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }
     
    public function index(){

        $this->view("reportes",array());
    }

    public function consulta () {
        if (isset($_POST["valor"])){
            $sql = "SELECT ";
            if (isset($_POST["ordenar"])){
                $sql .= $_POST["ordenar"];
            }
            $sql .= ", count(idAlumno) FROM alumnos WHERE ";
            $i = 0;
            foreach ($_POST["criteria"] as $criteria){
                if ($i != 0){
                    $sql .= " ".$_POST["conjunto"][$i - 1]." ";
                }
                $sql .= $criteria;
                $sql .= " ".$_POST["operador"][$i]." '";
                $sql .= $_POST["valor"][$i]."'";
                $i++;
            }

            $sql .= " GROUP BY ".$_POST["ordenar"];

            echo $sql;
            echo "<br/>";

            $consulta = new Archivo($this->adapter);

            $result = $consulta->db()->query($sql);

            print_r($result);

        }
    }
}
?>