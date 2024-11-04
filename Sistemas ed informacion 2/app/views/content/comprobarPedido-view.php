<?php
require_once __DIR__ . '/../../../config/server.php'; // Ajusta la ruta para incluir server.php
require_once __DIR__ . '/../../../config/app.php'; // Ajusta la ruta para incluir app.php
require_once __DIR__ . '/../../controllers/PedidoController.php'; // Asegúrate de que la ruta sea correcta

if (!isset($_GET['codigo_pedido'])) {
    echo "No se ha proporcionado un código de pedido.";
    exit();
}

$codigo_pedido = $_GET['codigo_pedido'];

// Consulta para obtener información del pedido y detalles
$consulta_pedido = $conexion->prepare("
    SELECT p.pedido_id, p.codigo_pedido, p.fecha, p.nombre_cliente, p.correo_cliente, p.celular_cliente, 
           p.estado, p.metodo_pago, dp.producto_nombre, dp.cantidad, dp.precio 
    FROM pedido p
    LEFT JOIN detalle_pedido dp ON p.codigo_pedido = dp.codigo_pedido
    WHERE p.codigo_pedido = :codigo_pedido
");
$consulta_pedido->bindParam(":codigo_pedido", $codigo_pedido, PDO::PARAM_STR);
$consulta_pedido->execute();
$detalles_pedido = $consulta_pedido->fetchAll(PDO::FETCH_ASSOC);

if (count($detalles_pedido) == 0) {
    echo "No se encontraron detalles para el pedido.";
    exit();
}

// Variables para almacenar información del pedido
$nombre_cliente = $detalles_pedido[0]['nombre_cliente'];
$correo_cliente = $detalles_pedido[0]['correo_cliente'];
$celular_cliente = $detalles_pedido[0]['celular_cliente'];
$fecha_pedido = $detalles_pedido[0]['fecha'];
$estado_pedido = $detalles_pedido[0]['estado'];
$metodo_pago = $detalles_pedido[0]['metodo_pago'];

// Calcular el total del pedido
$total_pedido = 0;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Pedido</title>
    <link rel="stylesheet" href="../app/views/css/estilos.css"> <!-- Enlace a tu archivo de estilos CSS -->
</head>
<body>
    <h1>Detalle del Pedido</h1>

    <h2>Información del Cliente</h2>
    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre_cliente); ?></p>
    <p><strong>Correo:</strong> <?php echo htmlspecialchars($correo_cliente); ?></p>
    <p><strong>Celular:</strong> <?php echo htmlspecialchars($celular_cliente); ?></p>
    <p><strong>Fecha del Pedido:</strong> <?php echo htmlspecialchars($fecha_pedido); ?></p>
    <p><strong>Estado:</strong> <?php echo htmlspecialchars($estado_pedido); ?></p>
    <p><strong>Método de Pago:</strong> <?php echo htmlspecialchars($metodo_pago); ?></p>

    <h2>Productos del Pedido</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalles_pedido as $detalle): ?>
                <?php
                    $subtotal = $detalle['cantidad'] * $detalle['precio'];
                    $total_pedido += $subtotal;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($detalle['producto_nombre']); ?></td>
                    <td><?php echo htmlspecialchars($detalle['cantidad']); ?></td>
                    <td><?php echo number_format($detalle['precio'], 2); ?></td>
                    <td><?php echo number_format($subtotal, 2); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"><strong>Total a Pagar:</strong></td>
                <td><strong><?php echo number_format($total_pedido, 2); ?></strong></td>
            </tr>
        </tbody>
    </table>

    <p><a href="pedidos.php">Volver a la lista de pedidos</a></p>
</body>
</html>
