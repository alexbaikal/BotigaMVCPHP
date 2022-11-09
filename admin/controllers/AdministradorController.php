<?php
class AdministradorController
{
    //El controller tiene las diferentes acciones que se pueden hacer 



    public function iniciarVistaProductos()
    {

        require_once "./models/administrador.php";
        require_once "./models/products.php";
        $administrador = new Administrador();

        $todosLosProductos = $administrador->mostrarTodos();

        require_once "./views/mostrarProductos.php";


        /*   // Create an array of products inside products model
        $products = array();
        foreach ($todosLosProductos as $producto) {
            $products[] = new Products($producto['id_producto'], $producto['nombre'], $producto['descripcion'], $producto['cantidad'], $producto['precio'], $producto['categoria'], $producto['foto']);
        }


        return $products;
        */
    }






    /*  public function registrar(){
        require_once "../views/usuarios/registrarUsuario.php";
    }
    public function alta(){
       if (isset($_POST)){
         require_once "../models/usuario.php";
         $administrador = new Administrador();
         $administrador->setUsername($_POST['username']);
         $administrador->setPassword($_POST['password']);
         $administrador->conectar();
         echo "".$administrador->insertar();
       }  

    }
*/
    public function iniciarLogin()
    {
        require_once "./views/adminLogin.php";
    }
    public function login()
    {
        if (isset($_SESSION["role"])) {
            $role = $_SESSION['role'];
        } else {
            $role = "";
        }
        if ($role != "admin") {
            if (isset($_POST)) {
                require_once "./models/administrador.php";
                $administrador = new Administrador();
                $administrador->setUsername($_POST['username']);
                $administrador->setPassword($_POST['password']);
                $administrador->conectar();
                if ($administrador->loginAdmin()) {
                    echo "Bienvenido " . $administrador->getUsername();


                    //reload website
                    header("Location: admin.php");
                    $nombreController = "AdministradorController";
                    $controlador = new $nombreController();
                    $action = "mostrarTodos";
                    $controlador->$action();
                    echo "Bienvenido " . $_SESSION['role'];
                } else {
                    echo "Usuario o contraseña incorrectos";
                    $this->iniciarLogin();
                }
            } else {
                echo "No se ha recibido nada";
            }
        } else {
            echo "Bienvenido " . $_SESSION['role'];
        }
    }

    public function cerrarSesion()
    {
        session_destroy();
        header("Location: /botiga/index.php");
    }

    public function iniciarAltaProducto()
    {
        require_once "./views/altaProducto.php";
    }

    public function altaProducto()
    {
        if (isset($_POST)) {
            require_once "./models/products.php";
            $producto = new Products();
            $producto->setNombre($_POST['nombre']);
            $producto->setDescripcion($_POST['descripcion']);
            $producto->setCantidad($_POST['cantidad']);
            $producto->setPrecio($_POST['precio']);
            $producto->setCategoria($_POST['categoria']);
            $producto->setFoto($_POST['foto']);
            $producto->conectar();
            echo "" . $producto->insertarProducto();
        }
    }

    public function modificar()
    {
    }
    public function eliminar()
    {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            require_once "./models/products.php";
            $producto = new Products();
            $producto->setIdProducto($id);
            $producto->conectar();
            echo "" . $producto->eliminarProducto();

            require_once "./models/administrador.php";
            require_once "./models/products.php";
            $administrador = new Administrador();
    
            $todosLosProductos = $administrador->mostrarTodos();
    
            require_once "./views/mostrarProductos.php";
    

        } else {
            $id = "";
            echo "Error, no se ha encontrado el producto";
        }
    }
    public function activar()
    {
        echo "Estoy en activar";
    }
    public function ver()
    {
        echo "Estoy en ver";
    }
}
