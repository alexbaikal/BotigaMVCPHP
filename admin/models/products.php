<?php
require_once("../models/database.php");
class Products extends Database
{
    private $id_producto;
    private $nombre;
    private $descripcion;
    private $cantidad;
    private $precio;
    private $categoria;
    private $foto;

/*
    public function setProduct(int $id_producto, string $nombre, string $descripcion, int $cantidad, float $precio, int $categoria, string $foto) {
        $this->id_producto = $id_producto;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->categoria = $categoria;
        $this->foto = $foto;
    }
*/

    function getIdProducto()
    {
        return $this->id_producto;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getCantidad()
    {
        return $this->cantidad;
    }

    function getPrecio()
    {
        return $this->precio;
    }

    function getCategoria()
    {
        return $this->categoria;
    }

    function getFoto()
    {
        return $this->foto;
    }

    function setIdProducto($id_producto)
    {
        $this->id_producto = $id_producto;
    }

    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    function setFoto($foto)
    {
        $this->foto = $foto;
    }



    function conectar()
    {
        $this->db->query("SET NAMES 'utf8'");
    }

    function insertarProducto() {
        $sql = "INSERT INTO productos (nombre, descripcion, cantidad, precio, categoria, foto) VALUES ('".$this->nombre."', '".$this->descripcion."', ".$this->cantidad.", ".$this->precio.", ".$this->categoria.", '".$this->foto."')";
        $this->db->query($sql);
        return "Producto insertado: ".$this->nombre;
    }

    function eliminarProducto(){
        $sql = "DELETE FROM productos WHERE id_producto = ".$this->id_producto;
        $this->db->query($sql);
        return "Producto eliminado: ".$this->id_producto."<br/>";
    }

}
