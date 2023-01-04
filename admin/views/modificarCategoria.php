


<h2>Modificar categoría</h2>


<form action="admin.php?controller=Administrador&action=modificarCategoria" method="post">
    
    <input type="hidden" name="id_categoria" value="<?php echo $categoria->getIdCategoria(); ?>">


    Nombre:
    <input type="text" name = "nombre" value="<?php echo $categoria->getNombre() ?>">
    <br/>

    Descripción:
    <input type="text" name = "descripcion" value="<?php echo $categoria->getDescripcion() ?>">
    <br/>

    Activo:
    <input type="checkbox" name = "isactive" <?php if ($categoria->getIsActive() == 1) {
        echo "checked";
    } else {
        echo "";
    } ?>>
    
    <input type = "submit" value="Modificar categoria">
    <br/>

</form>

