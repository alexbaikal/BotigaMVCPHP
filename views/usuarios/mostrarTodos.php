<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php

//add product button


//echo "<a href='admin.php?controller=Administrador&action=iniciarAltaProducto' class='btn btn-primary'>Añadir producto</a>";

echo "<table border='1'>";


echo "<p>Todos los productos:</p>";
//create a search form
if (isset($_GET['id_categoria'])) {
  $id_categoria = $_GET['id_categoria'];
  echo "<form action='?controller=Usuario&action=mostrarCategoria&id_categoria=" . $id_categoria . "' method='post'>";
} else {
  echo "<form action='?controller=Usuario&action=mostrarTodos' method='post'>";
}
echo "<input type='text' name='search' placeholder='Buscar producto'>";
echo "<input type='submit' value='Buscar'>";
echo "</form>";
echo "<br/><br/>";

if (isset($_POST['search'])) {
  $search = $_POST['search'];
  //filtrate $producto['nombre'] with $search (each to lower case)
  $todosLosProductos = array_filter($todosLosProductos, function ($producto) use ($search) {
    return stripos($producto['nombre'], $search) !== false;
  });
}

  ?>
  <img id="imgprueba" src="./media/dd.jpg">


<div class="grid">
  <?php
  foreach ($todosLosProductos as $producto) {
    echo "<div class='item'>";
    //poner nombre categoria donde id_categoria coincida

  foreach ($todasLasCategorias as $categoria) {
    if ($categoria['id_categoria'] == $producto['categoria']) {
      echo "<p id='categoria'>" . $categoria['nombre'] . "</p>";
    }
  }
    echo "<img src='" . $producto['foto'] . "' width='100' height='100'/>";
    echo "<p><b>".$producto['nombre']."</b></p>";
    echo "<p>".$producto['descripcion']."</p>";
    //stock
    echo "<p id='stock'>Stock: ".$producto['cantidad']."</p>";
    echo "<div class='row'>";
    echo "<div class='col-sm-2'>";
    echo "<p id='precio'>".$producto['precio']."€</p>";
    echo "</div>";
    echo "<div class='col-sm-60'>";
    echo "<form action='?controller=UsuarioCesta&action=añadirProductoCesta&id_producto=" . $producto['id_producto'] . "' method='post'>";
    echo "<input type='number' value='1' name='cantidad' min='1' max='" . $producto['cantidad'] . "'>";
    echo "<input type='submit' value='Afegir'>";
    echo "</form>";

    echo "</div>";

    echo "</div>";
    echo "</div>";
  }
  ?>
 
</div>