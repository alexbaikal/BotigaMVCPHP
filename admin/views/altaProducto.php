


<h2>Añadir producto nuevo</h2>
<!--Crear un form con action="admin.php?controller=Administrador&action=iniciarAltaProducto" method="post" y que tenga control de entrada (nombre tiene que ser un texto, precio tiene que ser un float, etc...)-->

<form action="admin.php?controller=Administrador&action=altaProducto" method="post">
    Nombre:
    <input type="text" name = "nombre">
    <br/>

    Descripción:
    <input type="text" name = "descripcion">
    <br/>

    Cantidad:
    <input type="number" name = "cantidad">
    <br/>

    Precio:
    <input type="text" name = "precio">
    <br/>

    Categoria:
    <input type="text" name = "categoria">
    <br/>

    Imagen:
    <input type="text" name = "foto">
    <input type = "submit" value="Añadir producto">
    <br/>

</form>

