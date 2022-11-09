<?php
require_once("../models/database.php");
class Administrador extends Database
{
    private $username;
    private $apellidos;
    private $email;
    private $password;
    private $fecha;
    function getUsername()
    {
        return $this->username;
    }

    function getApellidos()
    {
        return $this->apellidos;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getPassword()
    {
        return $this->password;
    }

    function setUsername($username)
    {
        $this->username = $username;
    }
    function getFecha()
    {
        return $this->fecha;
    }
    function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    function mostrarTodos()
    {
        // prepare the statement. the placeholders allow PDO to handle substituting
        // the values, which also prevents SQL injection
        $stmt = $this->db->prepare("SELECT * FROM productos");

        
        $products = array();
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $products[] = $row;
            }
        }


        return $products;
    }
    function registrarUsuario()
    {
        //encrypt password
        $password = password_hash($this->getPassword(), PASSWORD_BCRYPT, ['cost' => 4]);
        $sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
        $statement = $this->db->prepare($sql);
        $statement->execute(array($this->username, $password));
        //$publisher_id = $this->db->lastInsertId();
        return "Nuevo usuario registrado! " . $this->username;
    }
    function conectar()
    {
        $this->db->query("SET NAMES 'utf8'");
    }
    function loginAdmin()
    {


        $sql = "SELECT * FROM admin WHERE username = ?";
        $statement = $this->db->prepare($sql);
        $statement->execute(array($this->username));
        $result = $statement->fetch();
        if ($result) {
            $verify = password_verify($this->password, $result['password']);
            if ($verify) {

                //get lastInsertId and set it to session and set session role to admin
                $publisher_id = $this->db->lastInsertId();
                $_SESSION['id_user'] = $publisher_id;
                $_SESSION['role'] = "admin";
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
