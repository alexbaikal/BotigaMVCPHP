<?php
if (isset($_SESSION['user_id'])) {
    echo "Bienvenido, ".$nombre_usuario['nombre'];
    echo "<br>";
    echo "<a href='index.php?controller=Usuario&action=logout'>Cerrar sesión</a>";
}
else {
    echo "<a href='index.php?controller=Usuario&action=loginUsuario'>Iniciar sesión</a><br>";
    echo "<a href='index.php?controller=Usuario&action=registrarUsuario' >Registrarse </a>";

}
?>
<ul>
    <!--<li> <a href= "index.php?controller=Usuario&action=modificar" >Modificar usuario </a></li>
    <li> <a href= "index.php?controller=Usuario&action=eliminar" >Eliminar usuario </a></li>-->
    <li> <a href= "admin/admin.php">Panel Admin</a></li>
    <li> <a href= "index.php?controller=Usuario&action=mostrarTodos" >Volver </a></li>
</ul>

<!--Get all categories-->
<?php
//require_once "../../../../models/category.php";

//$category = new Category();
?>
