


<h2 id="modificar_producto_titulo">Modificar producto</h2>
<!--Crear un form con action="admin.php?controller=Administrador&action=iniciarAltaProducto" method="post" y que tenga control de entrada (nombre tiene que ser un texto, precio tiene que ser un float, etc...)-->
<?php
?>
<form action="admin.php?controller=Administrador&action=modificarProducto" method="post" id="form_modproducto">
    <input type="hidden" name="id" value="<?php echo $producto->getIdProducto(); ?>">
    
    <input class="mod_productos" type="text" name = "nombre" value="<?php echo $producto->getNombre() ?>" placeholder="Nombre">
    <br/>

    
    <input class="mod_productos" type="text" name = "descripcion" value="<?php echo $producto->getDescripcion() ?>" placeholder="Descripción">
    <br/>

    
    <input class="mod_productos" type="number" name = "cantidad"  value="<?php echo $producto->getCantidad() ?>" placeholder="Cantidad">
    <br/>

    
    <input class="mod_productos" type="text" name = "precio"  value="<?php echo $producto->getPrecio() ?>" placeholder="Precio">
    <br/>

    
    <input class="mod_productos" type="number" name = "categoria"  value="<?php echo $producto->getCategoria() ?>" placeholder="Categoria">
    <br/>

    <p id="activo_modproducto">Activo</p>
    <input type="checkbox" name = "isactive" <?php if ($producto->getIsActive() == 1) {
        echo "checked";
    } else {
        echo "";
    } ?>>
    


    <input class="mod_productos" type="file" name = "foto"  value="<?php echo $producto->getFoto() ?>">
    <input id="submit_modproductos" type = "submit" value="Modificar producto">
    <br/>

</form>

