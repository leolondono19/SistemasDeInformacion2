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
                <th>Estado</th> <!-- Cambiar el nombre de la columna Acciones a Estado -->
                <th>Actualizar</th> <!-- Nueva columna para el botón de actualizar -->
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

                // Columna Estado con el combo box para seleccionar el estado
                echo '<td>';
                echo '<select class="form-select" name="estado_' . $pedido['pedido_id'] . '">';
                echo '<option value="pendiente"' . ($pedido['estado'] == 'pendiente' ? ' selected' : '') . '>Pendiente</option>';
                echo '<option value="comprobado"' . ($pedido['estado'] == 'comprobado' ? ' selected' : '') . '>Comprobado</option>';
                echo '<option value="completado"' . ($pedido['estado'] == 'completado' ? ' selected' : '') . '>Completado</option>';
                echo '</select>';
                echo '</td>';

                // Columna Actualizar con el botón de actualización
                echo '<td><button class="btn btn-success"><i class="fas fa-sync-alt"></i></button></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>
