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
    function getNombreUsuario()
    {
        $id_usuario = strval($this->fk_id_usuario);
        //connect to database and search for the user
        $sql = "SELECT nombre FROM usuarios WHERE id_usuario = ".$id_usuario;
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $nombre = $row['nombre'];
        return $nombre;
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
        return $this->cantidad_producto_cesta;
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





    function fetchCesta() {
        if (isset($_GET['fk_id_cesta'])) {
            $this->id_cesta = $_GET['fk_id_cesta'];

        }
        $sql = "SELECT * FROM cestas WHERE id_cesta = ".$this->id_cesta;
        
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $this->fk_id_usuario = $row['fk_id_usuario'];
        $this->precio_total = $row['precio_total'];

        //get result from cesta_productos and put them to lista_productos
        $sql = "SELECT * FROM cesta_productos WHERE fk_id_cesta = ".$this->id_cesta;
        $result = $this->db->query($sql);
        //get fk_id_producto from result and get nombre from productos
        for ($i = 0; $i < $result->rowCount(); $i++) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $id_producto = $row['fk_id_producto'];
            $sql = "SELECT * FROM productos WHERE id_producto = " . $id_producto;
            $result2 = $this->db->query($sql);
            $row2 = $result2->fetch(PDO::FETCH_ASSOC);
            $this->lista_productos[$i]['nombre'] = $row2['nombre'];
            $this->lista_productos[$i]['fk_id_producto'] = $row2['id_producto'];
            $this->lista_productos[$i]['cantidad'] = $row['cantidad'];

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
        //modify the quantity of the product in the basket
        $sql = "UPDATE cesta_productos SET cantidad = ".$this->cantidad_producto_cesta." WHERE fk_id_cesta = ".$this->id_cesta." AND fk_id_producto = ".$this->id_producto;
      
        $this->db->query($sql);
    }

    function modificarCesta() {
        //modify the total price of the basket
        echo $this->precio_total;
        $sql = "UPDATE cestas SET precio_total = ".$this->precio_total." WHERE id_cesta = ".$this->id_cesta;
        $this->db->query($sql);


    }



    

}
