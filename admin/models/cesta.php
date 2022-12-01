<?php
require_once("../models/database.php");
class Cesta extends Database
{
    private $id_cesta;
    private $fk_id_usuario;
    private $lista_productos;
    private $precio_total;
    private $id_producto;
    private $cantidad_producto_cesta;

    function getIdCesta()
    {
        return $this->id_cesta;
    }
    function getFkIdUsuario()
    {
        return $this->fk_id_usuario;
    }
    function getListaProductos()
    {
        return $this->lista_productos;
    }
    function getPrecioTotal()
    {
        return $this->precio_total;
    }
    function getIdProducto()
    {
        return $this->id_producto;
    }
    function getCantidadProductoCesta()
    {
        //get json encoded products in getListaProductos() and decode it
        $todosLosProductosCesta = json_decode($this->getListaProductos(), true);
   
        //get the quantity of the product in the basket
        foreach ($todosLosProductosCesta as $producto) {
            if ($producto['id_producto'] == $this->getIdProducto()) {
                $this->cantidad_producto_cesta = $producto['cantidad'];
                return $producto['cantidad'];
            }
        }
    }


    function setIdCesta($id_cesta)
    {
        $this->id_cesta = $id_cesta;
    }
    function setFkIdUsuario($fk_id_usuario)
    {
        $this->fk_id_usuario = $fk_id_usuario;
    }
    function setListaProductos($lista_productos)
    {
        $this->lista_productos = $lista_productos;
    }
    function setPrecioTotal($precio_total)
    {
        $this->precio_total = $precio_total;
    }
    function setIdProducto($id_producto)
    {
        $this->id_producto = $id_producto;
    }
    function setCantidadProductoCesta($cantidad_producto_cesta)
    {
        $this->cantidad_producto_cesta = $cantidad_producto_cesta;
    }


    function conectar()
    {
        $this->db->query("SET NAMES 'utf8'");
    }

    function insertarCategoria() {
        $sql = "INSERT INTO pedidos (nombre, descripcion, cantidad, precio, categoria, foto, isactive) VALUES ('".$this->nombre."', '".$this->descripcion."', ".$this->cantidad.", ".$this->precio.", ".$this->categoria.", '".$this->foto."', ".$this->isactive.")";
        $this->db->query($sql);
        return "Categoria insertada: ".$this->nombre;
    }

    function eliminarCategoria(){
        $sql = "DELETE FROM categorias WHERE id_categoria = ".$this->id_categoria;
        $this->db->query($sql);
        return "Categoria eliminada: ".$this->id_categoria."<br/>";
    }

    function modificarPedido() {
        $sql = "UPDATE pedidos SET fk_id_cesta = '".$this->fk_id_cesta."', 
            fk_id_empresa_transporte = '".$this->fk_id_empresa_transporte."',
             fk_id_usuario = ".$this->fk_id_usuario.", num_seguimiento = '".$this->num_seguimiento."', estado = ".$this->estado.", fecha = ".$this->fecha." WHERE id_pedido = ".$this->id_pedido;
            $this->db->query($sql);


            return "Pedido modificado: ".$this->id_pedido."<br/>";
    }



    function fetchCesta() {
        $sql = "SELECT * FROM cestas WHERE id_cesta = ".$this->id_cesta;
        echo "Nº cesta: ".$this->id_cesta;
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $this->fk_id_usuario = $row['fk_id_usuario'];
        $this->lista_productos = $row['lista_productos'];
        $this->precio_total = $row['precio_total'];
    }

    function activarCategoria() {
        if ($this->isactive == 1) {
            $sql = "UPDATE categorias SET isactive = 1 WHERE id_categoria = ".$this->id_categoria;
            $this->db->query($sql);
            return "Categoria activada: ".$this->id_categoria."<br/>";
        } else {
            $sql = "UPDATE categorias SET isactive = 0 WHERE id_categoria = ".$this->id_categoria;
            $this->db->query($sql);
            return "Categoria desactivada: ".$this->id_categoria."<br/>";
        }
       
    }


    function mostrarPedidos()
    {
        $stmt = $this->db->prepare("SELECT * FROM pedidos");

        $pedidos = array();
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $pedidos[] = $row;
            }
        }

        return $pedidos;
    }

    function modificarProductoCesta() {
        //get json encoded products in getListaProductos() and decode it
        $todosLosProductosCesta = json_decode($this->getListaProductos(), true);
   
      
        //modify the quantity of the product in the basket
        $todosLosProductosCesta[$this->getIdProducto()]['cantidad'] = $this->cantidad_producto_cesta;
        //encode the array to json
        $this->setListaProductos(json_encode($todosLosProductosCesta));
        //update the basket
        $sql = "UPDATE cestas SET lista_productos = '".$this->getListaProductos()."' WHERE id_cesta = ".$this->getIdCesta();
        $this->db->query($sql);
    }

    

}
