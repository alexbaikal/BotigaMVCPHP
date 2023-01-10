<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php

  //add product button
  if ($_SESSION['role'] == 'admin') {
  
  echo "<a id='añadir_producto' href='admin.php?controller=Administrador&action=iniciarAltaProducto' class='btn btn-primary'>Añadir producto</a>";

  //  echo "<table border='1'>";
  //   echo "<p>Esto es un ejemplo de como se puede mostrar la tabla de productos</p>";

    echo "<table border='1' id='tablaproductos'>";
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
      //echo "<td><a href='?controller=Administrador&action=eliminarProducto&id=".$producto['id_producto']."'>Eliminar</a></td>";
      echo "<td><a href='?controller=Administrador&action=iniciarModificarProducto&id=".$producto['id_producto']."'>Modificar</a></td>";
      echo "<td>";
      if ($producto['isactive'] == 1) {
        echo "<p>Activo</p>";
      } else {
        echo "<p>Inactivo</p>";
      }
      //create a checkbox form to change the active status of the product
      echo "<form action='?controller=Administrador&action=activarProducto' method='post'>";
      echo "<input type='hidden' name='id_producto' value='".$producto['id_producto']."'>";
      echo "<input type='checkbox' onChange='this.form.submit()' name='isactive' ";
      if ($producto['isactive'] == 1) {
        echo "checked";
      } else {
        echo "";
      }
      echo ">";
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