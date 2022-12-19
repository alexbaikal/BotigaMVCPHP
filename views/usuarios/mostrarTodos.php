<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php

  //add product button

  
  //echo "<a href='admin.php?controller=Administrador&action=iniciarAltaProducto' class='btn btn-primary'>Añadir producto</a>";

   echo "<table border='1'>";
  
  
    echo "<p>Esto es un ejemplo de como se puede mostrar la tabla de productos</p>";
    echo "<table border='1'>";
    echo "<tr>";
    //echo "<th>Id</th>";
    echo "<th>Nombre</th>";
    echo "<th>Descripcion</th>";
    echo "<th>Cantitat disp.</th>";
    echo "<th>Precio</th>";
    echo "<th>Categoria</th>";
    echo "<th>Imagen</th>";
    echo "</tr>";



    foreach ($todosLosProductos as $producto) {
      //if ($producto['isactive'] == 1) {
        echo "<tr>";
        //echo "<td>".$producto['id_producto']."</td>";
        echo "<td>". $producto['nombre'] . "</td>";
        echo "<td>".$producto['descripcion'] . "</td>";
        echo "<td>".$producto['cantidad'] . "</td>";
        echo "<td>".$producto['precio'] . "€</td>";
        //poner nombre categoria donde id_categoria coincida


        foreach ($todasLasCategorias as $categoria) {
          if ($categoria['id_categoria'] == $producto['categoria']) {
            echo "<td>".$categoria['nombre'] . "</td>";
          }
        
        }
     
        echo "<td><img src='".$producto['foto']."' width='100' height='100'/></td>";
        //echo "<td><a href='?controller=Administrador&action=eliminarProducto&id=".$producto['id_producto']."'>Eliminar</a></td>";
        echo "<td><a href='?controller=Cesta&action=añadirProductoCesta&id_producto=".$producto['id_producto']."'>Afegir a la cistella</a></td>";
    
        echo "</tr>";
     // }
     
  }
    echo "</table>";


?>