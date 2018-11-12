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
}
?>