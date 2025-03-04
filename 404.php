<?php
session_start();

// Verifica si el usuario está logueado
$is_logged_in = isset($_SESSION['user_id']);
$username = $is_logged_in ? htmlspecialchars($_SESSION['user_id'], ENT_QUOTES, 'UTF-8') : 'Invitado';
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
                                <li class="current-list-item"><a href="index.php">Inicio</a></li>
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

	<!-- search area -->
<div class="search-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <span class="close-btn"><i class="fas fa-window-close"></i></span>
                <div class="search-bar">
                    <div class="search-bar-tablecell">
                        <div class="form-container">
                            <!-- Formulario de Registro -->
                            <div class="form form-register">
                                <h3>Registrarse</h3>
                                <form class="register-form" action="register.php" method="POST">
                                    <input type="text" name="name" placeholder="Usuario" required>
                                    <input type="email" name="email" placeholder="Correo Electrónico" required>
                                    <div class="error-message" id="register-email-error"></div> <!-- Mensaje de error para el correo -->
                                    <input type="tel" name="phone" placeholder="Teléfono" required>
                                    <input type="password" name="password" placeholder="Contraseña" required>
                                    <div class="error-message" id="register-password-error"></div> <!-- Mensaje de error para la contraseña -->
                                    <input type="password" name="confirm_password" placeholder="Confirmar Contraseña" required>
                                    <div class="error-message" id="register-confirm-password-error"></div> <!-- Mensaje de error para confirmar contraseña -->
                                    <button type="submit">Registrarse <i class="fas fa-user-plus"></i></button>
                                </form>
                                <a href="#" class="switch-form"><br>¿Ya tienes cuenta? Inicia sesión aquí</a>
                            </div>

                            <!-- Formulario de Inicio de Sesión -->
                            <div class="form form-login">
                                <h3>Iniciar Sesión</h3>
                                <form class="login-form" action="login.php" method="POST">
                                    <input type="email" name="email" placeholder="Correo Electrónico" required>
                                    <div class="error-message" id="login-email-error"></div> <!-- Mensaje de error para el correo en login -->
                                    <input type="password" name="password" placeholder="Contraseña" required>
                                    <div class="error-message" id="login-password-error"></div> <!-- Mensaje de error para la contraseña en login -->
                                    <button type="submit">Iniciar Sesión <i class="fas fa-sign-in-alt"></i></button>
                                </form>
                                <a href="#" class="switch-form"><br>¿Aún no tienes cuenta? Regístrate aquí</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
<!-- end search area -->

		
		<!-- breadcrumb-section -->
		<div class="breadcrumb-section breadcrumb-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 text-center">
						<div class="breadcrumb-text">
							<p>EN PROCESO</p>
							<h1>Pagina en desarrollo y construccion</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end breadcrumb section -->
		<!-- error section -->
		<div class="full-height-section error-section">
			<div class="full-height-tablecell">
				<div class="container">
					<div class="row">
						<div class="col-lg-8 offset-lg-2 text-center">
							<div class="error-text">
								<i class="far fa-sad-cry"></i>
								<h1>Oops! No esta lista aun.</h1>
								<p>Esta pagina se encuentra desarrollandose.</p>
								<a href="index.html" class="boxed-btn">Back to Home</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end error section -->
		<!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">Nosotros</h2>
						<p>Somos una acogedora cafetería situada en El edificio F. Con su ambiente relajado y comodo, es el lugar perfecto para que los estudiantes.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Encuentranos</h2>
						<ul>
							<li>Edificio F</li>
							<li>6564312296</li>
							<li>6566002981</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">Paginas</h2>
						<ul>
							<li><a href="index.html">Inicio</a></li>
							<li><a href="about.html">Nosotros</a></li>
							<li><a href="shop.html">Menu</a></li>
							<li><a href="order.html">Como comprar</a></li>
							<li><a href="contact.html">Contacto</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">JH Desarrollo</h2>
						<p>Somos una empresa para crear páginas web innovadoras y funcionales que impulsen el crecimiento de nuestros clientes.</p>
						<form action="index.html">
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
					<p>Copyrights &copy; 2024 - <a href="#">UTPN</a>,  All Rights Reserved.</p>
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