<?php

class CestaController
{
    public function iniciarModificarCesta()
    {

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            require_once "./models/cesta.php";

            $cesta = new Cesta();
            $cesta->setFkIdUsuario($user_id);
            $cesta->conectar();

            $cesta->fetchCesta();

            require_once "./views/usuarios/verCesta.php";
        } else {
            //por hacer
            echo "Hay que estar autentificado primero.";

            //after 3 seconds redirect to index
            header("refresh:1;url=index.php?controller=Usuario&action=mostrarTodos");
        }
    }


    public function iniciarAltaProductoCesta()
    {
        require_once "./models/product.php";
        $producto = new Product();

        $producto->conectar();


        $todosLosProductos = $producto->mostrarProductos();



        require_once "./views/altaProductoCesta.php";
    }

    public function añadirProductoCesta()
    {
        //if GET is set
        if (isset($_POST)) {
            $id_producto = $_GET['id_producto'];
            $cantidad_producto = $_POST['cantidad'];

            if (isset($_SESSION['role'])) {
                if ($cantidad_producto > 0 ) {
                    require_once "./models/cesta.php";
                    $cesta = new Cesta();
                    $cesta->setFkIdUsuario($_SESSION['user_id']);
                    $cesta->setCantidadProductoCesta($cantidad_producto);
                    $cesta->setIdProducto($id_producto);
                    $cesta->conectar();
                    $cesta->fetchCesta();
                    $cesta->añadirProductoCesta();
    
                    echo "Producto añadido a la cesta.";
    
                    //after 3 seconds redirect to index
                    header("refresh:1;url=index.php?controller=Usuario&action=mostrarTodos");
                } else {
                    echo "La cantidad debe ser mayor que 0";
                    header("refresh:1;url=index.php?controller=Usuario&action=mostrarTodos");
                }
               
            } else {
                //por hacer
                echo "Hay que estar autentificado primero.";

                //after 3 seconds redirect to index
                header("refresh:2;url=index.php?controller=Usuario&action=mostrarTodos");
            }
        } else {
            echo "Error, no se ha encontrado el producto";
        }
    }

    public function eliminarProductoCesta()
    {
        if (isset($_GET['fk_id_producto'])) {
            $id_producto = $_GET['fk_id_producto'];
            $id_cesta = $_GET['fk_id_cesta'];
            $cantidad_producto_cesta = $_GET['cantidad'];

            require_once "./models/product.php";
            $producto = new Product();
            $producto->setIdProducto($id_producto);
            $producto->setIdCesta($id_cesta);
            $producto->setCantidadProductoCesta($cantidad_producto_cesta);
            $producto->conectar();
            $producto->eliminarProductoCesta();

            require_once "./models/cesta.php";

            $cesta = new Cesta();
            $cesta->setIdCesta($id_cesta);
            $cesta->conectar();
            $cesta->fetchCesta();
            require_once "./views/modificarCesta.php";

            require_once "./models/administrador.php";
        } else {
            echo "Error, no se ha encontrado el producto";
        }
    }

    public function iniciarModificarProductoCesta()
    {


        if (isset($_GET['fk_id_cesta'])) {
            $id_cesta = $_GET['fk_id_cesta'];
            $id_producto = $_GET['fk_id_producto'];
            $cantidad = $_GET['cantidad'];
            $id_usuario = $_SESSION['user_id'];

            require_once "./models/cesta.php";

            $cesta = new Cesta();
            $cesta->setIdCesta($id_cesta);
            $cesta->setIdProducto($id_producto);
            $cesta->setCantidadProductoCesta($cantidad);
            $cesta->setFkIdUsuario($id_usuario);
            $cesta->setProductoNombre($id_producto);
            $cesta->conectar();
            $cesta->fetchCesta();
            $cantidad = $cesta->getCantidadProductoCesta();
            require_once "./views/usuarios/modificarProductoCesta.php";
        } else {
            $id = "";
            echo "Error, no se ha encontrado el producto";
        }
    }

    public function modificarProductoCesta()
    {
        if (isset($_POST['id_cesta'])) {
            $id_cesta = $_POST['id_cesta'];
            $id_producto = $_POST['id_producto'];
            $cantidad = $_POST['cantidad'];
            $id_usuario = $_SESSION['user_id'];

            require_once "./models/cesta.php";
            $cesta = new Cesta();
            $cesta->setIdCesta($id_cesta);
            $cesta->setIdProducto($id_producto);
            $cesta->setCantidadProductoCesta($cantidad);
            $cesta->setFkIdUsuario($id_usuario);
            $cesta->conectar();
            $cesta->fetchCesta();
            $cesta->modificarProductoCesta();

            require_once "./models/cesta.php";

            $cesta = new Cesta();
            $cesta->setIdCesta($id_cesta);
            $cesta->conectar();
            $cesta->setFkIdUsuario($id_usuario);
            $cesta->fetchCesta();
            require_once "./views/usuarios/verCesta.php";



            
        } else {
            echo "Error, no se ha encontrado el producto";
        }
    }

    function modificarCesta()
    {
        if (isset($_POST['id_cesta'])) {
            $precio_total = $_POST['precio_total'];
            $id_cesta = $_POST['id_cesta'];

            //modify database
            require_once "./models/cesta.php";
            $cesta = new Cesta();
            $cesta->setIdCesta($id_cesta);
            $cesta->conectar();
            $cesta->fetchCesta();
            $cesta->setPrecioTotal($precio_total);

            $cesta->modificarCesta();


            $cesta->conectar();
            $cesta->fetchCesta();
            require_once "./views/modificarCesta.php";
        }
    }
    function confirmarCompra() {
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            require_once "./models/cesta.php";

            $cesta = new Cesta();
            $cesta->setFkIdUsuario($user_id);
            $cesta->conectar();

            $cesta->fetchCesta();

            require_once "./views/usuarios/verCheckout.php";
        } else {
            //por hacer
            echo "Hay que estar autentificado primero.";

            //after 3 seconds redirect to index
            header("refresh:1;url=index.php?controller=Usuario&action=mostrarTodos");
        }
    }
}
