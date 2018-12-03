<?php
class ControladorBase{
 
    public function __construct() {
        session_start();
        require_once 'Conectar.php';
        require_once 'EntidadBase.php';
        require_once 'ModeloBase.php';
        foreach(glob("model/interno/*.php") as $file){
            require_once $file;
        }
        foreach(glob("model/sistema/*.php") as $file){
            require_once $file;
        }
    }
     
    public function view($vista,$datos){
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc}=$valor;
        }
        require_once 'core/AyudasVistas.php';
        $helper = new AyudasVistas();
     
        require_once 'view/'.$vista.'View.php';
    }
     
    public function redirect($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO){
        header("Location:index.php?controller=".$controlador."&action=".$accion);
    }

    public function redirectParametro($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO,$parametro){
        header("Location:index.php?controller=".$controlador."&action=".$accion."&parametro=".$parametro);
    }

    public function redirectParametroId($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO,$parametro, $id){
        header("Location:index.php?controller=".$controlador."&action=".$accion."&parametro=".$parametro."&id=".$id);
    }
 
}
?>

