<?php
require_once "./config/app.php";
require_once "./autoload.php";

use app\controllers\productController;

$productController = new productController();

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$productosPorPagina = 12;

$products = $productController->obtenerProductos($pagina, $productosPorPagina);
$totalProductos = $productController->contarProductos();
$totalPaginas = ceil($totalProductos / $productosPorPagina);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once "./app/views/inc/head.php"; ?>
</head>
<body>
    <?php require_once "./app/views/inc/navbar.php"; ?>

    <div class="container mt-5">
        <h1>NUESTROS PRODUCTOS</h1>
        <div class="row" id="perfumes">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <?php 
                            $imagePath = './app/views/productos/' . htmlspecialchars($product['producto_foto']);
                            if (!empty($product['producto_foto']) && file_exists($imagePath)): ?>
                                <img src="<?= $imagePath ?>" class="card-img-top" alt="Foto del producto">
                            <?php else: ?>
                                <img src="./app/views/productos/default.jpg" class="card-img-top" alt="Foto del producto">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($product['producto_nombre']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($product['producto_descripcion']) ?></p>
                                <a href="product-detail.php?id=<?= $product['producto_id'] ?>" class="btn btn-primary">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Paginación -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item <?= ($i == $pagina) ? 'active' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

    <?php require_once "./app/views/inc/footer.php"; ?>
    <?php require_once "./app/views/inc/script.php"; ?>
</body>
</html>