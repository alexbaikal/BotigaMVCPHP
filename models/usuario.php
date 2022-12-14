<?php
require_once("database.php");
class Usuario extends Database {
    private $username;
    private $apellidos;
    private $email;
    private $password;
    private $phone;
    private $address;
    private $province;
    private $cp;
    private $fecha;
    private $user_id;
    function getUsername() {
        return $this->username;
    }

    function getNombreUsuario($id_usuario) {
        $sql = "SELECT * FROM usuarios WHERE id_usuario = ".$id_usuario;
        //return only one record
        $query = $this->db->prepare($sql);
        $query->execute();
        $item = $query->fetch(\PDO::FETCH_ASSOC);
        return $item;
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

    function getPhone() {
        return $this->phone;
    }

    function getCategorias() {
        $sql = "SELECT * FROM categorias";

        $query = $this->db->prepare($sql);
        $query->execute();
        $items = $query->fetchAll(\PDO::FETCH_ASSOC);


        return $items;
    }
    function getAddres() {
        return $this->address;
    }

    function getProvince() {
        return $this->province;
    }

    function getCp() {
        return $this->cp;
    }
    function getUserId() {
        return $this->user_id;
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

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function setProvince($province) {
        $this->province = $province;
    }

    function setCp($cp) {
        $this->cp = $cp;
    }
    
    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    function setUserId($user_id) {
        $this->user_id = $user_id;
    }
    function mostrarTodos(){
        //$sql = "SELECT * FROM usuarios";
        //$rows = $this->db->query($sql);
        //return $rows;
    }
    function registrarUsuario(){
        //use password_hash to encrypt password

        //encrypt password
        $password = password_hash($this->getPassword(), PASSWORD_DEFAULT);
        //insert into database
        $sql = "INSERT INTO usuarios (nombre, correo, telefono, contrase??a, direccion, provincia, cp) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $statement = $this->db->prepare($sql);
        $statement->execute(array($this->username, $this->email, $this->phone, $password, $this->address, $this->province, $this->cp));
        $publisher_id = $this->db->lastInsertId();
        //create session with user id and role user
        $_SESSION['user_id'] = $publisher_id;
        $_SESSION['role'] = 'user';
        return "Nuevo usuario registrado! ".$this->username;
        


    }

    function loginUsuario() {
        $sql = "SELECT * FROM usuarios WHERE correo = ?";
        $query = $this->db->prepare($sql);
        $query->execute(array($this->email));
        $item = $query->fetch(\PDO::FETCH_ASSOC);
        if ($item) {
            //check if password is correct
            if (password_verify($this->password, $item['contrase??a'])) {
                //create session with user id and role user
                $_SESSION['user_id'] = $item['id_usuario'];
                $_SESSION['role'] = 'user';
                return "Login correcto";
            } else {
                return "Contrase??a incorrecta";
            }
        } else {
            return "Usuario no encontrado";
        }

    }

    function conectar(){
        $this->db->query("SET NAMES 'utf8'");
    }

    function mostrarProductos()
    {
        // prepare the statement. the placeholders allow PDO to handle substituting
        // the values, which also prevents SQL injection
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE isactive = 1");

        
        $products = array();
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $products[] = $row;
            }
        }

        //filter out products that have a category that is not active
        $filtered_products = array();
        foreach ($products as $product) {
            $stmt = $this->db->prepare("SELECT * FROM categorias WHERE id_categoria = ? AND isactive = 1");
            $stmt->execute(array($product['categoria']));
            if ($stmt->rowCount() > 0) {
                $filtered_products[] = $product;
            }
        }


        return $filtered_products;
    }

    function mostrarUsuario()
    {
        // prepare the statement. the placeholders allow PDO to handle substituting
        // the values, which also prevents SQL injection
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");

        
        $user_data = array();
        if ($stmt->execute(array($this->user_id))) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $user_data[] = $row;
            }
        }
        //echo direccion of user


        require_once "views/usuarios/modificarUsuario.php";



    }

    function modificarUsuario() {
        $sql = "UPDATE usuarios SET nombre = ?, telefono = ?, direccion = ?, provincia = ?, cp = ? WHERE id_usuario = ?";
            $statement = $this->db->prepare($sql);
            $statement->execute(array($this->username, $this->phone, $this->address, $this->province, $this->cp, $this->user_id));
            
            //echo "Usuario modificado correctamente" and show the user data
            echo "Usuario modificado correctamente";

            //after 1 second, redirect to the user page
            header("refresh:0.5; url=index.php?controller=Usuario&action=iniciarModificarUsuario");
        
    }
}




?>