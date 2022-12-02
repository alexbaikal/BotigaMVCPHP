<h2>Modificar cesta</h2>


<form action="admin.php?controller=Cesta&action=modificarCesta" method="post">

    <input type="hidden" name="id_cesta" value="<?php echo $cesta->getIdCesta(); ?>">


    Usuario:
    <input type="text" name="fk_id_usuario" value="<?php echo $cesta->getFkIdUsuario() ?>">
    <br />

    Precio total:
    <input type="text" name="precio_total" value="<?php echo $cesta->getPrecioTotal() ?>">
    <br />


    <input type="submit" value="Modificar">


    <?php

    //get products in getListaProductos()
    $todosLosProductosCesta = $cesta->getListaProductos();

    require_once "./views/mostrarProductosCesta.php";

    ?>
</form>