<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php

  //add product button
  if ($_SESSION['role'] == 'admin') {
  
 

   echo "<table border='1'>";
  
  
    echo "<p>Alta de producto en la cesta:</p>";
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Id</th>";
    echo "<th>Nombre</th>";
    echo "<th>Descripcion</th>";
    echo "<th>Cantidad</th>";
    echo "<th>Precio</th>";
    echo "<th>Categoria</th>";
    echo "<th>Imagen</th>";
    echo "</tr>";
    foreach ($todosLosProductos as $producto) {
      echo "<tr>";
      echo "<td>".$producto['id_producto']."</td>";
      echo "<td>". $producto['nombre'] . "</td>";
      echo "<td>".$producto['descripcion'] . "</td>";
      echo "<td>".$producto['cantidad'] . "</td>";
      echo "<td>".$producto['precio'] . "</td>";
      echo "<td>".$producto['categoria'] . "</td>";
      echo "<td><img src='".$producto['foto']."' width='100' height='100'/></td>";
      //create a form with a hidden id field and a hidden id cesta field, quantity number field with a max of producto['cantidad'] and a submit button with action to añadirProductoCesta
      echo "<td>";
      echo "<form action='?controller=Cesta&action=añadirProductoCesta' method='POST'>";
      echo "<input type='hidden' name='id_producto' value='".$producto['id_producto']."'>";
      echo "<input type='hidden' name='id_cesta' value='".$_GET['id_cesta']."'>";
      echo "<input type='number' name='cantidad_cesta' min='1' max='".$producto['cantidad']."'>";
      echo "<input type='submit' value='Añadir'>";
      echo "</form>";
      echo "</form>";
      echo "</td>";
      echo "</tr>";
  }
    echo "</table>";

    //create button to go back to modify cesta
    echo "<button onclick='window.location.href=\"?controller=Cesta&action=iniciarModificarCesta&id_cesta=".$_GET['id_cesta']."\"'>Volver</button>";
} else {
  echo "<p>Debes ser administrador para ver esta pagina</p>";
  //refresh after 3 seconds
  header("Refresh:3; url=admin.php");
}

?>
