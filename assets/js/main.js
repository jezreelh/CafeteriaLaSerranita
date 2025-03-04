(function ($) {
    "use strict";

    $(document).ready(function($){
        
        // testimonial sliders
        $(".testimonial-sliders").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                600:{
                    items:1,
                    nav:false
                },
                1000:{
                    items:1,
                    nav:false,
                    loop:true
                }
            }
        });

        // homepage slider
        $(".homepage-slider").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            nav: true,
            dots: false,
            navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
            responsive:{
                0:{
                    items:1,
                    nav:false,
                    loop:true
                },
                600:{
                    items:1,
                    nav:true,
                    loop:true
                },
                1000:{
                    items:1,
                    nav:true,
                    loop:true
                }
            }
        });

        // logo carousel
        $(".logo-carousel-inner").owlCarousel({
            items: 4,
            loop: true,
            autoplay: true,
            margin: 30,
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:4,
                    nav:false,
                    loop:true
                }
            }
        });

        // count down
        if($('.time-countdown').length){  
            $('.time-countdown').each(function() {
            var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                var $this = $(this).html(event.strftime('' + '<div class="counter-column"><div class="inner"><span class="count">%D</span>Days</div></div> ' + '<div class="counter-column"><div class="inner"><span class="count">%H</span>Hours</div></div>  ' + '<div class="counter-column"><div class="inner"><span class="count">%M</span>Mins</div></div>  ' + '<div class="counter-column"><div class="inner"><span class="count">%S</span>Secs</div></div>'));
            });
         });
        }

        // projects filters isotop
        $(".product-filters li").on('click', function () {
            
            $(".product-filters li").removeClass("active");
            $(this).addClass("active");

            var selector = $(this).attr('data-filter');

            $(".product-lists").isotope({
                filter: selector,
            });
            
        });
        
        // isotop inner
        $(".product-lists").isotope();

        // magnific popup
        $('.popup-youtube').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });

        // light box
        $('.image-popup-vertical-fit').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            mainClass: 'mfp-img-mobile',
            image: {
                verticalFit: true
            }
        });

        // homepage slides animations
        $(".homepage-slider").on("translate.owl.carousel", function(){
            $(".hero-text-tablecell .subtitle").removeClass("animated fadeInUp").css({'opacity': '0'});
            $(".hero-text-tablecell h1").removeClass("animated fadeInUp").css({'opacity': '0', 'animation-delay' : '0.3s'});
            $(".hero-btns").removeClass("animated fadeInUp").css({'opacity': '0', 'animation-delay' : '0.5s'});
        });

        $(".homepage-slider").on("translated.owl.carousel", function(){
            $(".hero-text-tablecell .subtitle").addClass("animated fadeInUp").css({'opacity': '0'});
            $(".hero-text-tablecell h1").addClass("animated fadeInUp").css({'opacity': '0', 'animation-delay' : '0.3s'});
            $(".hero-btns").addClass("animated fadeInUp").css({'opacity': '0', 'animation-delay' : '0.5s'});
        });

       

        // stikcy js
        $("#sticker").sticky({
            topSpacing: 0
        });

        //mean menu
        $('.main-menu').meanmenu({
            meanMenuContainer: '.mobile-menu',
            meanScreenWidth: "992"
        });
        
         // search form
        $(".search-bar-icon").on("click", function(){
            $(".search-area").addClass("search-active");
        });

        $(".close-btn").on("click", function() {
            $(".search-area").removeClass("search-active");
        });
        // Cambiar entre login y registro
        $(".search-area").on("click", ".switch-form", function(event) {
            event.preventDefault();
            $(".search-area .form-container").toggleClass("rotate");
        });
        
    
    });


    jQuery(window).on("load", function() {
        jQuery(".loader").fadeOut(1000);
    });
    
    document.addEventListener('DOMContentLoaded', () => {
        // Registro
        const registerForm = document.querySelector('.register-form');
        const registerEmailError = document.getElementById('register-email-error');
        const registerPasswordError = document.getElementById('register-password-error');
        const registerConfirmPasswordError = document.getElementById('register-confirm-password-error');

        if (registerForm) {
            registerForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Evita que el formulario se envíe automáticamente

                // Limpia mensajes de error previos
                registerEmailError.textContent = '';
                registerPasswordError.textContent = '';
                registerConfirmPasswordError.textContent = '';

                // Oculta mensajes de error
                registerEmailError.style.display = 'none';
                registerPasswordError.style.display = 'none';
                registerConfirmPasswordError.style.display = 'none';

                const email = this.email.value.trim();
                const password = this.password.value.trim();
                const confirmPassword = this.confirm_password.value.trim();
                const emailPattern = /^[a-zA-Z0-9._%+-]+@utpn\.edu\.mx$/; // Patrón para verificar el dominio

                // Validación del correo electrónico
                if (!emailPattern.test(email)) {
                    registerEmailError.textContent = 'El correo debe ser del dominio @utpn.edu.mx';
                    registerEmailError.style.display = 'block';
                    return; // Detiene el proceso de validación para que el usuario corrija este error primero
                }

                // Validación de la longitud de la contraseña
                if (password.length < 8) {
                    registerPasswordError.textContent = 'La contraseña debe tener al menos 8 caracteres.';
                    registerPasswordError.style.display = 'block';
                    return; // Detiene el proceso de validación para que el usuario corrija este error primero
                }

                // Validación de un carácter especial en la contraseña
                const specialCharacterPattern = /[^a-zA-Z\d]/;
                if (!specialCharacterPattern.test(password)) {
                    registerPasswordError.textContent = 'La contraseña debe contener al menos un carácter especial.';
                    registerPasswordError.style.display = 'block';
                    return; // Detiene el proceso de validación para que el usuario corrija este error primero
                }

                // Verificación de coincidencia de contraseñas
                if (password !== confirmPassword) {
                    registerConfirmPasswordError.textContent = 'Las contraseñas no coinciden.';
                    registerConfirmPasswordError.style.display = 'block';
                    return; // Detiene el proceso de validación para que el usuario corrija este error primero
                }

                // Guardar la URL actual antes de enviar el formulario
                sessionStorage.setItem('previousPage', window.location.href);

                // Si todas las validaciones pasan, se envía el formulario usando Fetch API
                fetch('register.php', {
                    method: 'POST',
                    body: new FormData(this)
                })
                .then(response => response.text())
                .then(text => {
                    if (text.startsWith("redirect:")) {
                        window.location.href = text.substring("redirect:".length);
                    } else if (text.startsWith("error:")) {
                        // Extraer el mensaje de error
                        const errorMessage = text.substring("error:".length);

                        // Mostrar el mensaje de error en el formulario
                        if (errorMessage.includes("Correo ya está registrado")) {
                            registerEmailError.textContent = errorMessage;
                            registerEmailError.style.display = 'block';
                        } else if (errorMessage.includes("Contraseñas no coinciden")) {
                            registerConfirmPasswordError.textContent = errorMessage;
                            registerConfirmPasswordError.style.display = 'block';
                        } else {
                            registerEmailError.textContent = errorMessage;
                            registerEmailError.style.display = 'block';
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        }

    
        // Inicio de sesión
        const loginForm = document.querySelector('.login-form');
        const loginEmailError = document.getElementById('login-email-error');
        const loginPasswordError = document.getElementById('login-password-error');

        if (loginForm) {
            loginForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Evita que el formulario se envíe automáticamente

                // Limpia mensajes de error previos
                loginEmailError.textContent = '';
                loginPasswordError.textContent = '';

                // Oculta mensajes de error
                loginEmailError.style.display = 'none';
                loginPasswordError.style.display = 'none';

                const email = this.email.value.trim();
                const password = this.password.value.trim();

                // Enviar el formulario usando Fetch API
                fetch('login.php', {
                    method: 'POST',
                    body: new FormData(this)
                })
                .then(response => response.text())
                .then(text => {
                    if (text.startsWith("redirect:")) {
                        // Limpiar el formulario
                        loginForm.reset();
                        
                        // Redirigir a la página especificada
                        window.location.href = text.substring("redirect:".length);
                    } else if (text.startsWith("error:")) {
                        // Extraer el mensaje de error
                        const errorMessage = text.substring("error:".length);

                        // Mostrar el mensaje de error en el formulario
                        if (errorMessage.includes("Correo electrónico inválido")) {
                            loginEmailError.textContent = errorMessage;
                            loginEmailError.style.display = 'block';
                        } else if (errorMessage.includes("Contraseña incorrecta")) {
                            loginPasswordError.textContent = errorMessage;
                            loginPasswordError.style.display = 'block';
                        } else {
                            loginEmailError.textContent = errorMessage;
                            loginEmailError.style.display = 'block';
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        }



    
        // Redirigir a la página guardada después de iniciar sesión
        const previousPage = sessionStorage.getItem('previousPage');
        if (previousPage) {
            window.location.href = previousPage;
            sessionStorage.removeItem('previousPage'); // Limpiar el valor después de la redirección
        }
    });
    
    document.addEventListener('DOMContentLoaded', () => {
        const addToCartButtons = document.querySelectorAll('.cart-btn');
    
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Evita el comportamiento por defecto del enlace
    
                // Obtén el ID del producto desde el atributo data-id
                const productId = this.getAttribute('data-id');
    
                // Verifica que productId no sea null o undefined
                if (productId) {
                    // Enviar una solicitud para agregar el producto al carrito
                    fetch('add_to_cart.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            'product_id': productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Aquí puedes mostrar un mensaje al usuario o actualizar el carrito visualmente
                        alert(data.message);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                } else {
                    console.error('Product ID is missing.');
                }
            });
        });
    });
    document.addEventListener('DOMContentLoaded', () => {
        const updateCartButton = document.querySelector('#update-cart-btn');
        
        if (updateCartButton) {
            updateCartButton.addEventListener('click', function(event) {
                event.preventDefault();
        
                // Obtén las cantidades de los productos del formulario
                const quantities = {};
                document.querySelectorAll('.product-quantity').forEach(input => {
                    const productId = input.getAttribute('data-id');
                    const quantity = input.value;
                    if (productId) {
                        quantities[productId] = quantity;
                    }
                });
        
                // Enviar una solicitud para actualizar el carrito
                fetch('update_to_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        'quantity': JSON.stringify(quantities)
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Aquí puedes mostrar un mensaje al usuario o actualizar el carrito visualmente
                    alert(data.message);
                    // Opcional: Recargar la página para mostrar los cambios
                    location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        const sendOrderBtn = document.getElementById('send-order-btn');
        const orderForm = document.getElementById('order-form'); // Asegúrate de que el formulario tenga el id "order-form"
    
        sendOrderBtn.addEventListener('click', function(event) {
            event.preventDefault(); // Evita que el enlace navegue a otra página
    
            // Verifica si el campo de instrucciones está vacío
            const instructionsField = orderForm.querySelector('input[name="instructions"]');
            if (!instructionsField.value.trim()) {
                alert('Por favor, agregue instrucciones de modo de preparación.');
                return;
            }
    
            // Verifica si el total excede 150 pesos
            const totalPrice = parseFloat(document.getElementById('total-price').textContent.replace('$', '').replace(',', '')); // Asume que tienes el total en un elemento con id 'total-price'
            if (totalPrice > 150) {
                alert('El total del pedido no puede exceder los 150 pesos.');
                return;
            }
    
            // Confirma el envío del pedido
            if (confirm('¿Estás seguro de que quieres enviar el pedido?')) {
                orderForm.submit(); // Envía el formulario
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');
        const carousel = document.querySelector('.carousel');
        const slides = document.querySelectorAll('.carousel-slide');
        let index = 0;
    
        function showSlide(index) {
            const offset = -index * 100;
            carousel.style.transform = `translateX(${offset}%)`;
        }
    
        prevBtn.addEventListener('click', function() {
            index = (index > 0) ? index - 1 : slides.length - 1;
            showSlide(index);
        });
    
        nextBtn.addEventListener('click', function() {
            index = (index < slides.length - 1) ? index + 1 : 0;
            showSlide(index);
        });
    
        // Mostrar el primer slide al cargar
        showSlide(index);
    });
    

    
    
    
}(jQuery));