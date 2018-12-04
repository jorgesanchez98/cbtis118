<?php
class ImportarController extends ControladorBase{

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
            $this->view("importar",array(
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

    public function cargarBaseDatos () {
      require_once "core/Classes/PHPExcel.php";
      require_once "core/ChunkReadFilter.php";

      $file = new Archivo($this->adapter);
      $resFile = $file->getById($_POST["id"], "idArchivo");

      $fileNameNew = $resFile->ruta;
      $tmpfname = "baseDatos/excel/".$fileNameNew;
      libxml_use_internal_errors(true);

      $inputFileType = PHPExcel_IOFactory::identify($tmpfname);
      $objReader = PHPExcel_IOFactory::createReader($inputFileType);
      $chunkSize = 18800;

      $startRow = 200;

        $chunkFilter = new chunkReadFilter();
        $chunkFilter->setRows($startRow,$chunkSize);
        $objReader->setReadFilter($chunkFilter);
        $objReader->setReadDataOnly(true);
        ini_set('memory_limit', '-1');
        $objPHPExcel = $objReader->load($tmpfname);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $startRow += $chunkSize;

      $estudiantes = array();

      for ($i = 1; $i < count($sheetData); $i++){
        if (array_key_exists($sheetData[$i+1]["L"], $estudiantes)){
            if ($sheetData[$i+1]["Q"] > 5){
            $estudiantes[$sheetData[$i+1]["L"]][6] += 1;
          }
          else {
            $estudiantes[$sheetData[$i+1]["L"]][7] += 1;
          }
        }
        else {
          $n = 0;
          if($sheetData[$i+1]["L"][11] == 'N' && $sheetData[$i+1]["L"][12] == 'E'){
            $n = 1;
          }
          $estudiantes[$sheetData[$i+1]["L"]] = array($sheetData[$i+1]["L"],$sheetData[$i+1]["L"][10], $sheetData[$i+1]["D"], $sheetData[$i+1]["E"], $sheetData[$i+1]["C"], $sheetData[$i+1]["F"], 1, 1, $n);
          if ($sheetData[$i+1]["Q"] > 5){
            $estudiantes[$sheetData[$i+1]["L"]][6] = 1;
            $estudiantes[$sheetData[$i+1]["L"]][7] = 0;
          }
          else {
            $estudiantes[$sheetData[$i+1]["L"]][6] = 0;
            $estudiantes[$sheetData[$i+1]["L"]][7] = 1;
          }
        }
      }

      $alumno = new Alumno($this->adapter);
      $alumno->ejecutarSql("TRUNCATE TABLE alumnos");
      $result = $alumno->save($estudiantes);
      
      if ($result){
        echo ",success";
      }
      else {
        echo ",no";
      }
    }

    public function subirArchivo () {
        if (isset($_POST["submit"])){
            if (!empty($_FILES['file']['name'])) {
               $file = $_FILES['file'];

               $fileName = $_FILES['file']['name'];
               $fileTemp = $_FILES['file']['tmp_name'];
               $fileSize = $_FILES['file']['size'];
               $fileError = $_FILES['file']['error'];
               $fileType = $_FILES['file']['type'];

               $fileExt = explode('.' , $fileName);
               $fileActualExt = strtolower(end($fileExt));

               $allowed = array('xlsx', 'xls');

               if (in_array($fileActualExt, $allowed)){
                    if ($fileError === 0){
                        if ($fileSize < 10000000){
                            $fileNameNew = uniqid('', true).".".$fileActualExt;
                            $fileDestination = 'baseDatos/excel/'.$fileNameNew;
                            if (move_uploaded_file($fileTemp, $fileDestination)){
                                $archivo = new Archivo($this->adapter);
                                $archivo->setNombre($_POST["nombre"]);
                                $archivo->setIdTipoArchivo($_POST["tipoArchivo"]);
                                $archivo->setCicloEscolar($_POST["cicloEscolar"]);
                                $archivo->setFecha(date("Y-m-d"));
                                $archivo->setRuta($fileNameNew);
                                $archivo->save();
                            }
                        }
                    }
               }
            }
        } 
      $this->redirect("Importar", "index");
    }

    public function getArchivo () {
        $id = $_GET["id"];
        $archivo = new Archivo($this->adapter);
        $resArchivo = $archivo->getById($id, "idArchivo");
        echo ",";
        echo $resArchivo->ruta;
    }

    public function borrar ($id) {
      $archivo = new Archivo($this->adapter);

      $file = $archivo->getById($id, "idArchivo");

      if ($archivo->deleteById($id, "idArchivo")){
        $allarchivos = $archivo->getAll("idArchivo");
        unlink("baseDatos/excel/".$file->ruta);
        $this->redirect("Importar", "index");
      }
      else {
        trigger_error("Fatal error", E_USER_ERROR);
      }
    }
    
}
?>
