


<h2 id="titulo_altaproductos">Añadir producto nuevo</h2>
<!--Crear un form con action="admin.php?controller=Administrador&action=iniciarAltaProducto" method="post" y que tenga control de entrada (nombre tiene que ser un texto, precio tiene que ser un float, etc...)-->

<form action="admin.php?controller=Administrador&action=altaProducto" method="post" id="form_altaproductos">
    
    <input class="alta_productos" type="text" name = "nombre" placeholder="Nombre">
    <br/>

    
    <input class="alta_productos" type="text" name = "descripcion" placeholder="Descripción">
    <br/>

    
    <input class="alta_productos" type="number" name = "cantidad" placeholder="Cantidad">
    <br/>

    
    <input class="alta_productos" type="text" name = "precio" placeholder="Precio">
    <br/>

    
    <input class="alta_productos" type="number" name = "categoria" placeholder="Categoria">
    <br/>

    
    <input class="alta_productos" type="file" name = "foto" placeholder="Imagen">

    
    <br/>

    <input id="submit_altaproductos" type = "submit" value="Añadir producto">
    <br/>

    
    

</form>

