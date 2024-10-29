
<?php
require_once "./config/app.php";
require_once "./autoload.php";

use app\controllers\productController;

$productController = new productController();

if (isset($_GET['id'])) {
    $productId = (int)$_GET['id'];
    $product = $productController->obtenerProductoPorId($productId);
} else {
    // Redirigir a la página de inicio si no se proporciona un ID de producto
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once "./app/views/inc/head.php"; ?>
</head>
<body>
    <?php require_once "./app/views/inc/navbar.php"; ?>

    <div class="container mt-5">
        <?php if ($product): ?>
            <div class="row">
                <div class="col-md-6">
                    <?php 
                    $imagePath = './app/views/productos/' . htmlspecialchars($product['producto_foto']);
                    if (!empty($product['producto_foto']) && file_exists($imagePath)): ?>
                        <img src="<?= $imagePath ?>" class="img-fluid" alt="Foto del producto">
                    <?php else: ?>
                        <img src="./app/views/productos/default.jpg" class="img-fluid" alt="Foto del producto">
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <h1><?= htmlspecialchars($product['producto_nombre']) ?></h1>
                    <p><?= htmlspecialchars($product['producto_descripcion']) ?></p>
                    <p><strong>Precio:</strong> $<?= htmlspecialchars($product['producto_precio']) ?></p>
                </div>
            </div>
        <?php else: ?>
            <p>Producto no encontrado.</p>
        <?php endif; ?>
    </div>

    <?php require_once "./app/views/inc/footer.php"; ?>
    <?php require_once "./app/views/inc/script.php"; ?>
</body>
</html>