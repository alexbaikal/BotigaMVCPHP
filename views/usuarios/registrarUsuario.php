<h2>Registrar un usuario nuevo</h2>
<form action="index.php?controller=Usuario&action=alta" method="post">
    <!--Nombre, correo, teléfono, contraseña, dirección, provincia, cp-->
    Nombre y apellidos:
    <input type="text" name = "nombre">
    <br>
    Correo:
    <input type="text" name = "correo">
    <br>
    Teléfono:
    <input type="text" name = "telefono">
    <br>
    Contraseña:
    <input type="text" name = "contrasena">
    <br>
    Dirección:
    <input type="text" name = "direccion">
    <br>
    Provincia:
    <input type="text" name = "provincia">
    <br>
    Código postal:
    <input type="text" name = "cp">  
    <br>
    <input type = "submit" value="Registrarse">
</form>