<?php

require_once "../../config/app.php";
require_once "../views/inc/session_start.php";
require_once "../../autoload.php";

use app\controllers\PedidoController;

if(isset($_POST['modulo_pedido'])){

    $insPedido = new PedidoController();

    if($_POST['modulo_pedido'] == "eliminar"){
        echo $insPedido->eliminarPedidoControlador();
    }

    if($_POST['modulo_pedido'] == "actualizar"){
        echo $insPedido->actualizarPedidoControlador();
    }

} else {
    session_destroy();
    header("Location: ".APP_URL."login/");
}
