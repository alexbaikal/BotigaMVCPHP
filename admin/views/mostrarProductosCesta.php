<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php

  //add product button
  if ($_SESSION['role'] == 'admin') {
  
  echo "<a href='admin.php?controller=Cesta&action=iniciarAltaProductoCesta&id_cesta=".$cesta->getIdCesta()."' class='btn btn-primary'>Añadir producto a la cesta</a>";

   echo "<table border='1'>";
  
  
    echo "<p>Esto es un ejemplo de como se puede mostrar la tabla de productos</p>";
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Nombre</th>";
    echo "<th>Cantidad</th>";
    echo "</tr>";
    foreach ($todosLosProductosCesta as $producto) {
      echo "<tr>";
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
    echo "</table>";
} else {
  echo "<p>Debes ser administrador para ver esta pagina</p>";
  //refresh after 3 seconds
  header("Refresh:3; url=admin.php");
}

?>