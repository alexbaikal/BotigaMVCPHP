<?php
require_once("database.php");
class Usuario extends Database {
    private $username;
    private $apellidos;
    private $email;
    private $password;
    private $fecha;
    function getUsername() {
        return $this->username;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function setUsername($username) {
        $this->username = $username;
    }
    function getFecha() {
        return $this->fecha;
    }
    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }
    
    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    function mostrarTodos(){
        //$sql = "SELECT * FROM usuarios";
        //$rows = $this->db->query($sql);
        //return $rows;
    }
    function registrarUsuario(){
        //encrypt password
        $password = password_hash($this->getPassword(), PASSWORD_BCRYPT, ['cost'=>4]);
        $sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
        $statement = $this->db->prepare($sql);
        $statement->execute(array($this->username, $password));
        //$publisher_id = $this->db->lastInsertId();
        return "Nuevo usuario registrado! ".$this->username;


    }
    function conectar(){
        $this->db->query("SET NAMES 'utf8'");
    }

    
}




?>