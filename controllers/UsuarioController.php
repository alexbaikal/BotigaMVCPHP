<?php
class UsuarioController{
    //El controller tiene las diferentes acciones que se pueden hacer 
    public function mostrarTodos(){
       
        require_once "./models/usuario.php";
        require_once "./models/product.php";
        $usuario = new Usuario();

        $todosLosProductos = $usuario->mostrarProductos();
       
        require_once "views/usuarios/mostrarTodos.php";
    }
    public function registrar(){
        require_once "views/usuarios/registrarUsuario.php";
    }
    public function alta(){
       if (isset($_POST)){
        //Falta acabar
         require_once "models/usuario.php";
         $usuario = new Usuario();
         $usuario->setUsername($_POST['username']);
         $usuario->setPassword($_POST['password']);
         $usuario->conectar();
         echo "".$usuario->registrarUsuario();
       }  

    }

    public function modificar(){
       echo "Estoy en modificar";
    }  
    public function eliminar(){
        echo "Estoy en eliminar";
    }  

}
?>