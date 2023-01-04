<h2>Veure cistella</h2>





    Usuario:
    <?php
    echo $cesta->getNombreUsuario();
    ?>
    <br />

    Precio total:
    <?php echo $cesta->getPrecioTotal() . "€";?>
    <br />




    <?php

    //get products in getListaProductos()
    $todosLosProductosCesta = $cesta->getListaProductos();

    require_once "./views/usuarios/mostrarProductosCesta.php";

    ?>
