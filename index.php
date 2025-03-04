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
    <meta name="description" content="Plantilla de tienda Bootstrap4 responsiva, creada por Imran Hossain desde https://imransdesign.com/">

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
    
    <!-- PreLoader -->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!-- PreLoader Ends -->
    
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

	<!-- home page slider -->
	<div class="homepage-slider">
		<!-- single home slider -->
		<div class="single-homepage-slider homepage-bg-1">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
						<div class="hero-text">
							<div class="hero-text-tablecell">
								<p class="subtitle">Rico y Variable</p>
								<h1>El Sabor de la Sierra</h1>
								<div class="hero-btns">
									<a href="shop.php" class="boxed-btn">Menú</a>
									<a href="contact.php" class="bordered-btn">Contáctanos</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- single home slider -->
		<div class="single-homepage-slider homepage-bg-2">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 offset-lg-1 text-center">
						<div class="hero-text">
							<div class="hero-text-tablecell">
								<p class="subtitle">Estudio y Sabor</p>
								<h1>Tómate un Break</h1>
								<div class="hero-btns">
									<a href="order.php" class="boxed-btn">Cómo Comprar</a>
									<a href="contact.php" class="bordered-btn">Contáctanos</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- single home slider -->
		<div class="single-homepage-slider homepage-bg-3">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 offset-lg-1 text-right">
						<div class="hero-text">
							<div class="hero-text-tablecell">
								<p class="subtitle">Estudia Mejor</p>
								<h1>Sabores que Inspiran tu Estudio</h1>
								<div class="hero-btns">
									<a href="cart.php" class="boxed-btn">Carrito</a>
									<a href="contact.php" class="bordered-btn">Contáctanos</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end home page slider -->

	<!-- features list section -->
	<div class="list-section pt-80 pb-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-shipping-fast"></i>
						</div>
						<div class="content">
							<h3>Ordena Gratis</h3>
							<p>No te costará ordenar</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-phone-volume"></i>
						</div>
						<div class="content">
							<h3>Horario Escolar</h3>
							<p>Pide desde tu salón</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="list-box d-flex justify-content-start align-items-center">
						<div class="list-icon">
							<i class="fas fa-sync"></i>
						</div>
						<div class="content">
							<h3>Pide y Listo</h3>
							<p>Recoge tu pedido en cafetería</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end features list section -->

	<!-- advertisement section -->
	<div class="abt-section mt-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="abt-bg">
						<video class="video-siempre" autoplay muted loop>
							<source src="assets/img/WhatsApp Video 2024-07-09 at 2.01.54 PM.mp4" type="video/mp4">
						</video>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="abt-text">
						<p class="top-sub">Desde 2010</p>
						<h2>Nosotros somos <span class="orange-text">La Serranita</span></h2>
						<p>¡Conoce "La Serranita", la cafetería de la Universidad Tecnológica Paso del Norte (UTPN)! Esta cafetería ofrece una amplia variedad de platillos deliciosos, desde tacos y burritos hasta enchiladas y hamburguesas. Además, encontrarás bebidas básicas, frituras y productos.</p>
						<p>Ofrecemos una experiencia única con un ambiente amigable y accesible para todos los estudiantes y personal de la UTPN.</p>
						<a href="about.php" class="boxed-btn mt-4">Conoce Más</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end advertisement section -->

	<!-- shop banner -->
	<section class="shop-banner">
		<div class="container">
			<h3>Agosto es el mejor mes <span class="orange-text">para comprar</span></h3>
			<div class="sale-percent"><span>Visita <br> Compra</span> 100% <span>atención</span></div>
			<a href="shop.php" class="cart-btn btn-lg">Pedir Ahora</a>
		</div>
	</section>
	<!-- end shop banner -->

	<!-- latest news -->
	<div class="latest-news pt-150 pb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">    
						<h3><span class="orange-text">Nuestros</span> Productos</h3>
						<p>La Serranita: Disfruta de comida casera y sabores auténticos que energizan tu estudio.</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<a href="shop.php#platillos"><div class="latest-news-bg news-bg-1"></div></a>
						<div class="news-text-box">
							<h3><a href="shop.php#platillos">Enchiladas</a></h3>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<a href="shop.php#platillos"><div class="latest-news-bg news-bg-2"></div></a>
						<div class="news-text-box">
							<h3><a href="shop.php#platillos">Hamburguesa de Boneless</a></h3>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
					<div class="single-latest-news">
						<a href="shop.php#platillos"><div class="latest-news-bg news-bg-3"></div></a>
						<div class="news-text-box">
							<h3><a href="shop.php#platillos">Boneless</a></h3>                            
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<a href="shop.php" class="cart-btn mt-3"><i class="fas fa-shopping-cart"></i> Comprar</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end latest news -->


	<!-- testimonail-section -->
	<div class="testimonail-section mt-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center">
					<h2>Equipo</h2><br><br><br>
					<div class="testimonial-sliders">
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/cajera.png" alt="Cajero">
							</div>
							<div class="client-meta">
								<h3>Cajero <span>Atención a clientes</span></h3>
								<p class="testimonial-body">
									"La mejor experiencia que tendrás al comprar."
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/gerente.png" alt="Gerente">
							</div>
							<div class="client-meta">
								<h3>Gerente <span>Gerente</span></h3>
								<p class="testimonial-body">
									"La mejor calidad de productos."
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/cocinero.png" alt="Parrillero">
							</div>
							<div class="client-meta">
								<h3>Parrillero <span>Cocinero</span></h3>
								<p class="testimonial-body">
									"El mejor sazón y elaboración de platillos."
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end testimonail-section -->	
	
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