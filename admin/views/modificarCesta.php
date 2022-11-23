<h2>Modificar cesta</h2>


<form action="admin.php?controller=Administrador&action=modificarCesta" method="post">

    <input type="hidden" name="id_cesta" value="<?php echo $cesta->getIdCesta(); ?>">


    Usuario:
    <input type="text" name="fk_id_usuario" value="<?php echo $cesta->getFkIdUsuario() ?>">
    <br />

    Precio total:
    <input type="text" name="precio_total" value="<?php echo $cesta->getPrecioTotal() ?>">
    <br />


    <input type="submit" value="Modificar">


    <?php
  /*  //ejemplo de lista de productos (id del producto y la cantidad)
    $ejemploListaProductos = array(
        array(
            "id_producto" => 1,
            "cantidad" => 2
        ),
        array(
            "id_producto" => 2,
            "cantidad" => 1
        ),
        array(
            "id_producto" => 3,
            "cantidad" => 3
        )
    );

    //subir a la base de datos

    $SQL = "INSERT INTO cesta (lista_productos) VALUES (?)";

    $stmt = $this->db->prepare($SQL);

    $stmt->bind_param("s", $listaProductos);

    $listaProductos = json_encode($ejemploListaProductos);

    $stmt->execute();

    $stmt->close();*/



    //get json encoded products in getListaProductos() and decode it
    $todosLosProductosCesta = json_decode($cesta->getListaProductos(), true);

    require_once "./views/mostrarProductosCesta.php";

    ?>
</form>