<h2 id="titulo_modcategorias">Modificar cesta</h2>


<form action="admin.php?controller=Cesta&action=modificarCesta" method="post" id="form_modcestapedido">

    <input type="hidden" name="id_cesta" value="<?php echo $cesta->getIdCesta(); ?>">

    <p id="activo_modcestaproducto">Usuario:</p>
    <?php
    echo $cesta->getNombreUsuario();
    ?>
    <br />

    <p id="activo_modcestaproducto">Precio total:</p>
    <input class="mod_cestapedidos" type="text" name="precio_total" value="<?php echo $cesta->getPrecioTotal() ?>">
    <br />


    <input id="submit_modcestapedidos" type="submit" value="Modificar">

</form>
<?php
//get products in getListaProductos()
    $todosLosProductosCesta = $cesta->getListaProductos();

    require_once "./views/mostrarProductosCesta.php";

    ?>