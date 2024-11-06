<div class="container">
    <h1 class="title">Listado de Pedidos</h1>
    <div class="box">
        <form action="<?php echo APP_URL; ?>pedidoBuscar/" method="POST" autocomplete="off">
            <div class="field has-addons">
                <div class="control is-expanded">
                    
                </div>
                
            </div>
        </form>
    </div>

    <?php
        require_once "./app/controllers/PedidoController.php";
        use app\controllers\PedidoController;

        $pedidoController = new PedidoController();
        echo $pedidoController->listarPedidosControlador(1, 10, "pedidos", "");
    ?>
</div>
