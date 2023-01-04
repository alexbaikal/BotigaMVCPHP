<?php
class PedidoController
{



    public function iniciarVistaPedidos()
    {

        require_once "./models/administrador.php";
        require_once "./models/pedido.php";
        require_once "./models/cesta.php";
        
        $pedidos = new Pedido();

        $cesta = new Cesta();



        $todosLosPedidos = $cesta->mostrarPedidos();

        $transportistasArray = $pedidos->getTransportistas();

        require_once "./views/mostrarPedidos.php";
    }

    public function iniciarAltaPedido()
    {
        echo "no implementado";
        require_once "./views/altaPedido.php";
    }

    public function iniciarModificarPedido()
    {


        if (isset($_GET['id_pedido'])) {
            $id = $_GET['id_pedido'];

            require_once "./models/pedido.php";

            $pedido = new Pedido();
            $pedido->setIdPedido($id);
            $pedido->conectar();
            $pedido->fetchPedido();
            $pedido->getClientName();
            $transportistasArray = $pedido->getTransportistas();
            require_once "./views/modificarPedido.php";

            require_once "./models/cesta.php";
            
            $pedidos = new Pedido();
    
            $cesta = new Cesta();
    
            $todosLosPedidos = $cesta->mostrarPedidos();
    
            require_once "./views/mostrarPedidos.php";
        } else {
            $id = "";
            echo "Error, no se ha encontrado el producto";
        }
    }


    public function modificarPedido()
    {
        if (isset($_POST)) {
            require_once "./models/pedido.php";
            $pedido = new Pedido();

            $pedido->setIdPedido($_POST['id_pedido']);
            $pedido->setFkIdEmpresaTransporte($_POST['fk_id_empresa_transporte']);
            $pedido->setFkIdUsuario($_POST['fk_id_usuario']);
            $pedido->setNumSeguimiento($_POST['num_seguimiento']);
            $pedido->setEstado($_POST['estado']);
            $pedido->setFecha($_POST['fecha']);
            //$pedido->setHora($_POST['hora']);
            //unir fecha y hora en un timestamp
            $pedido->setFecha($_POST['fecha']);
            $pedido->setHora($_POST['hora']);
            $pedido->setFechaHoraTimestamp($pedido->getFecha(), $pedido->getHora());

  
            $pedido->conectar();

            echo "" . $pedido->modificarPedido();


            require_once "./models/cesta.php";

            $pedidos = new Pedido();

            $cesta = new Cesta();

            $todosLosPedidos = $cesta->mostrarPedidos();
            $transportistasArray = $pedidos->getTransportistas();


            require_once "./views/mostrarPedidos.php";




            //    return "Producto modificado: ".$_POST['nombre']."<br/>";
        }
    }
}

?>


