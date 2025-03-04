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
                                <li><a href="index.php">Inicio</a></li>
                                <li class="current-list-item"><a href="shop.php">Menú</a>
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
						<p>La Serranita</p>
						<h1>Menú</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- products -->
	<div id="platillos" class="product-section mt-150 mb-150">
		<div class="container">
			<div class="mt-80 mb-80 color-seccion">
				<h1 class="shoph1">Platillos</h1>
			</div>
			<div class="row product-lists">
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/1-pechuga.jpg" alt=""></a>
						</div>
						<h3>Pechuga A La Plancha</h3>
						<p class="product-price"><span>C/Plato</span> 100$ </p>
						<a href="#" class="cart-btn" data-id="1"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center berry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/2-milanesa.jpg" alt=""></a>
						</div>
						<h3>Milanesa</h3>
						<p class="product-price"><span>C/Plato</span> 100$ </p>
						<a href="#" class="cart-btn" data-id="2"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center lemon">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/3-enchiladas.jpg" alt=""></a>
						</div>
						<h3>Enchiladas rojas de Queso</h3>
						<p class="product-price"><span>$20 extras con pollo</span> 80$ </p>
						<a href="#" class="cart-btn" data-id="3"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/4-enchiladas.jpg" alt=""></a>
						</div>
						<h3>Enchiladas Verdes de Queso</h3>
						<p class="product-price"><span>$20 extras con pollo</span> 90$ </p>
						<a href="#" class="cart-btn" data-id="4"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/5-chuleta.jpg" alt=""></a>
						</div>
						<h3>Chuleta de Res</h3>
						<p class="product-price"><span>C/plato</span> 140$ </p>
						<a href="#" class="cart-btn" data-id="5"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/6-guisados.jpg" alt=""></a>
						</div>
						<h3>Platillo de 3 guisados</h3>
						<p class="product-price"><span>C/plato</span> 80$ </p>
						<a href="#" class="cart-btn" data-id="6"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/7-chilaquiles sencillos.jpg" alt=""></a>
						</div>
						<h3>Chilaquiles sencillos</h3>
						<p class="product-price"><span>C/plato</span> 60$ </p>
						<a href="#" class="cart-btn" data-id="7"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/8-chilaquiles.jpg" alt=""></a>
						</div>
						<h3>Chilaquiles Montados</h3>
						<p class="product-price"><span>C/plato</span> 80$ </p>
						<a href="#" class="cart-btn" data-id="8"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/9-alambre.jpg" alt=""></a>
						</div>
						<h3>Alambre de Pollo o Res</h3>
						<p class="product-price"><span>C/plato</span> 100$ </p>
						<a href="#" class="cart-btn" data-id="9"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="burritos" class="product-section mt-150 mb-150">
		<div class="container">
			<div class="mt-80 mb-80 color-seccion">
				<h1 class="shoph1">Burritos</h1>
			</div>
			<div class="row product-lists">
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/10-wini.jpg" alt=""></a>
						</div>
						<h3>Wini</h3>
						<p class="product-price"><span>C/U</span> 25$ </p>
						<a href="#" class="cart-btn" data-id="10"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center berry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/11-frijoles.jpg" alt=""></a>
						</div>
						<h3>Frijoles/Queso</h3>
						<p class="product-price"><span>C/U</span> 25$ </p>
						<a href="#" class="cart-btn" data-id="11"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center lemon">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/12-huevo.jpg" alt=""></a>
						</div>
						<h3>Huevo</h3>
						<p class="product-price"><span>C/U</span> 25$ </p>
						<a href="#" class="cart-btn" data-id="12"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/13-papas.jpg" alt=""></a>
						</div>
						<h3>Papas con Queso</h3>
						<p class="product-price"><span>C/U</span> 25$ </p>
						<a href="#" class="cart-btn" data-id="13"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/14-picadillo.jpg" alt=""></a>
						</div>
						<h3>Picadillo</h3>
						<p class="product-price"><span>C/U</span> 30$ </p>
						<a href="#" class="cart-btn" data-id="14"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/15-asado.jpg" alt=""></a>
						</div>
						<h3>Asado</h3>
						<p class="product-price"><span>C/U</span> 30$ </p>
						<a href="#" class="cart-btn" data-id="15"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/16-discada.jpg" alt=""></a>
						</div>
						<h3>Discada</h3>
						<p class="product-price"><span>C/U</span> 30$ </p>
						<a href="#" class="cart-btn" data-id="16"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/17-chicharron.jpg" alt=""></a>
						</div>
						<h3>Chicharron</h3>
						<p class="product-price"><span>C/U</span> 30$ </p>
						<a href="#" class="cart-btn" data-id="17"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/18-arriero.jpg" alt=""></a>
						</div>
						<h3>Arriero</h3>
						<p class="product-price"><span>C/U</span> 30$ </p>
						<a href="#" class="cart-btn" data-id="18"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/19-milanesa.jpg" alt=""></a>
						</div>
						<h3>Milanesa con Aguacate</h3>
						<p class="product-price"><span>C/U</span> 50$ </p>
						<a href="#" class="cart-btn" data-id="19"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="quesadillas" class="product-section mt-150 mb-150">
		<div class="container">
			<div class="mt-80 mb-80 color-seccion">
				<h1 class="shoph1">Quesadillas Montadas</h1>
			</div>
			<div class="row product-lists">
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/20-quesadilla.jpg" alt=""></a>
						</div>
						<h3>Pastor o Bistec</h3>
						<p class="product-price"><span>C/U</span> 60$ </p>
						<a href="#" class="cart-btn" data-id="20"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center berry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/21-quesadilla.jpg" alt=""></a>
						</div>
						<h3>Guisado</h3>
						<p class="product-price"><span>C/U</span> 50$ </p>
						<a href="#" class="cart-btn" data-id="21"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center lemon">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/22-quesadilla.jpg" alt=""></a>
						</div>
						<h3>Sincronizada</h3>
						<p class="product-price"><span>C/U</span> 40$ </p>
						<a href="#" class="cart-btn" data-id="22"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="Sandwich" class="product-section mt-150 mb-150">
		<div class="container">
			<div class="mt-80 mb-80 color-seccion">
				<h1 class="shoph1">Sandwiches</h1>
			</div>
			<div class="row product-lists">
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/23-sandwich.jpg" alt=""></a>
						</div>
						<h3>Frío (jamón, queso, lechuga, tomate)</h3>
						<p class="product-price"><span>C/U</span> 30$</p>
						<a href="#" class="cart-btn" data-id="23"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center berry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/24-sandwich.jpg" alt=""></a>
						</div>
						<h3>Básico (huevo torta, jamón y queso)</h3>
						<p class="product-price"><span>C/U</span> 50$</p>
						<a href="#" class="cart-btn" data-id="24"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center lemon">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/25-sandwich.jpg" alt=""></a>
						</div>
						<h3>Mosquetero (huevo estrellado, jamón, queso y tocino)</h3>
						<p class="product-price"><span>C/U</span> 60$</p>
						<a href="#" class="cart-btn" data-id="25"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center lemon">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/26-sandwich.jpg" alt=""></a>
						</div>
						<h3>Club (pechuga, jamón, queso, tocino y papas fritas)</h3>
						<p class="product-price"><span>C/U</span> 90$</p>
						<a href="#" class="cart-btn" data-id="26"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="hamburguesa" class="product-section mt-150 mb-150">
		<div class="container">
			<div class="mt-80 mb-80 color-seccion">
				<h1 class="shoph1">Hamburguesas</h1>
			</div>
			<div class="row product-lists">
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/27-hambur.jpg" alt=""></a>
						</div>
						<h3>Sencilla</h3>
						<p class="product-price"><span>C/U</span> 60$</p>
						<a href="#" class="cart-btn" data-id="27"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center berry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/28-hambur.jpg" alt=""></a>
						</div>
						<h3>Especial</h3>
						<p class="product-price"><span>C/U</span> 75$</p>
						<a href="#" class="cart-btn" data-id="28"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center lemon">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/29-hambur.jpg" alt=""></a>
						</div>
						<h3>Doble</h3>
						<p class="product-price"><span>C/U</span> 100$</p>
						<a href="#" class="cart-btn" data-id="29"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center lemon">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/30-hambur.jpg" alt=""></a>
						</div>
						<h3>Boneless</h3>
						<p class="product-price"><span>C/U</span> 85$</p>
						<a href="#" class="cart-btn" data-id="30"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center lemon">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/31-papas.jpg" alt=""></a>
						</div>
						<h3>Papas fritas</h3>
						<p class="product-price"><span>Al comprar una hamburguesa</span> 25$</p>
						<a href="#" class="cart-btn" data-id="31"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="Nachos" class="product-section mt-150 mb-150">
		<div class="container">
			<div class="mt-80 mb-80 color-seccion">
				<h1 class="shoph1">Nachos</h1>
			</div>
			<div class="row product-lists">
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/32-nachos.jpg" alt=""></a>
						</div>
						<h3>Sencillos</h3>
						<p class="product-price"><span>Chicos-grandes</span> 40-60$</p>
						<a href="#" class="cart-btn" data-id="32"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center berry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/33-nachos.jpg" alt=""></a>
						</div>
						<h3>Con Pastor</h3>
						<p class="product-price"><span>Chicos-grandes</span> 60-80$</p>
						<a href="#" class="cart-btn" data-id="33"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center lemon">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/34-nachos.jpg" alt=""></a>
						</div>
						<h3>Con Bistec</h3>
						<p class="product-price"><span>Chicos-grandes</span> 70-90$</p>
						<a href="#" class="cart-btn" data-id="34"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center lemon">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/35-nachos.jpg" alt=""></a>
						</div>
						<h3>Con Pollo</h3>
						<p class="product-price"><span>Chicos-grandes</span> 65-85$</p>
						<a href="#" class="cart-btn" data-id="35"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="otros" class="product-section mt-150 mb-150">
		<div class="container">
			<div class="mt-80 mb-80 color-seccion">
				<h1 class="shoph1">Otros</h1>
			</div>
			<div class="row product-lists">
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/36-papas.jpg" alt=""></a>
						</div>
						<h3>Papas Fritas</h3>
						<p class="product-price"><span>C/U</span> 35$</p>
						<a href="#" class="cart-btn" data-id="36"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center berry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/37-hotdog.jpg" alt=""></a>
						</div>
						<h3>Hot Dog</h3>
						<p class="product-price"><span>C/U</span> 25$</p>
						<a href="#" class="cart-btn" data-id="37"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center lemon">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/38-banderilla.jpg" alt=""></a>
						</div>
						<h3>Banderilla</h3>
						<p class="product-price"><span>C/U</span> 30$</p>
						<a href="#" class="cart-btn" data-id="38"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center lemon">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/39-papas.jpg" alt=""></a>
						</div>
						<h3>Sabritas Preparadas</h3>
						<p class="product-price"><span>C/U</span> 55$</p>
						<a href="#" class="cart-btn" data-id="39"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center lemon">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/40-papas.jpg" alt=""></a>
						</div>
						<h3>Sabritas con Queso</h3>
						<p class="product-price"><span>C/U</span> 35$</p>
						<a href="#" class="cart-btn" data-id="40"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center lemon">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/41-papas.jpg" alt=""></a>
						</div>
						<h3>Papas Locas</h3>
						<p class="product-price"><span>C/U</span> 30$</p>
						<a href="#" class="cart-btn" data-id="41"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center lemon">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/42-fresas.jpg" alt=""></a>
						</div>
						<h3>Fresas con Crema</h3>
						<p class="product-price"><span>C/U</span> 55$</p>
						<a href="#" class="cart-btn" data-id="42"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center lemon">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/43-queso.jpg" alt=""></a>
						</div>
						<h3>Porción de Queso Amarillo</h3>
						<p class="product-price"><span>C/U</span> 15$</p>
						<a href="#" class="cart-btn" data-id="43"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center lemon">
					<div class="single-product-item">
						<div class="product-image">
							<a href="#"><img src="assets/img/products/44-guisado.jpg" alt=""></a>
						</div>
						<h3>Porción de Guisado</h3>
						<p class="product-price"><span>C/U</span> 20$</p>
						<a href="#" class="cart-btn" data-id="44"><i class="fas fa-shopping-cart"></i> Agregar al carrito</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end products -->	

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