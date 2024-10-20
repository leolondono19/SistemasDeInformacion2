<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once "./app/views/inc/head.php"; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="app/views/css/home.css" rel="stylesheet"> 
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">FARMACORP</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#nosotros">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#perfumes">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contactos">Contáctanos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary" href="?views=login">Login</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="cart-icon" data-bs-toggle="modal" data-bs-target="#cartModal">
                            <i class="fas fa-shopping-cart"></i> Carrito (<span id="cart-count">0</span>)
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Carrito de Compras</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <table id="cart-items" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario (Bs)</th>
                                <th>Total (Bs)</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                    <p><strong>Total: </strong> <span id="cart-total">0.00 Bs</span></p>
                    <hr>
                    
                    <h5>Información del Cliente</h5>
                    <div class="mb-3">
                        <label for="nombreCliente" class="form-label">Nombre del Cliente</label>
                        <input type="text" class="form-control" id="nombreCliente" required>
                    </div>
                    <div class="mb-3">
                        <label for="correoCliente" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correoCliente" required>
                    </div>
                    <div class="mb-3">
                        <label for="celularCliente" class="form-label">Número de Celular</label>
                        <input type="text" class="form-control" id="celularCliente" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="clear-cart" type="button" class="btn btn-danger">Vaciar Carrito</button>
                    <button id="procederPago" type="button" class="btn btn-success">Proceder al Pago</button>
                </div>
            </div>
        </div>
    </div>

    <div id="main-content" class="container mt-5 pt-5">
        <h1>Bienvenido a nuestra tienda de perfumes</h1>
        <p>¡Explora nuestra amplia gama de perfumes y encuentra tu fragancia perfecta!</p>

        <h2 id="nosotros">Nuestra tienda y trabajadores</h2>

        <div class="my-4 px-3 py-3 bg-light rounded">

            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./app/views/img/sliders/1.jpg" class="d-block w-100" alt="Imagen 1">
                    </div>
                    <div class="carousel-item">
                        <img src="./app/views/img/sliders/2.jpg" class="d-block w-100" alt="Imagen 2">
                    </div>
                    <div class="carousel-item">
                        <img src="./app/views/img/sliders/3.jpg" class="d-block w-100" alt="Imagen 3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
          
        <h1>RECONOCIMIENTOS PROPIOS</h1>
       
        <section id="reconocimientos" class="container my-5">
            <div class="row row-anim">
                <div class="col-md-4 recognition-item">
                    <i class="icono-mediano fas fa-trophy"></i>
                    <p>Premio a la Innovación 2024</p>
                </div>
                <div class="col-md-4 recognition-item">
                    <i class="icono-mediano fas fa-star"></i>
                    <p>Premio de Excelencia en Servicio al Cliente</p>
                </div>
                <div class="col-md-4 recognition-item">
                    <i class="icono-mediano fas fa-medal"></i>
                    <p>Premio a la Mejor Nueva Marca</p>
                </div>
            </div>
            <div class="row row-anim">
                <div class="col-md-4 recognition-item">
                    <i class="icono-mediano fas fa-certificate"></i>
                    <p>Certificación de Calidad Oro</p>
                </div>
                <div class="col-md-4 recognition-item">
                    <i class="icono-mediano fas fa-award"></i>
                    <p>Premio al Emprendedor del Año</p>
                </div>
                <div class="col-md-4 recognition-item">
                    <i class="icono-mediano fas fa-cup"></i>
                    <p>Reconocimiento a la Responsabilidad Social Empresarial</p>
                </div>
            </div>
            <div class="row row-anim">
                <div class="col-md-4 recognition-item">
                    <i class="icono-mediano fas fa-shield-alt"></i>
                    <p>Premio a la Innovación Tecnológica</p>
                </div>
                <div class="col-md-4 recognition-item">
                    <i class="icono-mediano fas fa-badge"></i>
                    <p>Premio al Impacto Ambiental Positivo</p>
                </div>
                <div class="col-md-4 recognition-item">
                    <i class="icono-mediano fas fa-star-half-alt"></i>
                    <p>Premio a la Mejor Campaña de Marketing</p>
                </div>
            </div>
        </section>

        <h1>NUESTROS PRODUCTOS</h1>

        <!-- Sección de productos -->
        <div class="row" id="perfumes">
            <?php
            use app\controllers\productController;

            $productController = new productController();

            $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $productosPorPagina = 12;

            $products = $productController->obtenerProductos($pagina, $productosPorPagina);
            $totalProductos = $productController->contarProductos();
            $totalPaginas = ceil($totalProductos / $productosPorPagina);

            
            if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <?php 
                            
                            $imagePath = './app/views/productos/' . htmlspecialchars($product['producto_foto']);
                            if (!empty($product['producto_foto']) && file_exists($imagePath)): ?>
                                <img src="<?= $imagePath ?>" class="card-img-top" alt="Foto del producto">
                            <?php else: ?>
                                <img src="./app/views/img/productos/default.jpg" class="card-img-top" alt="Foto del producto">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($product['producto_nombre']) ?></h5>
                                <p class="card-text"><strong>Marca: </strong> <?= htmlspecialchars($product['producto_marca']) ?></p>
                                <p class="card-text"><strong>Modelo: </strong> <?= htmlspecialchars($product['producto_modelo']) ?></p>
                                <p class="card-text"><strong>Precio: </strong><?= number_format((float)$product['producto_precio_venta'], 2, '.', '') ?> Bs</p>
                                <button class="btn btn-primary add-to-cart-btn" data-product-id="<?= $product['producto_id'] ?>" 
                                        data-product-name="<?= htmlspecialchars($product['producto_nombre']) ?>"
                                        data-product-price="<?= number_format((float)$product['producto_precio_venta'], 2, '.', '') ?>">
                                    Añadir al carrito
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay productos disponibles en este momento.</p>
            <?php endif; ?>
        </div>
    </div>

        <nav aria-label="Página de navegación">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= $pagina <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=<?= max(1, $pagina - 1) ?>">Anterior</a>
                </li>
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item <?= $pagina == $i ? 'active' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $pagina >= $totalPaginas ? 'disabled' : '' ?>">
                    <a class="page-link" href="?pagina=<?= min($totalPaginas, $pagina + 1) ?>">Siguiente</a>
                </li>
            </ul>
        </nav>

        <!-- Sección de Carrusel de Marcas -->
        <section id="carousel-marcas" class="text-center mt-5">
            <h2>Nuestras Marcas</h2>
            <div class="marcas-carousel-container">
                <div class="marcas-carousel-track">
                    <div class="marcas-carousel-item"><img src="./app/views/img/marcas/marca1.jpg" alt="Mamá y Bebé"></div>
                    <div class="marcas-carousel-item"><img src="./app/views/img/marcas/marca2.png" alt="Cuidado Personal"></div>
                    <div class="marcas-carousel-item"><img src="./app/views/img/marcas/marca3.jpeg" alt="Salus y Medicamentos"></div>
                    <div class="marcas-carousel-item"><img src="./app/views/img/marcas/marca4.jpeg" alt="Accesorios de cuidado"></div>
                    <div class="marcas-carousel-item"><img src="./app/views/img/marcas/marca5.jpg" alt="Cuidado del Hogar"></div>
                    <div class="marcas-carousel-item"><img src="./app/views/img/marcas/marca6.jpg" alt="Supermercado"></div>
                </div>
            </div>
        </section>

        <section id="contactos" class="text-center mt-5">
            <h2>Contáctanos</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="contact-form">
                        <h3>Formulario de Contacto</h3>
                        <form action="contact_form_handler.php" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control input-square" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control input-square" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Mensaje</label>
                                <textarea class="form-control input-square" id="message" name="message" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-custom">Enviar</button>
                        </form>
                    </div>
                    <h3 class="mt-5">Encuéntranos en el Mapa</h3>
                    <div id="map">
                       
                        <iframe src="https://www.google.com/maps/embed?..." width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <h3 class="mt-5">Redes Sociales</h3>
                    <div class="social-buttons">
                        <a href="#" class="btn btn-primary btn-custom">Facebook</a>
                        <a href="#" class="btn btn-primary btn-custom">Instagram</a>
                        <a href="#" class="btn btn-primary btn-custom">Twitter</a>
                        <a href="#" class="btn btn-primary btn-custom">YouTube</a>
                    </div>
                </div>
            </div>
        </section>

        <div class="gallery">
            <div class="card">
                <figure>
                    <img src="app/views/img/galeria/1.jpeg" alt="1">
                </figure>
            </div>
            <div class="card">
                <figure>
                    <img src="app/views/img/galeria/2.jpeg" alt="2">
                </figure>
            </div>
            <div class="card">
                <figure>
                    <img src="app/views/img/galeria/3.png" alt="3">
                </figure>
            </div>
            <div class="card">
                <figure>
                    <img src="app/views/img/galeria/4.jpg" alt="4">
                </figure>
            </div>
            <div class="card">
                <figure>
                    <img src="app/views/img/galeria/5.jpg" alt="5">
                </figure>
            </div>
            <div class="card">
                <figure>
                    <img src="app/views/img/galeria/8.jpg" alt="6">
                </figure>
            </div>
            <div class="card">
                <figure>
                    <img src="app/views/img/galeria/9.jpg" alt="9">
                </figure>
            </div>
        </div>
        <div class="gallery">
            <div class="card">
                <figure>
                    <img src="app/views/img/galeria/10.jpg" alt="10">
                </figure>
            </div>
            <div class="card">
                <figure>
                    <img src="app/views/img/galeria/11.jpg" alt="11">
                </figure>
            </div>
            <div class="card">
                <figure>
                    <img src="app/views/img/galeria/12.jpg" alt="12">
                </figure>
            </div>
            <div class="card">
                <figure>
                    <img src="app/views/img/galeria/13.jpg" alt="13">
                </figure>
            </div>
            <div class="card">
                <figure>
                    <img src="app/views/img/galeria/14.jpg" alt="14">
                </figure>
            </div>
            <div class="card">
                <figure>
                    <img src="app/views/img/galeria/15.jpg" alt="15">
                </figure>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3">
        <div class="container">
            <p>&copy; 2024 UCB FRAGANCIAS. Todos los derechos reservados.</p>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cart = [];
            const cartCountElement = document.getElementById('cart-count');
            const cartTableBody = document.querySelector('#cart-items tbody');
            const cartTotalSpan = document.querySelector('#cart-total');

            function updateCartTable() {
                cartTableBody.innerHTML = '';
                let total = 0;
                cart.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${item.name}</td>
                        <td>${item.quantity}</td>
                        <td>${item.price.toFixed(2)} Bs</td>
                        <td>${(item.price * item.quantity).toFixed(2)} Bs</td>
                    `;
                    cartTableBody.appendChild(row);
                    total += item.price * item.quantity;
                });
                cartTotalSpan.textContent = total.toFixed(2) + ' Bs';
                const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
                cartCountElement.textContent = totalItems;
            }

            function addToCart(productId, productName, productPrice) {
                const existingProductIndex = cart.findIndex(item => item.id === productId);
                if (existingProductIndex > -1) {
                    cart[existingProductIndex].quantity++;
                } else {
                    cart.push({ id: productId, name: productName, price: parseFloat(productPrice), quantity: 1 });
                }
                updateCartTable();
            }

            document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const productId = button.getAttribute('data-product-id');
                    const productName = button.getAttribute('data-product-name');
                    const productPrice = button.getAttribute('data-product-price');
                    addToCart(productId, productName, productPrice);
                });
            });

            document.querySelector('#clear-cart').addEventListener('click', () => {
                cart.length = 0;
                updateCartTable();
            });

            document.querySelector('#procederPago').addEventListener('click', () => {
                const clienteInfo = {
                    nombre: document.querySelector('#nombreCliente').value,
                    correo: document.querySelector('#correoCliente').value,
                    celular: document.querySelector('#celularCliente').value
                };

                if (!clienteInfo.nombre || !clienteInfo.correo || !clienteInfo.celular) {
                    alert("Por favor, rellena todos los campos de información del cliente.");
                    return;
                }

                if (cart.length === 0) {
                    alert("El carrito está vacío.");
                    return;
                }

                const cartData = cart.map(item => ({
                    nombre: item.name,
                    cantidad: item.quantity,
                    precio: item.price
                }));

                fetch('app/controllers/procesarPedido.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        cliente: clienteInfo,
                        carrito: cartData
                    })
                })
                .then(response => response.text()) 
                .then(text => {
                    try {
                        const data = JSON.parse(text);
                        if (data.success) {
                            alert("Pedido procesado con éxito.");
                            cart.length = 0;
                            updateCartTable();
                            document.querySelector('#nombreCliente').value = '';
                            document.querySelector('#correoCliente').value = '';
                            document.querySelector('#celularCliente').value = '';
                        } else {
                            alert("Hubo un error al procesar el pedido: " + data.message);
                        }
                    } catch (e) {
                        alert("Error en la respuesta del servidor: " + text);
                        console.error('Error:', e);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("Hubo un error al procesar el pedido.");
                });
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            const track = document.querySelector('.marcas-carousel-track');
            const items = document.querySelectorAll('.marcas-carousel-item');
            const itemWidth = items[0].offsetWidth + parseInt(getComputedStyle(items[0]).marginRight);
            const totalItems = items.length;
            
            for (let i = 0; i < totalItems; i++) {
                const clone = items[i].cloneNode(true);
                track.appendChild(clone);
            }

            let offset = 0;
            const speed = 0.5; 
            const resetPoint = itemWidth * totalItems; 

            function scrollCarousel() {
                offset += speed;

                
                if (offset >= resetPoint) {
                    
                    offset = 0;
                    track.appendChild(track.firstElementChild); 
                }

                track.style.transform = `translateX(-${offset}px)`;

                requestAnimationFrame(scrollCarousel);
            }

            scrollCarousel();
        });

    </script>

</body>
</html>
