


<h2>Modificar producto</h2>
<!--Crear un form con action="admin.php?controller=Administrador&action=iniciarAltaProducto" method="post" y que tenga control de entrada (nombre tiene que ser un texto, precio tiene que ser un float, etc...)-->
<?php
?>
<form action="admin.php?controller=Administrador&action=modificarProducto" method="post">
    <input type="hidden" name="id" value="<?php echo $producto->getIdProducto(); ?>">
    Nombre:
    <input type="text" name = "nombre" value="<?php echo $producto->getNombre() ?>">
    <br/>

    Descripción:
    <input type="text" name = "descripcion" value="<?php echo $producto->getDescripcion() ?>">
    <br/>

    Cantidad:
    <input type="number" name = "cantidad"  value="<?php echo $producto->getCantidad() ?>">
    <br/>

    Precio:
    <input type="text" name = "precio"  value="<?php echo $producto->getPrecio() ?>">
    <br/>

    Categoria:
    <input type="number" name = "categoria"  value="<?php echo $producto->getCategoria() ?>">
    <br/>

    Activo:
    <input type="checkbox" name = "isactive" <?php if ($producto->getIsActive() == 1) {
        echo "checked";
    } else {
        echo "";
    } ?>>
    

    Imagen:
    <input type="text" name = "foto"  value="<?php echo $producto->getFoto() ?>">
    <input type = "submit" value="Modificar producto">
    <br/>

</form>

