


<h2 id="titulo_modcestapedidos">Modificar categoría</h2>


<form action="admin.php?controller=Administrador&action=modificarCategoria" method="post" id="form_modcategoria">
    
    <input type="hidden" name="id_categoria" value="<?php echo $categoria->getIdCategoria(); ?>">


    
    <input class="mod_categorias" type="text" name = "nombre" value="<?php echo $categoria->getNombre() ?>" placeholder="Nombre">
    <br/>

    
    <input class="mod_categorias" type="text" name = "descripcion" value="<?php echo $categoria->getDescripcion() ?>" placeholder="Descripción">
    <br/>

    <p id="activo_modcategorias">Activo</p>
    <input type="checkbox" name = "isactive" <?php if ($categoria->getIsActive() == 1) {
        echo "checked";
    } else {
        echo "";
    } ?>>
    
    <input id="submit_modcategorias" type = "submit" value="Modificar categoria">
    <br/>

</form>

