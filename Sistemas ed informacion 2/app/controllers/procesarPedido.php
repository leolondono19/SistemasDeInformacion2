<?php
// Ajusta la ruta según la estructura real de tu proyecto
require_once 'C:/xampp/htdocs/VENTAS/config/server.php';

// Incluir PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

// Obtener datos JSON del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Verificar que los datos se recibieron correctamente
if (!isset($data['cliente']) || !isset($data['carrito'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
    exit();
}

$cliente = $data['cliente'];
$carrito = $data['carrito'];

// Preparar conexión a la base de datos
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

// Verificar conexión
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error en la conexión a la base de datos.']);
    exit();
}

// Iniciar transacción
$conn->begin_transaction();

try {
    // Generar un código de pedido único
    $codigo_pedido = 'PED' . date('YmdHis');

    // Insertar datos del pedido
    $stmt = $conn->prepare("INSERT INTO pedido (codigo_pedido, fecha, nombre_cliente, correo_cliente, celular_cliente) VALUES (?, NOW(), ?, ?, ?)");
    $stmt->bind_param("ssss", $codigo_pedido, $cliente['nombre'], $cliente['correo'], $cliente['celular']);
    $stmt->execute();
    $pedidoId = $stmt->insert_id;
    $stmt->close();

    // Insertar productos del carrito
    $stmt = $conn->prepare("INSERT INTO detalle_pedido (codigo_pedido, cantidad, producto_nombre, precio, fecha) VALUES (?, ?, ?, ?, NOW())");
    foreach ($carrito as $item) {
        $stmt->bind_param("sisd", $codigo_pedido, $item['cantidad'], $item['nombre'], $item['precio']);
        $stmt->execute();
    }
    $stmt->close();

    // Confirmar transacción
    $conn->commit();

    // Enviar correo electrónico de confirmación
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Cambia esto por tu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'tu_correo@example.com'; // Cambia esto por tu correo
        $mail->Password = 'tu_contraseña'; // Cambia esto por tu contraseña
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Remitente y destinatario
        $mail->setFrom('tu_correo@example.com', 'Farmacorp');
        $mail->addAddress($cliente['correo'], $cliente['nombre']);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Confirmación de Pedido';
        $mail->Body = '<h1>Gracias por tu compra, ' . htmlspecialchars($cliente['nombre']) . '!</h1>';
        $mail->Body .= '<p>Tu pedido ha sido procesado con éxito. Aquí están los detalles:</p>';
        $mail->Body .= '<ul>';
        foreach ($carrito as $item) {
            $mail->Body .= '<li>' . htmlspecialchars($item['nombre']) . ' - Cantidad: ' . $item['cantidad'] . ' - Precio: ' . number_format($item['precio'], 2) . ' Bs</li>';
        }
        $mail->Body .= '</ul>';
        $mail->Body .= '<p>Total: ' . array_reduce($carrito, function($total, $item) {
            return $total + ($item['precio'] * $item['cantidad']);
        }, 0) . ' Bs</p>';

        $mail->send();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => "El mensaje no pudo ser enviado. Error de correo: {$mail->ErrorInfo}"]);
    }
} catch (Exception $e) {
    // Revertir transacción en caso de error
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

// Cerrar conexión
$conn->close();
?>
