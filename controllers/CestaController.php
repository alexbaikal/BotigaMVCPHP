<?php

class CestaController {
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
            $id = "";
            echo "Error, no se ha encontrado el producto!";
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

    public function añadirProductoCesta() {
        //if GET is set
        if (isset($_GET['id_producto'])) {
            $id_producto = $_GET['id_producto'];

            if (isset($_SESSION['role'])) {
                require_once "./models/cesta.php";
                $cesta = new Cesta();
                $cesta->setFkIdUsuario($_SESSION['user_id']);
                $cesta->setCantidadProductoCesta(1);
                $cesta->setIdProducto($id_producto);
                $cesta->conectar();
                $cesta->fetchCesta();
                $cesta->añadirProductoCesta();

                echo "Producto añadido a la cesta.";
                
                //after 3 seconds redirect to index
                header("refresh:3;url=index.php?controller=Usuario&action=mostrarTodos");


                
            } else {
                //por hacer
            }



            

        } else {
            echo "Error, no se ha encontrado el producto";
        }
        
    }

    public function eliminarProductoCesta() {
        if (isset($_GET['fk_id_producto'])) {
            $id_producto = $_GET['fk_id_producto'];
            $id_cesta = $_GET['fk_id_cesta'];

            require_once "./models/product.php";
            $producto = new Product();
            $producto->setIdProducto($id_producto);
            $producto->setIdCesta($id_cesta);
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

            require_once "./models/cesta.php";

            $cesta = new Cesta();
            $cesta->setIdCesta($id_cesta);
            $cesta->setIdProducto($id_producto);
            $cesta->setCantidadProductoCesta($cantidad);
            $cesta->conectar();
            $cesta->fetchCesta();
            $cantidad = $cesta->getCantidadProductoCesta();
            require_once "./views/modificarProductoCesta.php";

            require_once "./models/administrador.php";

          
        } else {
            $id = "";
            echo "Error, no se ha encontrado el producto";
        }
    }

    public function modificarProductoCesta() {
        if (isset($_POST['id_cesta'])) {
            $id_cesta = $_POST['id_cesta'];
            $id_producto = $_POST['id_producto'];
            $cantidad = $_POST['cantidad'];

            require_once "./models/cesta.php";
            $cesta = new Cesta();
            $cesta->setIdCesta($id_cesta);
            $cesta->setIdProducto($id_producto);
            $cesta->setCantidadProductoCesta($cantidad);
            $cesta->conectar();
            $cesta->fetchCesta();
            $cesta->modificarProductoCesta();

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
    
    function modificarCesta() {
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


}

?>