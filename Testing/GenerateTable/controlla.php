<?php

require_once("modelo.php");
$functName = $_REQUEST['f'];
$tabla = generateTable("SELECT * FROM zombies");
echo $tabla;
?>