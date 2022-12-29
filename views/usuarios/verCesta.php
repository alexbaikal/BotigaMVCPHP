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

    //check if $todosLosProductosCesta is not empty, then show button to confirm purchase
    if (!empty($todosLosProductosCesta)) {
        echo "<br/>";
      echo "<form action='?controller=Cesta&action=confirmarCompra' method='post'>";
      echo "<input type='submit' value='Check out'>";
      echo "</form>";
    }

    ?>
