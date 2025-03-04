<?php
session_start();
include 'config.php';

// Verifica si el usuario está logueado
$is_logged_in = isset($_SESSION['user_id']);
$username = $is_logged_in ? htmlspecialchars($_SESSION['user_id'], ENT_QUOTES, 'UTF-8') : 'Invitado';

// Si no está logueado, muestra un mensaje de alerta y redirige a la página de inicio
if (!$is_logged_in) {
    echo '<script>
            alert("Usuario no logueado. Por favor, inicia sesión.");
            window.location.href = "shop.php";
          </script>';
    exit();
}

// ID del carrito actual, debe ser dinámico en una aplicación real
$order_id = $_SESSION['order_id'] ?? 0;

// Consulta para obtener los productos del carrito
$query = 'SELECT d.product_id, p.name, p.price, d.quantity
          FROM detalles_del_pedido d
          JOIN productos p ON d.product_id = p.product_id
          WHERE d.order_id = ?';

// Preparar la consulta
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

// Inicializar variables para subtotal y total
$subtotal = 0;
$shipping_cost = 0; // Define el costo de envío aquí o calcula dinámicamente

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
                                    <li><a href="pedidos.php">Pedidos</a></li>
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
                        <p>La serranita</p>
                        <h1>Carrito</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- cart -->
    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="cart-table-wrap">
                        <form id="cart-form" method="POST" action="update_cart.php">
                            <table class="cart-table">
                                <thead class="cart-table-head">
                                    <tr class="table-head-row">
                                        <th class="product-remove">Eliminar</th>
                                        <th class="product-image">Imagen del producto</th>
                                        <th class="product-name">Producto</th>
                                        <th class="product-price">Precio</th>
                                        <!-- Comentado para eliminar la opción de cantidad -->
                                        <!-- <th class="product-quantity">Cantidad</th> -->
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($result->num_rows > 0): ?>
                                        <?php while ($row = $result->fetch_assoc()): ?>
                                            <?php 
                                                $product_total = $row['price'] * $row['quantity'];
                                                $subtotal += $product_total;
                                            ?>
                                            <tr class="table-body-row">
                                                <td class="product-remove">
                                                    <a href="remove_product.php?product_id=<?php echo $row['product_id']; ?>">
                                                        <i class="far fa-window-close"></i>
                                                    </a>
                                                </td>
                                                <td class="product-image">
                                                    <img src="assets/img/products/product-img-<?php echo $row['product_id']; ?>.jpg" alt="<?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?>">
                                                </td>
                                                <td class="product-name"><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td class="product-price">$<?php echo number_format($row['price'], 2); ?></td>
                                                <!-- Comentado para eliminar la opción de cantidad -->
                                                <!-- <td class="product-quantity">
                                                    <input type="number" name="quantity[<?php echo $row['product_id']; ?>]" value="<?php echo $row['quantity']; ?>" min="0">
                                                </td> -->
                                                <td class="product-total">$<?php echo number_format($product_total, 2); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr><td colspan="6">No hay productos en el carrito.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <!-- Comentado para eliminar el botón de actualizar carrito -->
                            <!-- <button type="submit" class="boxed-btn">Actualizar Carrito</button> -->
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="total-section">
                        <table class="total-table">
                            <thead class="total-table-head">
                                <tr class="table-total-row">
                                    <th>Total</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="total-data">
                                    <td><strong>Subtotal: </strong></td>
                                    <td>$<?php echo number_format($subtotal, 2); ?></td>
                                </tr>
                                <tr class="total-data">
                                    <td><strong>Envio: </strong></td>
                                    <td>$<?php echo number_format($shipping_cost, 2); ?></td>
                                </tr>
                                <tr class="total-data">
                                    <td><strong>Total: </strong></td>
                                    <td id="total-price">$<?php echo number_format($subtotal + $shipping_cost, 2); ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="coupon-section">
                            <h3>Instrucciones</h3>
                            <div class="coupon-form-wrap">
                            <form id="order-form" method="POST" action="process_order.php">
                                <p><input type="text" name="instructions" placeholder="Agregue instrucciones de modo de preparación" required></p>
                                <a href="#" class="boxed-btn black" id="send-order-btn">Enviar pedido</a>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end cart -->


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
	<script>
    	const subtotal = <?php echo $subtotal; ?>;
    	const shippingCost = <?php echo $shipping_cost; ?>;
	</script>
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