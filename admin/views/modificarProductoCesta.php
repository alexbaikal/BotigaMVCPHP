<h2>Modificar producto</h2>


<form action="admin.php?controller=Cesta&action=modificarProductoCesta" method="post">

    <input type="hidden" name="id_cesta" value="<?php echo $cesta->getIdCesta(); ?>">


    Nombre:
    <input type="text" name="id_producto" value="<?php echo $cesta->getIdProducto() ?>">
    <br />

    Cantidad:
    <input type="text" name="cantidad" value="<?php echo $cantidad ?>">
    <br />


    <input type="submit" value="Modificar">

    <?php

    //get json encoded products in getListaProductos() and decode it
    $todosLosProductosCesta = json_decode($cesta->getListaProductos(), true);

    require_once "./views/mostrarProductosCesta.php";

    ?>
</form>