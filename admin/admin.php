<!--Controlador frontal: fichero que se encarga de cargarlo absolutamente todo -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Panel admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
session_start();
require_once "../autoload.php";
require_once "../views/general/cabecera.html";
require_once "./views/menu.php";
if (isset($_GET['controller'])){
    $nombreController = $_GET['controller']."Controller";

}
else{
    //Controlador per defecte
    $nombreController = "AdministradorController";
}
if(isset($_SESSION["role"])) {
    $role = $_SESSION['role'];
} else {
    $role = "";
}

if ($role != 'admin') {
    if (class_exists($nombreController)){
        $controlador = new $nombreController();
        if(isset($_GET['action'])){
            $action = $_GET['action'];
        }
        else{
            $action ="iniciarLogin";
        }
        $controlador->$action();   
    }else{
    
        echo "No existe el controlador";
    }
} else {
    if (class_exists($nombreController)){
        $controlador = new $nombreController();
        if(isset($_GET['action'])){
            $action = $_GET['action'];
        }
        else{
            $action ="iniciarVistaProductos";
        }
        $controlador->$action();   
    }else{
    
        echo "No existe el controlador";
    }
}

require_once "../views/general/pie.html";
?>
</body>
</html>


