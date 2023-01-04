<?php
if (isset($_SESSION['user_id'])) {
    echo "Bienvenido, " . $nombre_usuario['nombre'];
    echo "<br>";
    echo "<a href='index.php?controller=Usuario&action=logout'>Cerrar sesión</a>";
} else {
    echo "<a href='index.php?controller=Usuario&action=loginUsuario'>Iniciar sesión</a><br>";
    echo "<a href='index.php?controller=Usuario&action=registrarUsuario' >Registrarse </a>";
}
?>
<ul>
    <!--<li> <a href= "index.php?controller=Usuario&action=modificar" >Modificar usuario </a></li>
    <li> <a href= "index.php?controller=Usuario&action=eliminar" >Eliminar usuario </a></li>-->
    <li> <a href="admin/admin.php">Panel Admin</a></li>
    <li> <a href="index.php?controller=Usuario&action=mostrarTodos">Volver </a></li>
</ul>

<!--Tabs with dynamically generated categories-->
<!--On tab clicked, redirect passing the id_categoria-->
<?php
if (isset($categorias)) {
    echo "<ul class='nav nav-tabs'>";
    foreach ($categorias as $categoria) {
        if (isset($_GET['id_categoria'])) {

            if ($categoria['id_categoria'] == $_GET['id_categoria']) {
                echo "<li class='nav-item active'>";

            } else if ($categoria['id_categoria'] == $_GET['id_categoria'] && $categoria['id_categoria'] == 1) {
                echo "<li class='nav-item active'>";
            } else {
                echo "<li class='nav-item'>";
            }
        } else {
            echo "<li class='nav-item'>";
        }

        echo "<a class='nav-link' href='index.php?controller=Usuario&action=mostrarCategoria&id_categoria=" . $categoria['id_categoria'] . "'>" . $categoria['nombre'] . "</a>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "No hay categorias";
}
?>
