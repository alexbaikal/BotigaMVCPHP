<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php

  //add product button
  if (isset($_SESSION['role'])) {
  
  //echo "<a href='admin.php?controller=UsuarioCesta&action=iniciarAltaProductoCesta&id_cesta=".$cesta->getIdCesta()."' class='btn btn-primary'>Añadir producto a la cesta</a>";

   echo "<table border='1'>";
  
  
    echo "<p>Productos a comprar:</p>";
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Nombre producto</th>";
    echo "<th>Cantidad</th>";
    echo "</tr>";

    if (isset($todosLosProductosCesta)) {
      foreach ($todosLosProductosCesta as $producto) {
        echo "<tr>";
        //get nombre from productos where id_producto = id_producto
        echo "<td>". $producto['nombre'] . "</td>";
        echo "<td>". $producto['cantidad'] . "</td>";
        echo "<td><a href='?controller=UsuarioCesta&action=eliminarProductoCesta&fk_id_producto=".$producto['fk_id_producto']."&fk_id_cesta=".$cesta->getIdCesta()."&cantidad=".$producto['cantidad']."'>Eliminar</a></td>";
        echo "<td><a href='?controller=UsuarioCesta&action=iniciarModificarProductoCesta&fk_id_producto=".$producto['fk_id_producto']."&fk_id_cesta=".$cesta->getIdCesta()."&cantidad=".$producto['cantidad']."'>Modificar</a></td>";
     
        //create a checkbox form to change the active status of the product
        echo "<form action='?controller=Administrador&action=activarProducto' method='post'>";
        echo "<input type='hidden' name='fk_id_producto' value='".$producto['fk_id_producto']."'>";
      
        echo "</form>";
        echo "</tr>";
    }
    }

    
    echo "</table>";
} else {
  echo "<p>Debes ser administrador para ver esta pagina</p>";
  //refresh after 3 seconds
  header("Refresh:3; url=admin.php");
}

?>