<?php
class UsuarioController{
    //El controller tiene las diferentes acciones que se pueden hacer 
    public function mostrarTodos(){
       
        require_once "./models/usuario.php";
        require_once "./models/product.php";
        $usuario = new Usuario();


        $todosLosProductos = $usuario->mostrarProductos();
        $todasLasCategorias = $usuario->getCategorias();
        
       
        require_once "views/usuarios/mostrarTodos.php";
    }
    public function registrarUsuario(){
        require_once "views/usuarios/registrarUsuario.php";
    }

    public function loginUsuario() {
        require_once "views/usuarios/loginUsuario.php";
    }

    public function login() {
   
        
        if (isset($_POST)) {
            $email = isset($_POST['correo']) ? $_POST['correo'] : false;
            $password = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;
            $errores = array();
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = "El email no es válido";
            }
            if (empty($password)) {
                $errores['password'] = "La contraseña está vacía";
            }
            if (count($errores) == 0) {
                require_once "./models/usuario.php";
                $usuario = new Usuario();
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $login_result = $usuario->loginUsuario();
                echo $login_result;
                //after 3 seconds redirect to index.php?controller=Usuario&action=mostrarTodos if $login_result is not "Contraseña incorrecta" or "Usuario no encontrado"
                if ($login_result != "Contraseña incorrecta" && $login_result != "Usuario no encontrado") {
                    header("refresh:3;url=index.php?controller=Usuario&action=mostrarTodos");               
                } else {
                    header("refresh:3;url=index.php?controller=Usuario&action=loginUsuario");
                }
                } else {
                    //echo all errors
                    foreach ($errores as $error) {
                        echo $error."<br>";
                        //after 3 seconds redirect to index.php?controller=Usuario&action=loginUsuario
                        header("refresh:3;url=index.php?controller=Usuario&action=loginUsuario");
                    }
                    
                    //header("Location: index.php?controller=Usuario&action=loginUsuario");
                }
            } else {
                echo "Hubo un error con el método POST";
                //header("Location: index.php?controller=Usuario&action=loginUsuario");
            }
            
        }
    


    public function alta(){
       if (isset($_POST)){
        //Falta acabar
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
        $correo = isset($_POST['correo']) ? $_POST['correo'] : false;
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
        $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;
        $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
        $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
        $cp = isset($_POST['cp']) ? $_POST['cp'] : false;
        $fecha = date("Y-m-d");
        $errores = array();
        if (empty($nombre) || is_numeric($nombre) || preg_match("/[0-9]/", $nombre)){
            $errores['nombre'] = "El nombre no es válido";
        }
        if (empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $errores['correo'] = "El correo no es válido";
        }
        if (empty($telefono) || !is_numeric($telefono)){
            $errores['telefono'] = "El teléfono no es válido.";
        }
        if (empty($contrasena)){
            $errores['contrasena'] = "La contraseña está vacía.";
        }
        if (empty($direccion)){
            $errores['direccion'] = "La dirección está vacía.";
        }
        if (empty($provincia)){
            $errores['provincia'] = "La provincia está vacía.";
        }
        if (empty($cp) || !is_numeric($cp)){
            $errores['cp'] = "El código postal no es válido.";
        }
        if (count($errores) == 0){
            require_once "models/usuario.php";
            $usuario = new Usuario();
            $usuario->setUsername($nombre);
            $usuario->setPassword($contrasena);
            $usuario->setEmail($correo);
            $usuario->setPhone($telefono);
            $usuario->setAddress($direccion);
            $usuario->setProvince($provincia);
            $usuario->setCp($cp);
            $usuario->conectar();
            echo "".$usuario->registrarUsuario();
            //wait 3 seconds and go to controller=Usuario&action=mostrarTodos
            header("refresh:3;url=index.php?controller=Usuario&action=mostrarTodos");
        }else{
            //echo the errors
            foreach ($errores as $error){
                echo "<br>".$error;
            }
            //wait 3 seconds and go to controller=Usuario&action=registrar
            header("refresh:3;url=index.php?controller=Usuario&action=registrar");
        }
       }  

    }


    public function logout() {
        // remove all session variables
        session_unset(); 
        // destroy the session 
        session_destroy(); 
        header("Location: index.php?controller=Usuario&action=mostrarTodos");
    }

    public function modificar(){
       echo "Estoy en modificar";
    }  
    public function eliminar(){
        echo "Estoy en eliminar";
    }  

}
?>