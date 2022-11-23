


<h2>Modificar pedido</h2>


<form action="admin.php?controller=Administrador&action=modificarPedido" method="post">
    
    <input type="hidden" name="id_pedido" value="<?php echo $pedido->getIdPedido(); ?>">


    Cesta:
    <!--boton para ir a modificar la cesta que pase el fk_id_cesta-->
    <a href="admin.php?controller=Administrador&action=iniciarModificarCesta&id_cesta=<?php echo $pedido->getFkIdCesta(); ?>" class="btn btn-primary">Modificar cesta</a>
    <br/>

    Empresa transporte:
    <input type="text" name = "fk_id_empresa_transporte" value="<?php echo $pedido->getFkIdEmpresaTransporte() ?>">
    <br/>

    Cliente:
    <input type="text" name = "fk_id_usuario" value="<?php echo $pedido->getFkIdUsuario() ?>">
    <br/>
    Num. seguimiento:
    <input type="text" name = "num_seguimiento" value="<?php echo $pedido->getNumSeguimiento() ?>">
    <br/>
    Estado:
    <input type="text" name = "estado" value="<?php echo $pedido->getEstado() ?>">
    <br/>
    Fecha:
    <input type="text" name = "fecha" value="<?php echo $pedido->getFecha() ?>">
    <br/>
    
    <input type = "submit" value="Modificar pedido">
    <br/>

</form>

