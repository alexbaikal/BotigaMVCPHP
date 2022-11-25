<?php
require_once("./models/database.php");
class Product extends Database
{
    private $id_producto;
    private $nombre;
    private $descripcion;
    private $cantidad;
    private $precio;
    private $categoria;
    private $foto;
    private $isactive;

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
    function getIsActive()
    {
        return $this->isactive;
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

    function setIsActive($isactive) {
        $this->isactive = $isactive;
    }



    function conectar()
    {
        $this->db->query("SET NAMES 'utf8'");
    }

    function insertarProducto() {
        $sql = "INSERT INTO productos (nombre, descripcion, cantidad, precio, categoria, foto, isactive) VALUES ('".$this->nombre."', '".$this->descripcion."', ".$this->cantidad.", ".$this->precio.", ".$this->categoria.", '".$this->foto."', ".$this->isactive.")";
        $this->db->query($sql);
        return "Producto insertado: ".$this->nombre;
    }

    function eliminarProducto(){
        $sql = "DELETE FROM productos WHERE id_producto = ".$this->id_producto;
        $this->db->query($sql);
        return "Producto eliminado: ".$this->id_producto."<br/>";
    }

    function modificarProducto() {
        $sql = "UPDATE productos SET nombre = '".$this->nombre."', 
            descripcion = '".$this->descripcion."',
             cantidad = ".$this->cantidad.",
             precio = ".$this->precio.",
             categoria = ".$this->categoria.",
             foto = '".$this->foto."',
             isactive = ".$this->isactive." WHERE id_producto = ".$this->id_producto;
            $this->db->query($sql);

            return "Producto modificado: ".$this->nombre."<br/>";
    }



    function fetchProduct() {
        $sql = "SELECT * FROM productos WHERE id_producto = ".$this->id_producto;
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $this->nombre = $row['nombre'];
        $this->descripcion = $row['descripcion'];
        $this->cantidad = $row['cantidad'];
        $this->precio = $row['precio'];
        $this->categoria = $row['categoria'];
        $this->foto = $row['foto'];
        $this->isactive = $row['isactive'];
    }

    function activarProducto() {
        if ($this->isactive == 1) {
            $sql = "UPDATE productos SET isactive = 1 WHERE id_producto = ".$this->id_producto;
            $this->db->query($sql);
            return "Producto activado: ".$this->id_producto."<br/>";
        } else {
            $sql = "UPDATE productos SET isactive = 0 WHERE id_producto = ".$this->id_producto;
            $this->db->query($sql);
            return "Producto desactivado: ".$this->id_producto."<br/>";
        }
       
    }

}
