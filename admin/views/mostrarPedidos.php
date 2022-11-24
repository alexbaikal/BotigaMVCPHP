<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php
if ($_SESSION['role'] == 'admin') {
    echo "<a href='admin.php?controller=Administrador&action=iniciarAltaPedido' class='btn btn-primary'>Añadir pedido</a>";
    echo "<table border='1'>";
    echo "<p>Esto es un ejemplo de como se puede mostrar la tabla de pedidos</p>";
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Id</th>";
    echo "<th>Cesta</th>";
    echo "<th>Empresa transporte</th>";
    echo "<th>Usuario</th>";
    echo "<th>Num. seguimiento</th>";
    echo "<th>Estado</th>";
    echo "<th>Fecha</th>";
    echo "</tr>";


    foreach ($todosLosPedidos as $pedido) {
        echo "<tr>";
        echo "<td>" . $pedido['id_pedido'] . "</td>";
        echo "<td>" . $pedido['fk_id_cesta'] . "</td>";
        echo "<td>" . $pedido['fk_id_empresa_transporte'] . "</td>";
        echo "<td>" . $pedidos->getNombreUsuario($pedido['fk_id_usuario']) . "</td>";
        echo "<td>" . $pedido['num_seguimiento'] . "</td>";
        echo "<td>" . $pedido['estado'] . "</td>";
        //echo "<td><a href='?controller=Administrador&action=eliminadPedido&id_pedido=" . $pedido['id_pedido'] . "'>Eliminar</a><br/>";
        echo "<td><a href='?controller=Administrador&action=iniciarModificarPedido&id_pedido=" . $pedido['id_pedido'] . "'>Modificar</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    
} else {
    echo "<p>No tienes permisos para ver esta página</p>";
    //redirect to admin.php after 3 seconds
    header("Refresh:3; url=admin.php");
}
?>