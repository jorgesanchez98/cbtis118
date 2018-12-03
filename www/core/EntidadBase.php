<?php
class EntidadBase{
    private $table;
    private $db;
    private $conectar;
 
    public function __construct($table, $adapter) {
        $this->table=(string) $table;
        $this->conectar = new Conectar();
        $this->db = $adapter;
    }
     
    public function getConetar(){
        return $this->conectar;
    }
     
    public function db(){
        return $this->db;
    }

    public function getUsers(){
        $query=$this->db->query("SELECT * FROM $this->table");

        $resultSet = [];

        while ($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
         
        return $resultSet;
    }
     
    public function getAll($idNombre){
        $query=$this->db->query("SELECT * FROM $this->table ORDER BY $idNombre DESC");

        $resultSet = [];

        while ($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
         
        return $resultSet;
    }
     
    public function getById($id, $idNombre){
        $query = $this->db->query("SELECT * FROM $this->table WHERE $idNombre=$id");

        $resultSet = [];
 
        if($row = $query->fetch_object()) {
           $resultSet=$row;
        }
         
        return $resultSet;
    }

    public function getBy2($id, $idNombre, $id2, $idNombre2){
        $query = $this->db->query("SELECT * FROM $this->table WHERE $id='$idNombre' AND $id2='$idNombre2'");

        $resultSet = [];
 
        if($row = $query->fetch_object()) {
           $resultSet=$row;
        }
         
        return $resultSet;
    }


     
    public function getBy($column,$value){
        $query=$this->db->query("SELECT * FROM $this->table WHERE $column='$value'");

        $resultSet = [];
 
        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
         
        return $resultSet;
    }
     
    public function deleteById($id, $idNombre){
        $query=$this->db->query("DELETE FROM $this->table WHERE $idNombre=$id");
        return $query;
    }
     
    public function deleteBy($column,$value){
        $query=$this->db->query("DELETE FROM $this->table WHERE $column='$value'");
        return $query;
    }

    public function insert ($values){
        $query = "INSERT INTO $this->table VALUES (";
        for ($i = 0; $i < count($values); $i++){
            $query .= $values[$i];
            $query .= ",";
        }
        $query .= ");";
        $query = $this->db->query($query);
        return $query;
    }

    public function ejecutarSql($query){
        $query=$this->db->query($query);
        if ($query == true){
            if ($query->num_rows > 1){
                while($row = $query->fetch_object()) {
                   $resultSet[] = $row;
                }
            }elseif ($query->num_rows == 1){
                if ($row = $query->fetch_object()) {
                    $resultSet = $row;
                }
            }else {
                $resultSet = true;
            }
        }else {
            $resultSet = false;
        }
        return $resultSet;
    }
}
?>
