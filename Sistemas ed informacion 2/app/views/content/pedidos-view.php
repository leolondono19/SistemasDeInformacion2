<!-- app/views/content/pedidos-view.php -->
<?php
use app\controllers\PedidoController; // Asegúrate de usar el namespace correcto
require_once './app/controllers/PedidoController.php'; // Ajusta la ruta si es necesario
$pedidoController = new PedidoController();
$pedidos = $pedidoController->obtenerPedidos();
?>
<div class="container mt-5">
    <h2 class="mb-4">Lista de Pedidos</h2>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Código Pedido</th>
                <th>Cliente</th>
                <th>Correo</th>
                <th>Celular</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($pedidos as $pedido) {
                echo '<tr>';
                echo '<td>' . $pedido['pedido_id'] . '</td>';
                echo '<td>' . $pedido['codigo_pedido'] . '</td>';
                echo '<td>' . $pedido['nombre_cliente'] . '</td>';
                echo '<td>' . $pedido['correo_cliente'] . '</td>';
                echo '<td>' . $pedido['celular_cliente'] . '</td>';
                echo '<td>' . $pedido['fecha'] . '</td>';
                echo '<td>' . $pedido['estado'] . '</td>';
                echo '<td><a href="?views=comprobar-pedido&codigo=' . $pedido['codigo_pedido'] . '" class="btn btn-primary">Comprobar</a></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>
