<?php
 
function cargarControlador($controller){
    $controlador = ucwords($controller).'Controller';
    $strFileController = 'controller/'.$controlador.'.php';
     
    if(!is_file($strFileController)){
        $strFileController = 'controller/'.ucwords(CONTROLADOR_DEFECTO).'Controller.php';  
    }
    
    require_once $strFileController;
    $controllerObj = new $controlador();
    return $controllerObj;
}
 
function cargarAccion($controllerObj,$action){
    $accion = $action;
    $controllerObj->$accion();
}

function cargarAccionParametro ($controllerObj,$action, $parametro) {
    $accion = $action;
    $controllerObj->$accion($parametro);
}
 
function lanzarAccion($controllerObj){
    if (isset($_GET["action"]) && method_exists($controllerObj, $_GET["action"])){
        cargarAccion($controllerObj, $_GET["action"]);
    }
    else if (isset($_POST["action"]) && method_exists($controllerObj, $_POST["action"])) {
        if (isset($_POST["id"])){
            cargarAccionParametro($controllerObj, $_POST["action"], $_POST["id"]);
        }
        else {
            cargarAccion($controllerObj, $_POST["action"]);
        }
    }
    else {
        cargarAccion($controllerObj, ACCION_DEFECTO);
    }
}
?>
