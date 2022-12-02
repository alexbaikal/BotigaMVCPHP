<?php
require_once("../models/database.php");
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

    //en caso de añadir producto a la cesta
    private $id_cesta;
    private $cantidad_cesta;

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
    function getIdCesta()
    {
        return $this->id_cesta;
    }
    function getCantidadCesta()
    {
        return $this->cantidad_cesta;
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

    function setIsActive($isactive)
    {
        $this->isactive = $isactive;
    }
    function setIdCesta($id_cesta)
    {
        $this->id_cesta = $id_cesta;
    }
    function setCantidadCesta($cantidad_cesta)
    {
        $this->cantidad_cesta = $cantidad_cesta;
    }



    function conectar()
    {
        $this->db->query("SET NAMES 'utf8'");
    }

    function insertarProducto()
    {
        $sql = "INSERT INTO productos (nombre, descripcion, cantidad, precio, categoria, foto, isactive) VALUES ('" . $this->nombre . "', '" . $this->descripcion . "', " . $this->cantidad . ", " . $this->precio . ", " . $this->categoria . ", '" . $this->foto . "', " . $this->isactive . ")";
        $this->db->query($sql);
        return "Producto insertado: " . $this->nombre;
    }

    function eliminarProducto()
    {
        $sql = "DELETE FROM productos WHERE id_producto = " . $this->id_producto;
        $this->db->query($sql);
        return "Producto eliminado: " . $this->id_producto . "<br/>";
    }

    function modificarProducto()
    {
        $sql = "UPDATE productos SET nombre = '" . $this->nombre . "', 
            descripcion = '" . $this->descripcion . "',
             cantidad = " . $this->cantidad . ",
             precio = " . $this->precio . ",
             categoria = " . $this->categoria . ",
             foto = '" . $this->foto . "',
             isactive = " . $this->isactive . " WHERE id_producto = " . $this->id_producto;
        $this->db->query($sql);

        return "Producto modificado: " . $this->nombre . "<br/>";
    }

    function mostrarProductos()
    {


        //add a search bar

        echo "<div style='display: flex; justify-content: center; margin-bottom: 20px; align-items:center;'>";
        echo "<form action='adminCourses.php' method='GET'>";
        echo "<input type='text' name='search' placeholder='Cerca per nom del curs o DNI'>";
        echo "<input type='submit' value='🔎'>";
        echo "</form>";
        echo "</div>";

        //if the search bar is not empty, search for the teacher
        $query = "SELECT * FROM courses";
        if (isset($_GET['search'])) {

            $query = 'SELECT * FROM courses WHERE teacher_id LIKE "%' . $_GET['search'] . '%" OR name LIKE "%' . $_GET['search'] . '%"';
        }




        // prepare the statement. the placeholders allow PDO to handle substituting
        // the values, which also prevents SQL injection
        $stmt = $this->db->prepare("SELECT * FROM productos");


        if (isset($_GET['id_cesta'])) {
            //create a stmt that queries all the product ids from cesta_productos table where fk_id_cesta=id_cesta
            $stmt2 = $this->db->prepare("SELECT * FROM productos WHERE id_producto IN (SELECT fk_id_producto FROM cesta_productos WHERE fk_id_cesta=" . $_GET['id_cesta'] . ")");
            $stmt2->execute();
            $cesta_productos = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            $stmt2->closeCursor();
            $stmt2 = null;




        }


        // execute the statement
        $stmt->execute();

        // fetch the results
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);


        //remove all the products inside products array where id_producto from lista_productos array is equal to id_producto from products array


        if (isset($_GET['id_cesta'])) {
            foreach ($productos as $key => $producto) {
                foreach ($cesta_productos as $key2 => $cesta_producto) {
                    if ($producto['id_producto'] == $cesta_producto['id_producto']) {
                        unset($productos[$key]);
                    }
                }
            }
        }

        // close the cursor and free the connection
        $stmt->closeCursor();
        $stmt = null;

        // return the results
        return $productos;


    }



    function fetchProduct()
    {
        $sql = "SELECT * FROM productos WHERE id_producto = " . $this->id_producto;
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

    function activarProducto()
    {
        if ($this->isactive == 1) {
            $sql = "UPDATE productos SET isactive = 1 WHERE id_producto = " . $this->id_producto;
            $this->db->query($sql);
            return "Producto activado: " . $this->id_producto . "<br/>";
        } else {
            $sql = "UPDATE productos SET isactive = 0 WHERE id_producto = " . $this->id_producto;
            $this->db->query($sql);
            return "Producto desactivado: " . $this->id_producto . "<br/>";
        }
    }

    function añadirProductoCesta()
    {
        if ($this->cantidad_cesta >= 0 || $this->cantidad_cesta == "" || $this->cantidad_cesta == null) {
            $sql = "INSERT INTO cesta_productos (fk_id_cesta, fk_id_producto, cantidad) VALUES (" . $this->id_cesta . ", " . $this->id_producto . ", " . $this->cantidad_cesta . ")";
            $this->db->query($sql);
            //redirect page to Cesta&action=iniciarModificarCesta&id_cesta=$this->id_cesta
            header("Location: admin.php?controller=Cesta&action=iniciarModificarCesta&id_cesta=$this->id_cesta");

            return "Producto añadido a la cesta: " . $this->id_producto . "<br/>";
        } else {
            return "No se ha podido añadir el producto a la cesta: " . $this->id_producto . "<br/>";
        }
    }

    function eliminarProductoCesta()
    {
        $sql = "DELETE FROM cesta_productos WHERE fk_id_cesta = " . $this->id_cesta . " AND fk_id_producto = " . $this->id_producto;
        $this->db->query($sql);

        //redirect page to Cesta&action=iniciarModificarCesta&id_cesta=$this->id_cesta
        header("Location: admin.php?controller=Cesta&action=iniciarModificarCesta&id_cesta=$this->id_cesta");
        return "Producto eliminado de la cesta: " . $this->id_producto . "<br/>";
    }
}
