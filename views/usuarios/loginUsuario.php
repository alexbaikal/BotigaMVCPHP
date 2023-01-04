<h2 id="tituloinico">Iniciar sessió</h2>
<form action="index.php?controller=Usuario&action=login" method="post" id="forminicio">
    <!--Nombre, correo, teléfono, contraseña, dirección, provincia, cp-->
   
    <!-- Correu: -->
    <input class="iniciose" type="text" name = "correo" placeholder="Correo">
    <br>
    <!-- Contrasenya: -->
    <input class="iniciose" type="password" name = "contrasena" placeholder="Contraseña">
   <br>
    <input id="inicioenviar" type = "submit" value="Iniciar sessió">
</form>