<!-- app/views/content/comprobarPedido-view.php -->
<?php
require_once './app/controllers/pedidoController.php'; // Ajusta la ruta si es necesario
$pedidoController = new PedidoController();

if (isset($_GET['codigo'])) {
    $codigo_pedido = $_GET['codigo'];
    $pedido = $pedidoController->obtenerPedidoPorCodigo($codigo_pedido);
    $detalles = $pedidoController->obtenerDetallePedido($codigo_pedido);
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Detalles del Pedido: <?php echo $pedido['codigo_pedido']; ?></h2>
    <p><strong>Cliente:</strong> <?php echo $pedido['nombre_cliente']; ?></p>
    <p><strong>Correo:</strong> <?php echo $pedido['correo_cliente']; ?></p>
    <p><strong>Celular:</strong> <?php echo $pedido['celular_cliente']; ?></p>
    <p><strong>Fecha:</strong> <?php echo $pedido['fecha']; ?></p>
    <p><strong>Estado:</strong> <?php echo $pedido['estado']; ?></p>

    <h3 class="mt-4">Productos</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            foreach ($detalles as $detalle) {
                $subtotal = $detalle['cantidad'] * $detalle['precio'];
                $total += $subtotal;
                echo '<tr>';
                echo '<td>' . $detalle['producto_nombre'] . '</td>';
                echo '<td>' . $detalle['cantidad'] . '</td>';
                echo '<td>' . $detalle['precio'] . '</td>';
                echo '<td>' . $subtotal . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right"><strong>Total</strong></td>
                <td><?php echo $total; ?></td>
            </tr>
        </tfoot>
    </table>

    <a href="?views=pedidos" class="btn btn-secondary">Volver a la lista de pedidos</a>
</div>
