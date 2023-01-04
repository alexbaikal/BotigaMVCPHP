<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php
if ($_SESSION['role'] == 'admin') {
    echo "<a href='admin.php?controller=Pedido&action=iniciarAltaPedido' class='btn btn-primary'>Añadir pedido</a>";
    echo "<table border='1'>";
    echo "<p>Lista de pedidos:</p>";
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
        //create an options list with the transportistas, select the one that is in the database ($pedido->getFkIdEmpresaTransporte())
        echo "<td>";
        //get name of transportista from $transportistasArray
        foreach ($transportistasArray as $transportista) {
            if ($transportista['id_empresa_transporte'] == $pedido['fk_id_empresa_transporte']) {
                echo $transportista['nombre_empresa_transporte'];
            }
        }
        
        echo "</td>";
        echo "<td>" . $pedidos->getNombreUsuario($pedido['fk_id_usuario']) . "</td>";
        echo "<td>" . $pedido['num_seguimiento'] . "</td>";



        echo "<td>";
        for ($i = 0; $i < 5; $i++) {
            if ($i == $pedido['estado']) {
                if ($i == 0) {
                    echo "Pendiente";
                } else if ($i == 1) {
                    echo "Enviado";
                } else if ($i == 2) {
                    echo "En reparto";
                } else if ($i == 3) {
                    echo "Entregado";
                }
            }
        }
        echo "</td>";




        //formatear fecha de timestamp a dd/mm/yyyy HH:MM
        $fecha = date("d/m/Y H:i", $pedido['fecha']);
        echo "<td>" . $fecha . "</td>";
        


        //echo "<td><a href='?controller=Administrador&action=eliminadPedido&id_pedido=" . $pedido['id_pedido'] . "'>Eliminar</a><br/>";
        echo "<td><a href='?controller=Pedido&action=iniciarModificarPedido&id_pedido=" . $pedido['id_pedido'] . "'>Modificar</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    
} else {
    echo "<p>No tienes permisos para ver esta página</p>";
    //redirect to admin.php after 3 seconds
    header("Refresh:3; url=admin.php");
}
?>