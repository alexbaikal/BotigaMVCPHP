<h1>Lista de pedidos</h1>

<!--Box containing data for each $todosLosPedidos-->

<?php
foreach ($todosLosPedidos as $pedido) {
    echo "<div class='box'>";
    echo "<div class='box-header'>";
    echo "<h3 class='box-title'>Referencia nº " . $pedido['id_pedido'] . "</h3>";
    echo "</div>";
    echo "<div class='box-body'>";
    echo "<table class='table table-bordered'>";
    echo "<tr>";
    echo "<th>Fecha</th>";
    echo "<th>Num. seguimiento</th>";
    echo "<th>Transportista</th>";
    echo "<th>Estado</th>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . $pedido['fecha'] . "</td>";
    echo "<td>" . $pedido['num_seguimiento'] . "</td>";
    echo "<td>";
    //get name of transportista from $transportistasArray
    foreach ($transportistasArray as $transportista) {
        if ($transportista['id_empresa_transporte'] == $pedido['fk_id_empresa_transporte']) {
            echo $transportista['nombre_empresa_transporte'];
        }
    }
    echo "</td>";
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
    "</td>";
    echo "</tr>";
    echo "</table>";
    echo "</div>";
    
}