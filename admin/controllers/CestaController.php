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
}

?>