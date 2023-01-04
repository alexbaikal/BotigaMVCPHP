<?php
require_once("models/database.php");
class Category extends Database
{
    private $id_categoria;
    private $nombre;
    private $descripcion;
    private $cantidad;
    private $precio;
    private $categoria;
    private $foto;
    private $isactive;

/*
    public function setProduct(int $id_categoria, string $nombre, string $descripcion, int $cantidad, float $precio, int $categoria, string $foto) {
        $this->id_categoria = $id_categoria;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->categoria = $categoria;
        $this->foto = $foto;
    }
*/

    function getIdCategoria()
    {
        return $this->id_categoria;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getIsActive()
    {
        return $this->isactive;
    }

    function setIdCategoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }

    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }


    function setIsActive($isactive) {
        $this->isactive = $isactive;
    }



    function conectar()
    {
        $this->db->query("SET NAMES 'utf8'");
    }

    function insertarCategoria() {
        $sql = "INSERT INTO categorias (nombre, descripcion, isactive) VALUES ('".$this->nombre."', '".$this->descripcion."', ".$this->isactive.")";
        $this->db->query($sql);
        return "Categoria insertada: ".$this->nombre;
    }

    function eliminarCategoria(){
        $sql = "DELETE FROM categorias WHERE id_categoria = ".$this->id_categoria;
        $this->db->query($sql);
        return "Categoria eliminada: ".$this->id_categoria."<br/>";
    }

    function modificarCategoria() {
        $sql = "UPDATE categorias SET nombre = '".$this->nombre."', 
            descripcion = '".$this->descripcion."',
             isactive = ".$this->isactive." WHERE id_categoria = ".$this->id_categoria;
            $this->db->query($sql);

            return "Categoria modificada: ".$this->nombre."<br/>";
    }



    function fetchCategoria() {
        $sql = "SELECT * FROM categorias WHERE id_categoria = ".$this->id_categoria;
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $this->nombre = $row['nombre'];
        $this->descripcion = $row['descripcion'];
        $this->isactive = $row['isactive'];
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

    function mostrarCategorias()
    {
        // prepare the statement. the placeholders allow PDO to handle substituting
        // the values, which also prevents SQL injection
        $stmt = $this->db->prepare("SELECT * FROM categorias");


        $categories = array();
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = $row;
            }
        }


        return $categories;
    }

}
