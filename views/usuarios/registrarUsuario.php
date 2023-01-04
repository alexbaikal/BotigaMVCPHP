<h2 id="tituloregistro">Registrar un usuario nuevo</h2>
<form action="index.php?controller=Usuario&action=alta" method="post" id="formregistro">
    <!--Nombre, correo, teléfono, contraseña, dirección, provincia, cp-->
    
    <input class="regist" type="text" name = "nombre" placeholder="Nombre y apellidos">
    <br>
    
    <input class="regist" type="text" name = "correo" placeholder="Correo">
    <br>
    
    <input class="regist" type="text" name = "telefono" placeholder="Teléfono">
    <br>
    
    <input class="regist" type="text" name = "contrasena" placeholder="Contraseña">
    <br>
    
    <input class="regist" type="text" name = "direccion" placeholder="Dirección">
    <br>
    
    <input class="regist" type="text" name = "provincia" placeholder="Provincia">
    <br>
    
    <input class="regist" type="text" name = "cp" placeholder="Código postal">  
    <br>
    <input id="registroenviar" type = "submit" value="Registrarse">
</form>