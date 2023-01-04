<h2>Checkout</h2>



<?php

//get products in getListaProductos()
$todosLosProductosCesta = $cesta->getListaProductos();

require_once "./views/usuarios/mostrarCheckout.php";
?>
Nombre:
<?php
echo $cesta->getNombreUsuario();
?>
<br />
Total:
<?php echo $cesta->getPrecioTotal() . "€"; ?>

<?php

require_once "./models/pedido.php";

$pedido = new Pedido();





$transportistasArray = $pedido->getTransportistas();


?>


<?php



//check if $todosLosProductosCesta is not empty, then show button to confirm purchase
if (!empty($todosLosProductosCesta)) {
    echo "<br/>";
    echo "<form action='?controller=UsuarioPedido&action=generateCheckout' method='post'>";



    echo "Empresa transporte:";

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
    echo "<br />";
    echo "<br />";

    echo "<input type='submit' value='Confirmar compra'>";
    echo "</form>";
}

?>