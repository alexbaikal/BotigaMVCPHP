<?php
require_once("./models/database.php");
class Pedido extends Database
{
    private $id_pedido;
    private $fk_id_cesta;
    private $fk_id_empresa_transporte;
    private $fk_id_usuario;
    private $nombre_usuario;
    private $num_seguimiento;
    private $estado;
    private $fecha;
    private $hora;
    private $fecha_hora_timestamp;

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

    function getNombreUsuario($id)
    {
        $id_usuario = strval($id);
        //connect to database and search for the user
        $sql = "SELECT nombre FROM usuarios WHERE id_usuario = ".$id_usuario;
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $nombre = $row['nombre'];
        $this->nombre_usuario = $nombre;

        return $nombre;

    }

    function getNumSeguimiento()
    {
        return $this->num_seguimiento;
    }

    function getEstado()
    {
        return $this->estado;
    }

    function getFecha()
    {
        return $this->fecha;
    }
    function getHora()
    {
        return $this->hora;
    }
    function getFechaHoraTimestamp()
    {
        return $this->fecha_hora_timestamp;
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
    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    function setHora($hora)
    {
        $this->hora = $hora;
    }
    function setFechaHoraTimestamp($fecha, $hora)
    {
        //convertir fecha y hora a timestamp
        $fecha = strval($fecha);
        $hora = strval($hora);
        $fecha_hora = $fecha." ".$hora;
        $fecha_hora_timestamp = strtotime($fecha_hora);
        $this->fecha_hora_timestamp = $fecha_hora_timestamp;
    }



    function conectar()
    {
        $this->db->query("SET NAMES 'utf8'");
    }

    function modificarPedido() {
        $sql = "UPDATE pedidos SET
            fk_id_empresa_transporte = '".$this->fk_id_empresa_transporte."',
             fk_id_usuario = ".$this->fk_id_usuario.", num_seguimiento = '".$this->num_seguimiento."', estado = ".$this->estado.", fecha = ".$this->fecha_hora_timestamp." WHERE id_pedido = ".$this->id_pedido;
            $this->db->query($sql);


            return "Pedido modificado: ".$this->id_pedido."<br/>";
    }



    function fetchPedido() {
        $sql = "SELECT * FROM pedidos WHERE id_pedido = ".$this->id_pedido;
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $this->fk_id_cesta = $row['fk_id_cesta'];
        $this->fk_id_empresa_transporte = $row['fk_id_empresa_transporte'];
        $this->fk_id_usuario = $row['fk_id_usuario'];
        $this->num_seguimiento = $row['num_seguimiento'];
        $this->estado = $row['estado'];
        $this->fecha = $row['fecha'];
    }

    function getTransportistas() {
        //get everything from empresa_transorte using and put to an array
        $sql = "SELECT * FROM empresa_transporte";
        $result = $this->db->query($sql);
        $transportistasArray = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $transportistasArray[] = $row;
        }
        return $transportistasArray;
    }

    function getClientName() {
        $sql = "SELECT nombre FROM usuarios WHERE id_usuario = ".$this->fk_id_usuario;
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $nombre = $row['nombre'];
        return $nombre;
    }

    function generarPedido() {
        //get id_cesta from user
        $sql = "SELECT id_cesta FROM cestas WHERE fk_id_usuario = ".$this->fk_id_usuario;
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $this->fk_id_cesta = $row['id_cesta'];

        //insert into pedidos
        $sql = "INSERT INTO pedidos (fk_id_cesta, fk_id_empresa_transporte, fk_id_usuario, num_seguimiento, estado, fecha)
        VALUES (".$this->fk_id_cesta.
        ", ".$this->fk_id_empresa_transporte.
        ", ".$this->fk_id_usuario.
        ", '".$this->num_seguimiento.
        "', ".$this->estado.
        ", ".$this->fecha_hora_timestamp.")";
        $this->db->query($sql);
        //get id_pedido
        $sql = "SELECT id_pedido FROM pedidos WHERE fk_id_cesta = ".$this->fk_id_cesta;
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $this->id_pedido = $row['id_pedido'];
        //set precio_total to 0 inside cestas where id_cesta = $this->fk_id_cesta
        $sql = "UPDATE cestas SET precio_total = 0 WHERE id_cesta = ".$this->fk_id_cesta;
        $this->db->query($sql);

        //get list of products and for each product remove the amount from stock inside productos.cantidad
        $sql = "SELECT * FROM cesta_productos WHERE fk_id_cesta = ".$this->fk_id_cesta;
        $result = $this->db->query($sql);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $id_producto = $row['fk_id_producto'];
            $cantidad = $row['cantidad'];
            $sql = "UPDATE productos SET cantidad = cantidad - ".$cantidad." WHERE id_producto = ".$id_producto;
            $this->db->query($sql);
        }
        
        //to select a git branch:
        //git checkout -b <branch_name>
        //if it says that a branch already exists:
        //git checkout <branch_name>

        //delete all rows from cesta_productos where id_cesta = $this->fk_id_cesta
        $sql = "DELETE FROM cesta_productos WHERE fk_id_cesta = ".$this->fk_id_cesta;
        $this->db->query($sql);

        //return id_pedido
        return $this->id_pedido;
    }


}
