<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php

  //add product button
  if ($_SESSION['role'] == 'admin') {
  

   echo "<table border='1'>";
  
  
    echo "<p>Productos dentro de cesta</p>";
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Nombre producto</th>";
    echo "<th>Id</th>";
    echo "<th>Cantidad</th>";
    echo "</tr>";

  if (isset($todosLosProductosCesta)) {
    foreach ($todosLosProductosCesta as $producto) {
      echo "<tr>";
      //get nombre from productos where id_producto = id_producto
      echo "<td>". $producto['nombre'] . "</td>";
      echo "<td>".$producto['fk_id_producto']."</td>";
      echo "<td>". $producto['cantidad'] . "</td>";
      echo "<td><a href='?controller=Cesta&action=eliminarProductoCesta&fk_id_producto=".$producto['fk_id_producto']."&fk_id_cesta=".$cesta->getIdCesta()."'>Eliminar</a></td>";
      echo "<td><a href='?controller=Cesta&action=iniciarModificarProductoCesta&fk_id_producto=".$producto['fk_id_producto']."&fk_id_cesta=".$cesta->getIdCesta()."&cantidad=".$producto['cantidad']."'>Modificar</a></td>";
   
      //create a checkbox form to change the active status of the product
      echo "<form action='?controller=Administrador&action=activarProducto' method='post'>";
      echo "<input type='hidden' name='fk_id_producto' value='".$producto['fk_id_producto']."'>";
    
      echo "</form>";
      echo "</tr>";
  }
  } else {

    echo "<p>No hay productos en la cesta</p>";

  }
    echo "</table>";
} else {
  echo "<p>Debes ser administrador para ver esta pagina</p>";
  //refresh after 3 seconds
  header("Refresh:3; url=admin.php");
}

?>