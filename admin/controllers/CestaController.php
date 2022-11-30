<?php

class CestaController {
    public function iniciarModificarCesta()
    {


        if (isset($_GET['id_cesta'])) {
            $id = $_GET['id_cesta'];

            require_once "./models/cesta.php";

            $cesta = new Cesta();
            $cesta->setIdCesta($id);
            $cesta->conectar();
            $cesta->fetchCesta();
            require_once "./views/modificarCesta.php";

            require_once "./models/administrador.php";

          
        } else {
            $id = "";
            echo "Error, no se ha encontrado el producto";
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
        //if POST is set
        if (isset($_POST['id_producto'])) {
            $id_producto = $_POST['id_producto'];
            $id_cesta = $_POST['id_cesta'];
            $cantidad_cesta = $_POST['cantidad_cesta'];

            require_once "./models/product.php";
            $producto = new Product();
            $producto->setIdProducto($id_producto);
            $producto->setIdCesta($id_cesta);
            $producto->setCantidadCesta($cantidad_cesta);
            $producto->conectar();
            $producto->añadirProductoCesta();

          

    
    
    
            $todosLosProductos = $producto->mostrarProductos();
    
    
            
            require_once "./views/altaProductoCesta.php";
    
            

        } else {
            echo "Error, no se ha encontrado el producto";
        }
        
    }

    public function eliminarProducto() {
        if (isset($_GET['id_producto'])) {
            $id_producto = $_GET['id_producto'];
            $id_cesta = $_GET['id_cesta'];

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

    public function iniciarModificarProducto()
    {


        if (isset($_GET['id_cesta'])) {
            $id = $_GET['id_cesta'];
            $id_producto = $_GET['id_producto'];

            require_once "./models/cesta.php";

            $cesta = new Cesta();
            $cesta->setIdCesta($id);
            $cesta->setIdProducto($id_producto);
            $cesta->conectar();
            $cesta->fetchCesta();
            require_once "./views/modificarProductoCesta.php";

            require_once "./models/administrador.php";

          
        } else {
            $id = "";
            echo "Error, no se ha encontrado el producto";
        }
    }


}

?>