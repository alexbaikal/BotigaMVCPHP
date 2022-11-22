<?php
require_once("../models/database.php");
class Pedido extends Database
{
    private $id_pedido;
    private $fk_id_cesta;
    private $fk_id_empresa_transporte;
    private $fk_id_usuario;
    private $num_seguimiento;
    private $estado;

    function getIdPedido()
    {
        return $this->id_pedido;
    }

    function getFkIdCesta()
    {
        return $this->fk_id_cesta;
    }

    function getFkIdEmpresaTransporte()
    {
        return $this->fk_id_empresa_transporte;
    }

    function getFkIdUsuario()
    {
        return $this->fk_id_usuario;
    }

    function getNumSeguimiento()
    {
        return $this->num_seguimiento;
    }

    function getEstado()
    {
        return $this->estado;
    }

    function setIdPedido($id_pedido)
    {
        $this->id_pedido = $id_pedido;
    }

    function setFkIdCesta($fk_id_cesta)
    {
        $this->fk_id_cesta = $fk_id_cesta;
    }

    function setFkIdEmpresaTransporte($fk_id_empresa_transporte)
    {
        $this->fk_id_empresa_transporte = $fk_id_empresa_transporte;
    }

    function setFkIdUsuario($fk_id_usuario)
    {
        $this->fk_id_usuario = $fk_id_usuario;
    }

    function setNumSeguimiento($num_seguimiento)
    {
        $this->num_seguimiento = $num_seguimiento;
    }

    function setEstado($estado)
    {
        $this->estado = $estado;
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

}
