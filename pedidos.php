<?php
session_start();
include 'config.php';
date_default_timezone_set('America/Ojinaga');

// Verifica si el usuario está logueado
$is_logged_in = isset($_SESSION['user_id']);
$username = $is_logged_in ? htmlspecialchars($_SESSION['user_id'], ENT_QUOTES, 'UTF-8') : 'Invitado';

// Si no está logueado, muestra un mensaje de alerta y redirige a la página de inicio
if (!$is_logged_in) {
    echo '<script>
            alert("Usuario no logueado. Por favor, inicia sesión.");
            window.location.href = "index.php";
          </script>';
    exit();
}

// Obtiene el rol del usuario
$user_id = $_SESSION['user_id'];
$query = 'SELECT role FROM usuarios WHERE user_id = ?';
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$user_role = $row['role'];
$stmt->close();

// Obtener la fecha actual
$today = date('Y-m-d');

// Obtener los pedidos y los detalles del pedido
$query = '
    SELECT p.order_id, p.order_date, p.total_price, p.status, p.instructions, 
           d.product_id, d.quantity, pr.name AS product_name, pr.price AS product_price,
           u.email AS user_email
    FROM pedidos p
    LEFT JOIN detalles_del_pedido d ON p.order_id = d.order_id
    LEFT JOIN productos pr ON d.product_id = pr.product_id
    LEFT JOIN usuarios u ON p.user_id = u.user_id
    WHERE p.status != "cancelado"
';


if ($user_role != 'administrador') {
    $query .= ' AND p.user_id = ? AND DATE(p.order_date) = ?';
} else {
    $query .= ' AND p.status IN ("en curso", "espera")';
}


// Preparar y ejecutar la consulta
$stmt = $conn->prepare($query);
if ($user_role != 'administrador') {
    $stmt->bind_param('is', $user_id, $today);
}
$stmt->execute();
$results = $stmt->get_result();


// Organizar los pedidos y productos
$orders = [];
while ($row = $results->fetch_assoc()) {
    $order_id = $row['order_id'];
    if (!isset($orders[$order_id])) {
        $orders[$order_id] = [
            'order_id' => $row['order_id'],
            'order_date' => $row['order_date'],
            'total_price' => $row['total_price'],
            'status' => $row['status'],
            'instructions' => $row['instructions'],
            'user_email' => $row['user_email'], // Agregar el correo electrónico
            'products' => []
        ];
    }
    $orders[$order_id]['products'][] = [
        'name' => $row['product_name'],
        'price' => $row['product_price'],
        'quantity' => $row['quantity']
    ];
}

$stmt->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>La Serranita</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- animate css -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- mean menu css -->
    <link rel="stylesheet" href="assets/css/meanmenu.min.css">
    <!-- main style -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- responsive -->
    <link rel="stylesheet" href="assets/css/responsive.css">

</head>
<body>
    <!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->
    
    <!-- header -->
		<div class="top-header-area" id="sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <div class="main-menu-wrap">
                        <!-- logo -->
                        <div class="site-logo">
                            <a href="index.php">
                                <img src="assets/img/logo.png" alt="La Serranita">
                            </a>
                        </div>
                        <!-- logo -->

                        <!-- menu start -->
                        <nav class="main-menu">
                            <ul>
                                <li><a href="index.php">Inicio</a></li>
                                <li><a href="shop.php">Menú</a>
                                    <ul class="sub-menu">
                                        <li><a href="shop.php#platillos">Platillos</a></li>
                                        <li><a href="shop.php#burritos">Burritos</a></li>
                                        <li><a href="shop.php#quesadillas">Quesadillas</a></li>
                                        <li><a href="shop.php#sandwich">Sandwiches</a></li>
                                        <li><a href="shop.php#hamburguesa">Hamburguesas</a></li>
                                        <li><a href="shop.php#nachos">Nachos</a></li>
                                        <li><a href="shop.php#otros">Otros</a></li>
                                    </ul>
                                </li>
                                <li><a href="about.php">Nosotros</a></li>
                                <li><a href="order.php">Cómo Comprar</a></li>
                                <li><a href="contact.php">Contacto</a></li>
                                <!-- Agrega un nuevo elemento de menú si el usuario está logueado -->
                                <?php if ($is_logged_in): ?>
                                    <li class="current-list-item"><a href="pedidos.php">Pedidos</a></li>
                                <?php endif; ?>
                                <li>
                                    <div class="header-icons">
                                        <a class="shopping-cart" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
                                        <!-- Mostrar 'Cerrar sesión' si el usuario está logueado, de lo contrario mostrar el icono de usuario -->
                                        <?php if ($is_logged_in): ?>
                                            <a href="logout.php" class="header-icon logout-icon"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
                                        <?php else: ?>
                                            <a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-user"></i></a>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-user"></i></a>
                        <div class="mobile-menu"></div>
                        <!-- menu end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header -->

    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>La Serranita</p>
                        <h1>Pedidos</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- Contenedor del carousel -->
    <div class="carousel-container">
        <button class="carousel-btn prev-btn">&#10094;</button>
        <div class="carousel">
            <?php if (empty($orders)): ?>
                <div class="no-orders-message">
                    <p>Aún no se han realizado pedidos.</p>
                </div>
            <?php else: ?>
                <?php foreach ($orders as $order): ?>
                    <div class="carousel-slide">
                        <div class="carousel-text-container">
                            <h4>Pedido #<?php echo htmlspecialchars($order['order_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h4>
                            <!-- Mostrar el correo del usuario -->
                            <p><strong>Correo del Usuario:</strong> <?php echo htmlspecialchars($order['user_email'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                            <p><strong>Fecha:</strong> <?php echo htmlspecialchars($order['order_date'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                            <p><strong>Total:</strong> $<?php echo htmlspecialchars($order['total_price'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                            <p><strong>Status:</strong> <?php echo htmlspecialchars($order['status'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                            <p><strong>Instrucciones:</strong> <?php echo htmlspecialchars($order['instructions'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>

                            <!-- Mostrar productos del pedido -->
                            <p><strong>Productos:</strong></p>
                            <ul>
                                <?php foreach ($order['products'] as $product): ?>
                                    <li><?php echo htmlspecialchars($product['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?> - $<?php echo htmlspecialchars($product['price'] ?? '', ENT_QUOTES, 'UTF-8'); ?> x <?php echo htmlspecialchars($product['quantity'] ?? '', ENT_QUOTES, 'UTF-8'); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <?php if ($user_role == 'administrador'): ?>
                            <div class="update-buttons">
                                <!-- Botones para cambiar el estado -->
                                <button class="btn btn-warning" onclick="updateStatus('<?php echo htmlspecialchars($order['order_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>', 'en curso')">En Curso</button>
                                <button class="btn btn-success" onclick="updateStatus('<?php echo htmlspecialchars($order['order_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>', 'preparado')">Preparado</button>
                                <button class="btn btn-danger" onclick="updateStatus('<?php echo htmlspecialchars($order['order_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>', 'cancelado')">Cancelado</button>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <button class="carousel-btn next-btn">&#10095;</button>
    </div>

    <!-- JavaScript para la confirmación y redirección -->
    <script>
    function updateStatus(orderId, newStatus) {
        if (confirm('¿Estás seguro de que deseas cambiar el estado del pedido a ' + newStatus + '?')) {
            // Redirige al archivo PHP con el estado actualizado
            window.location.href = 'update_order_status.php?order_id=' + encodeURIComponent(orderId) + '&status=' + encodeURIComponent(newStatus);
        }
    }
    </script>



	<!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">Nosotros</h2>
						<p>Somos una acogedora cafetería situada en el Edificio F. Con su ambiente relajado y cómodo, es el lugar perfecto para que los estudiantes.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Encuéntranos</h2>
						<ul>
							<li>Edificio F</li>
							<li>6564312296</li>
							<li>6566002981</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">Páginas</h2>
						<ul>
							<li><a href="index.php">Inicio</a></li>
							<li><a href="about.php">Nosotros</a></li>
							<li><a href="shop.php">Menú</a></li>
							<li><a href="order.php">Cómo comprar</a></li>
							<li><a href="contact.php">Contacto</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">JH Desarrollo</h2>
						<p>Somos una empresa que crea páginas web innovadoras y funcionales para impulsar el crecimiento de nuestros clientes.</p>
						<form action="index.php">
							<input type="email" placeholder="Email">
							<button type="submit"><i class="fas fa-paper-plane"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->

	<!-- copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p>&copy; 2024 <a href="#">UTPN</a>. Todos los derechos reservados.</p>
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<div class="social-icons">
						<ul>
							<li><a href="https://www.facebook.com/laserranitabanquetes" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end copyright -->

	<!-- jquery -->
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="assets/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="assets/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="assets/js/sticker.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>

</body>
</html>