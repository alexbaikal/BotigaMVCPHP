
<button id="boton_vuelta_altacategorias" type="button" class="btn btn-primary" onclick="window.location.href='admin.php?controller=Administrador&action=iniciarVistaCategorias'">Tornar</button>

<h2 id="titulo_altacategorias">Alta categoria</h2>

<form action="admin.php?controller=Administrador&action=altaCategoria" method="post" id="form_altacategoria">
    
    
    <input class="alta_categorias" type="text" name = "nombre" placeholder="Nombre">
    <br/>

    
    <input class="alta_categorias" type="text" name = "descripcion" placeholder="Descripción">
    <br/>

    <input id="submit_altacategorias" type = "submit" value="Afegir categoria">
</form>
<br/>

