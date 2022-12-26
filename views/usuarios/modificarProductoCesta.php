<h2>Modificar producto</h2>


<form action="index.php?controller=Cesta&action=modificarProductoCesta" method="post">

    <input type="hidden" name="id_cesta" value="<?php echo $cesta->getIdCesta(); ?>">


    Nombre:
    <p><?php echo $cesta->getProductoNombre() ?></p>
    <input type="hidden" name="id_producto" value="<?php echo $cesta->getIdProducto() ?>">

    <br />

    Cantidad:
    <input type="text" name="cantidad" value="<?php echo $cesta->getCantidadProductoCesta() ?>">
    <br />


    <input type="submit" value="Modificar">

    <?php

    //get json encoded products in getListaProductos() and decode it
    $todosLosProductosCesta = $cesta->getListaProductos();
    require_once "./views/usuarios/mostrarProductosCesta.php";

    ?>
</form>