<?php
class Usuario extends EntidadBase{
    private $idUsuario;
    private $idRol;
    private $nombre;
    private $paterno;
    private $materno;
    private $email;
    private $password;

    private $rol;
     
    public function __construct($adapter) {
        $table = "usuarios";
        parent::__construct($table, $adapter);
    }

    public function getRol () {
        return $this->rol;
    }

    public function setRol ($rol) {
        $this->rol = $rol;
    }
     
    public function getIdUsuario() { 
        return $this->idUsuario;
    }
 
    public function setIdUsuario($id) {
        $this->idUsuario = $id;
    }

    public function getIdRol() { 
        return $this->idRol;
    }
 
    public function setIdRol($id) {
        $this->idRol = $id;
    }
     
    public function getNombre() {
        return $this->nombre;
    }
 
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
 
    public function getPaterno() {
        return $this->paterno;
    }
 
    public function setPaterno($apellido) {
        $this->paterno = $apellido;
    }

    public function getMaterno() {
        return $this->materno;
    }
 
    public function setMaterno($apellido) {
        $this->materno = $apellido;
    }
 
    public function getEmail() {
        return $this->email;
    }
 
    public function setEmail($email) {
        $this->email = $email;
    }
 
    public function getPassword() {
        return $this->password;
    }
 
    public function setPassword($password) {
        $this->password = $password;
    }
 
    public function save(){
        $query="INSERT INTO usuarios (id,nombre,apellido,email,password)
                VALUES(NULL,
                       '".$this->nombre."',
                       '".$this->apellido."',
                       '".$this->email."',
                       '".$this->password."');";
        $save=$this->db()->query($query);
        return $save;
    }
 
}
?>
