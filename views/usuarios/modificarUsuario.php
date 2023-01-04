


<h2>Modificar usuario</h2>
<!--Crear un form con action="admin.php?controller=Administrador&action=iniciarAltaProducto" method="post" y que tenga control de entrada (nombre tiene que ser un texto, precio tiene que ser un float, etc...)-->
<?php
?>
<form action="index.php?controller=Usuario&action=modificarUsuario" method="post">
   
    <input type="hidden" name = "user_id" value="<?php echo $_SESSION['user_id'] ?>">
    <br/>


    <p>Correo:</p>
    <input type="text" name = "correo" value="<?php echo $user_data[0]['correo'] ?>" readonly>
    <br/>

    <p>Nombre:</p>
    <input type="text" name = "nombre" value="<?php echo $user_data[0]['nombre'] ?>">
    <br/>


    <p>Dirección:</p>
    <input type="text" name = "direccion" value="<?php echo $user_data[0]['direccion'] ?>">
    <br/>

    <p>Provincia:</p>
    <input type="text" name = "provincia" value="<?php echo $user_data[0]['provincia'] ?>">
    <br/>

    <p>Código postal:</p>
    <input type="text" name = "cp" value="<?php echo $user_data[0]['cp'] ?>">
    <br/>

    <p>Teléfono:</p>
    <input type="text" name = "telefono" value="<?php echo $user_data[0]['telefono'] ?>">
    <br><br/>
    <input type = "submit" value="Modificar datos">
    

</form>

