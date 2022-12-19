<!--Controlador frontal: fichero que se encarga de cargarlo absolutamente todo -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title>Document</title>
</head>
<body>
<?php 
// Initialize the session
session_start();

require_once "autoload.php";
if (isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $role = $_SESSION['role'];
    require_once "./models/usuario.php";
    $usuario = new Usuario();
    $nombre_usuario = $usuario->getNombreUsuario($user_id);
}

require_once "views/general/cabecera.html";


require_once "views/general/menu.php";

 

if (isset($_GET['controller'])){
    $nombreController = $_GET['controller']."Controller";
}
else{
    //Controlador per dedecte
    $nombreController = "UsuarioController";
}
if (class_exists($nombreController)){
    $controlador = new $nombreController();
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }
    else{
        require_once "./models/usuario.php";
        require_once "./models/product.php";
        $usuario = new Usuario();

        $todosLosProductos = $usuario->mostrarProductos();
        $action ="mostrarTodos";
    }
    $controlador->$action();   
}else{

    echo "No existe el controlador";
}
require_once "views/general/pie.html";
?>
</body>
</html>


