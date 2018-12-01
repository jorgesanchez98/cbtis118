<?php 
class Consultas extends ModeloBase {

    public function __construct($adapter) {
        $table = "consulta";
        parent::__construct($table, $adapter);
    }
}
?>