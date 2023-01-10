


<h2 id="modificar_user_titulo">Modificar usuario</h2>
<!--Crear un form con action="admin.php?controller=Administrador&action=iniciarAltaProducto" method="post" y que tenga control de entrada (nombre tiene que ser un texto, precio tiene que ser un float, etc...)-->
<?php
?>
<form action="index.php?controller=Usuario&action=modificarUsuario" method="post" id="form_moduser">
   
    <input type="hidden" name = "user_id" value="<?php echo $_SESSION['user_id'] ?>">
    <br/>

    <p id="activo_moduser">Correo:</p>
    <input class="mod_user" type="text" name = "correo" value="<?php echo $user_data[0]['correo'] ?>" readonly>
    <br/>

    <p id="activo_moduser">Nombre:</p>
    <input class="mod_user" type="text" name = "nombre" value="<?php echo $user_data[0]['nombre'] ?>">
    <br/>

    <p id="activo_moduser">Dirección:</p>
    <input class="mod_user" type="text" name = "direccion" value="<?php echo $user_data[0]['direccion'] ?>">
    <br/>

    <p id="activo_moduser">Provincia:</p>
    <input class="mod_user" type="text" name = "provincia" value="<?php echo $user_data[0]['provincia'] ?>">
    <br/>

    <p id="activo_moduser">Código postal:</p>
    <input class="mod_user" type="text" name = "cp" value="<?php echo $user_data[0]['cp'] ?>">
    <br/>

    <p id="activo_moduser">Teléfono:</p>
    <input class="mod_user" type="text" name = "telefono" value="<?php echo $user_data[0]['telefono'] ?>">
    <br><br/>
    <input id="submit_moduser" type = "submit" value="Modificar datos">
    

</form>

