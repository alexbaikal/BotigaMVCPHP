<?php
require_once("database.php");
class Cesta extends Database
{
    private $id_cesta;
    private $fk_id_usuario;
    private $lista_productos;
    private $precio_total = 0;
    private $id_producto;
    private $cantidad_producto_cesta;
    private $nombre_producto;

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
        $sql = "SELECT nombre FROM usuarios WHERE id_usuario = " . $id_usuario;
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
    function setProductoNombre($id_producto)
    {
        $sql = "SELECT nombre FROM productos WHERE id_producto = " . $id_producto;
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $nombre = $row['nombre'];
        $this->nombre_producto = $nombre;
    }
    function getProductoNombre()
    {
        return $this->nombre_producto;
    }

    function conectar()
    {
        $this->db->query("SET NAMES 'utf8'");
    }





    function fetchCesta()
    {
        //if cestas with fk_id_usuario exists. If not, create cesta and add product to cesta_productos
        $sql = "SELECT * FROM cestas WHERE fk_id_usuario = " . $this->fk_id_usuario;
        $result = $this->db->query($sql);
        if ($result->rowCount() > 0) {
            //cesta exists
            $sql = "SELECT * FROM cestas WHERE fk_id_usuario = " . $this->fk_id_usuario;

            $result = $this->db->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $this->fk_id_usuario = $row['fk_id_usuario'];
            $this->precio_total = $row['precio_total'];
            $this->id_cesta = $row['id_cesta'];

            //get result from cesta_productos
            $sql = "SELECT * FROM cesta_productos WHERE fk_id_cesta = " . $this->id_cesta;
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
        } else {
            //cesta doesn't exist
            $sql = "INSERT INTO cestas (fk_id_usuario, precio_total) VALUES (" . $this->fk_id_usuario . ", " . $this->precio_total . ")";
            $this->db->query($sql);
            $this->id_cesta = $this->db->lastInsertId();



            //get result from cesta_productos and put them to lista_productos, if cesta_productos doesn't exist, create it
            $sql = "SELECT * FROM cesta_productos WHERE fk_id_cesta = " . $this->id_cesta;
            $result = $this->db->query($sql);
            if ($result->rowCount() > 0) {

                //cesta_productos exists
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
        }
    }

    function añadirProductoCesta()
    {
        if ($this->cantidad_producto_cesta > 0) {


            //add product to cesta_productos, check first if cesta_productos exists
            $sql = "SELECT * FROM cesta_productos WHERE fk_id_cesta = " . $this->id_cesta . " AND fk_id_producto = " . $this->id_producto;
            $result = $this->db->query($sql);
            if ($result->rowCount() > 0) {
                //cesta_productos exists

                $sql = "UPDATE cesta_productos SET cantidad = cantidad + " . $this->cantidad_producto_cesta . " WHERE fk_id_cesta = " . $this->id_cesta . " AND fk_id_producto = " . $this->id_producto;
                $this->db->query($sql);
            } else {
                //cesta_productos doesn't exist
                $sql = "INSERT INTO cesta_productos (fk_id_cesta, fk_id_producto, cantidad) VALUES (" . $this->id_cesta . ", " . $this->id_producto . ", " . $this->cantidad_producto_cesta . ")";
                $this->db->query($sql);
            }
/*
            //remove -cantidad_producto_cesta from stock inside productos where id_producto = id_producto
            $sql = "UPDATE productos SET cantidad = cantidad - " . $this->cantidad_producto_cesta . " WHERE id_producto = " . $this->id_producto;
*/
            //update precio_total
            $sql = "SELECT * FROM cestas WHERE id_cesta = " . $this->id_cesta;
            $result = $this->db->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $this->precio_total = $row['precio_total'];
            $sql = "SELECT * FROM productos WHERE id_producto = " . $this->id_producto;
            $result = $this->db->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $this->precio_total += $row['precio'] * $this->cantidad_producto_cesta;
            $sql = "UPDATE cestas SET precio_total = " . $this->precio_total . " WHERE id_cesta = " . $this->id_cesta;
            $this->db->query($sql);
        }
    }



    function mostrarPedidos()
    {
        $stmt = $this->db->prepare("SELECT * FROM pedidos WHERE fk_id_usuario = " . $this->fk_id_usuario . " ORDER BY fecha DESC");

        $pedidos = array();
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $pedidos[] = $row;
            }
        }

        return $pedidos;
    }

    function modificarProductoCesta()
    {


        //add product to cesta_productos, check first if cesta_productos exists
        $sql = "SELECT * FROM cesta_productos WHERE fk_id_cesta = " . $this->id_cesta . " AND fk_id_producto = " . $this->id_producto;
        $result = $this->db->query($sql);
        if ($result->rowCount() > 0) {
            //cesta_productos exists
            $sql = "UPDATE cesta_productos SET cantidad = " . $this->cantidad_producto_cesta . " WHERE fk_id_cesta = " . $this->id_cesta . " AND fk_id_producto = " . $this->id_producto;
            $this->db->query($sql);
        } else {
            //cesta_productos doesn't exist
            $sql = "INSERT INTO cesta_productos (fk_id_cesta, fk_id_producto, cantidad) VALUES (" . $this->id_cesta . ", " . $this->id_producto . ", " . $this->cantidad_producto_cesta . ")";
            $this->db->query($sql);
        }

        //update precio_total
        $sql = "SELECT * FROM cestas WHERE id_cesta = " . $this->id_cesta;
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $this->precio_total = $row['precio_total'];
        $sql = "SELECT * FROM productos WHERE id_producto = " . $this->id_producto;
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $this->precio_total += $row['precio'] * $this->cantidad_producto_cesta;
        $sql = "UPDATE cestas SET precio_total = " . $this->precio_total . " WHERE id_cesta = " . $this->id_cesta;
        $this->db->query($sql);
    }

    function modificarCesta()
    {
        //modify the total price of the basket
        echo $this->precio_total;
        $sql = "UPDATE cestas SET precio_total = " . $this->precio_total . " WHERE id_cesta = " . $this->id_cesta;
        $this->db->query($sql);
    }
}
