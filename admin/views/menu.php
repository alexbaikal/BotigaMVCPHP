<ul>
    <!-- <li> <a href= "index.php?controller=Usuario&action=registrar" >Registrarse </a></li>
   <li> <a href= "index.php?controller=Usuario&action=modificar" >Modificar usuario </a></li>
    <li> <a href= "index.php?controller=Usuario&action=eliminar" >Eliminar usuario </a></li>-->
    <?php
    //check if the user is logged in (session role is admin and session user_id is set)
    if (isset($_SESSION["role"])) {
        $role = $_SESSION['role'];
    } else {
        $role = "";
    }
    if ($role == 'admin') {

        echo "Bienvenido " . $_SESSION['role'];
        echo '<li> <a href="/botiga/index.php">Volver</a></li>';


        echo "<li> <a href= \"admin.php?controller=Administrador&action=iniciarVistaProductos\" >Mostrar productes</a></li>";
        echo "<li> <a href= \"admin.php?controller=Administrador&action=cerrarSesion\"> Cerrar sessió </a></li>";
    } else {
        echo '<li> <a href="/botiga/index.php">Volver</a></li>';

        echo "<li> <a href= \"admin.php?controller=Administrador&action=iniciarLogin\"> Login </a></li>";
        echo "<li> <a href= \"admin.php?controller=Administrador&action=cerrarSesion\"> Cerrar sessió </a></li>";
    }
    ?>
</ul>