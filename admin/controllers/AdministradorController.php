<?php
class AdministradorController
{
    //El controller tiene las diferentes acciones que se pueden hacer 



    public function iniciarVistaProductos()
    {

        require_once "./models/administrador.php";
        require_once "./models/product.php";
        $administrador = new Administrador();

        $todosLosProductos = $administrador->mostrarProductos();

        require_once "./views/mostrarProductos.php";


    }



    public function iniciarVistaCategorias()
    {

        require_once "./models/administrador.php";
        require_once "./models/category.php";
        $administrador = new Administrador();

        $todasLasCategorias = $administrador->mostrarCategorias();
        require_once "./views/mostrarCategoria.php";


    } 




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
                    $action = "mostrarProductos";
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
            require_once "./models/product.php";
            $producto = new Product();
            $producto->setNombre($_POST['nombre']);
            $producto->setDescripcion($_POST['descripcion']);
            $producto->setCantidad($_POST['cantidad']);
            $producto->setPrecio($_POST['precio']);
            $producto->setCategoria($_POST['categoria']);
            $producto->setFoto($_POST['foto']);
            if (isset($_POST['isactive'])) {
                $producto->setIsActive(1);
            } else {
                $producto->setIsActive(0);
            }
            $producto->conectar();
            echo "" . $producto->insertarProducto();

            
            require_once "./models/administrador.php";
            $administrador = new Administrador();
    
            $todosLosProductos = $administrador->mostrarProductos();
    
            require_once "./views/mostrarProductos.php";
    
        }
    }

    public function activarProducto()
    {
        if (isset($_POST)) {
            require_once "./models/product.php";
            $producto = new Product();
            $producto->setIdProducto($_POST['id_producto']);
            if (isset($_POST['isactive'])) {
                $producto->setIsActive(1);
            } else {
                $producto->setIsActive(0);
            }
            $producto->conectar();
            echo "" . $producto->activarProducto();

            
            require_once "./models/administrador.php";
            $administrador = new Administrador();
    
            $todosLosProductos = $administrador->mostrarProductos();
    
            require_once "./views/mostrarProductos.php";
    

        }
    }
    

    public function modificarProducto()
    {
        if (isset($_POST)) {
            require_once "./models/product.php";
            $producto = new Product();

            $producto->setIdProducto($_POST['id']);
            $producto->setNombre($_POST['nombre']);
            $producto->setDescripcion($_POST['descripcion']);
            $producto->setCantidad($_POST['cantidad']);
            $producto->setPrecio($_POST['precio']);
            $producto->setCategoria($_POST['categoria']);
            $producto->setFoto($_POST['foto']);
            if (isset($_POST['isactive'])) {
                $producto->setIsActive(1);
            } else {
                $producto->setIsActive(0);
            }

            $producto->conectar();

            echo "" . $producto->modificarProducto();


            require_once "./models/administrador.php";
            $administrador = new Administrador();
    
            $todosLosProductos = $administrador->mostrarProductos();
    
            require_once "./views/mostrarProductos.php";



            
        //    return "Producto modificado: ".$_POST['nombre']."<br/>";
        }
    }

    public function modificar()
    {

        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            require_once "./models/product.php";

            $producto = new Product();
            $producto->setIdProducto($id);
            $producto->conectar();
            $producto->fetchProduct();
            require_once "./views/modificarProducto.php";

            require_once "./models/administrador.php";
            $administrador = new Administrador();
    
            $todosLosProductos = $administrador->mostrarProductos();
    
            require_once "./views/mostrarProductos.php";
    

        } else {
            $id = "";
            echo "Error, no se ha encontrado el producto";
        }


    }
    public function eliminar()
    {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            require_once "./models/product.php";
            $producto = new Product();
            $producto->setIdProducto($id);
            $producto->conectar();
            echo "" . $producto->eliminarProducto();

            require_once "./models/administrador.php";
            require_once "./models/product.php";
            $administrador = new Administrador();
    
            $todosLosProductos = $administrador->mostrarProductos();
    
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
