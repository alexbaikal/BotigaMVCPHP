<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php
  if ($_SESSION['role'] == 'admin') {
    echo "<a id='añadir_categoria' href='admin.php?controller=Administrador&action=iniciarAltaCategoria' class='btn btn-primary'>Añadir categoria</a>";
    // echo "<table border='1'>";
    // echo "<p>Esto es un ejemplo de como se puede mostrar la tabla de categorias</p>";
    echo "<table border='1' id='tablacategorias'>";
    echo "<tr>";
    echo "<th>Id</th>";
    echo "<th>Nombre</th>";
    echo "<th>Descripcion</th>";
    echo "<th>Parámetros</th>";
    echo "<th>Estado</th>";
    echo "</tr>";
    foreach ($todasLasCategorias as $categoria) {
      echo "<tr>";
      echo "<td>".$categoria['id_categoria']."</td>";
      echo "<td>". $categoria['nombre'] . "</td>";
      echo "<td>".$categoria['descripcion'] . "</td>";
      //echo "<td><a href='?controller=Administrador&action=eliminarCategoria&id_categoria=".$categoria['id_categoria']."'>Eliminar</a><br/>";
      echo "<td><a href='?controller=Administrador&action=iniciarModificarCategoria&id_categoria=".$categoria['id_categoria']."'>Modificar</a></td>";
      echo "<td>";
      if ($categoria['isactive'] == 1) {
        echo "<p>Activo</p>";
      } else {
        echo "<p>Inactivo</p>";
      }
      //create a checkbox form to change the active status of the product
      echo "<form action='?controller=Administrador&action=activarCategoria' method='post'>";
      echo "<input type='hidden' name='id_categoria' value='".$categoria['id_categoria']."'>";
      echo "<input type='checkbox' onChange='this.form.submit()' name='isactive' ";
      if ($categoria['isactive'] == 1) {
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
    echo "<p>No tienes permisos para ver esta página</p>";
    //redirect to admin.php after 3 seconds
    header("Refresh:3; url=admin.php");
  }
?>