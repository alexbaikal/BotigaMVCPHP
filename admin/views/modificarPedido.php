


<h2>Modificar pedido</h2>


<form action="admin.php?controller=Pedido&action=modificarPedido" method="post">
    
    <input type="hidden" name="id_pedido" value="<?php echo $pedido->getIdPedido(); ?>">
    <input type="hidden" name="fk_id_usuario" value="<?php echo $pedido->getFkIdUsuario(); ?>">

    Cliente:

    <?php
    $nombre_cliente = $pedido->getClientName();
    echo $nombre_cliente;
    ?>
    
    <br/>

    
    Empresa transporte:
    <?php
    //create an options list with the transportistas, select the one that is in the database ($pedido->getFkIdEmpresaTransporte())
    echo "<select name='fk_id_empresa_transporte'>";
    foreach ($transportistasArray as $transportista) {
        if ($transportista['id_empresa_transporte'] == $pedido->getFkIdEmpresaTransporte()) {
            echo "<option value='" . $transportista['id_empresa_transporte'] . "' selected>" . $transportista['nombre_empresa_transporte'] . "</option>";
        } else {
            echo "<option value='" . $transportista['id_empresa_transporte'] . "'>" . $transportista['nombre_empresa_transporte'] . "</option>";
        }
    }
    echo "</select>";

    ?>
    <br/>

    
    Num. seguimiento:
    <input type="text" name = "num_seguimiento" value="<?php echo $pedido->getNumSeguimiento() ?>">
    <br/>
    Estado:
    <?php
    //create a select option using a for loop, if $pedido->getEstado() = 0, option inner text = "pendiente", if $pedido->getEstado() = 1, select "enviado", if $pedido->getEstado() = 2, select "en reparto", if $pedido->getEstado() = 3, select "entregado"
    echo "<select name='estado'>";
    for ($i = 0; $i < 5; $i++) {
        if ($i == $pedido->getEstado()) {
            if ($i == 0) {
                echo "<option value='" . $i . "' selected>" . "Pendiente" . "</option>";
            } else if ($i == 1) {
                echo "<option value='" . $i . "' selected>" . "Enviado" . "</option>";
            } else if ($i == 2) {
                echo "<option value='" . $i . "' selected>" . "En reparto" . "</option>";
            } else if ($i == 3) {
                echo "<option value='" . $i . "' selected>" . "Entregado" . "</option>";
            }
        } else {
            if ($i == 0) {
                echo "<option value='" . $i . "'>" . "Pendiente" . "</option>";
            } else if ($i == 1) {
                echo "<option value='" . $i . "'>" . "Enviado" . "</option>";
            } else if ($i == 2) {
                echo "<option value='" . $i . "'>" . "En reparto" . "</option>";
            } else if ($i == 3) {
                echo "<option value='" . $i . "'>" . "Entregado" . "</option>";
            }
        }
    }
    echo "</select>";
    ?>
    <br/>
    Fecha:
    <?php
    //$pedido->getFecha() comes in a timestamp format, create an html input type="date" with time also with that value
    $fecha = date("Y-m-d", $pedido->getFecha());
    $hora = date("H:i", $pedido->getFecha());
    echo "<input type='date' name='fecha' value='" . $fecha . "'>";
    echo "<input type='time' name='hora' value='" . $hora . "'>";


    ?>
    <br/>
    
    
    Cesta:
    <!--boton para ir a modificar la cesta que pase el fk_id_cesta-->
    <a href="admin.php?controller=Cesta&action=iniciarModificarCesta&id_cesta=<?php echo $pedido->getFkIdCesta(); ?>" class="btn btn-primary">Modificar cesta</a>
    <br/>
    <br/>
    <input type = "submit" value="Modificar pedido">
    <br/>
    <br/>


</form>

