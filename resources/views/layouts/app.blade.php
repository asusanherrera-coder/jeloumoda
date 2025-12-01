<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jelou Moda')</title>

    <script src="https://kit.fontawesome.com/f368768ce7.js" crossorigin="anonymous"></script>

    {{-- CSS globales --}}
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('CSS/header.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/style.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/chatbot.css') }}">

    @stack('styles')
   
</head>
<body>
<header class="main-header">
    <div class="header-content">
        
        {{-- 1. LOGO --}}
        <div class="logo">
            <a href="{{ route('home') }}" aria-label="Ir a la página de inicio de Jelou Moda">
                <img src="{{ asset('IMG/Logo.png') }}" alt="Jelou Moda Logo">
            </a>
        </div>
        
        <nav aria-label="Navegación principal">
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">INICIO</a></li>
                <li><a href="{{ route('catalogo.index') }}">CATÁLOGO</a></li>
                <li><a href="{{ route('nosotros') }}">NOSOTROS</a></li>
                <li><a href="{{ route('blog') }}">BLOG DE MODA Y ESTILO</a></li>
                <li><a href="{{ route('contacto.create') }}">CONTACTO</a></li>
            </ul>
        </nav>
        
        {{-- 2. ACCIONES (Carrito y Usuario) --}}
        <div class="header-actions">

            {{-- Carrito --}}
            @php
                $cartCount = collect(session('cart', []))->sum('cantidad');
            @endphp
            <a href="{{ route('carrito.index') }}" class="cart-link" aria-label="Ver carrito de compras">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="cart-count">{{ $cartCount }}</span>
            </a>

            {{-- LOGICA DE USUARIO: Comprobamos si es Cliente (Auth) o Empleado (Session) --}}
            @php
                $isLoggedIn = Auth::check() || session('tipo_usuario') === 'empleado';
                $userName = Auth::check() ? Auth::user()->nombre : session('nombre');
            @endphp

            @if ($isLoggedIn)
                {{-- Usuario Logueado --}}
                <div class="user-menu-wrapper">
                    <button id="usuario-toggle" class="user-toggle-btn">
                        <i class="fas fa-user"></i> {{ $userName }}
                    </button>

                    <div id="user-dropdown" class="user-dropdown-menu"> 
                        
                        {{-- Opciones para Empleado --}}
                        @if (session('tipo_usuario') === 'empleado')
                            <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                        @endif

                        {{-- Opciones para Cliente (Solo si es Auth) --}}
                        @auth
                            {{-- Aquí pondremos 'Mis Compras' en el futuro --}}
                            <span class="dropdown-item-text">Hola, Cliente</span>
                        @endauth
                        
                        {{-- Cerrar Sesión --}}
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="logout-btn dropdown-item">Cerrar sesión</button>
                        </form>
                    </div>
                </div>
            @else
                {{-- Usuario Invitado --}}
                <a href="{{ route('login') }}" class="login-link" aria-label="Mi cuenta o iniciar sesión">
                    <i class="fas fa-user"></i> Iniciar Sesión
                </a>
            @endif
        </div>
    </div>
</header>

<main>
    @yield('content')
</main>

<footer>
    <div class="footer-container">
        <div class="footer-brand-info">
            <a href="{{ route('home') }}" aria-label="Ir a la página de inicio de Jelou Moda">
                <img src="{{ asset('IMG/Logo.png') }}" alt="Logo de Jelou Moda" class="footer-logo">
            </a>
            <p class="brand-slogan">Descubre tu estilo único con Jelou Moda.</p>
            <div class="social-media">
                <h4>Síguenos</h4>
                <ul>
                    <li>
                        <a href="https://www.facebook.com/p/Jelou-Moda--100072189085624/"
                           aria-label="Síguenos en Facebook" target="_blank" rel="noopener noreferrer">
                            <i class="fa-brands fa-square-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.tiktok.com/discover/jelou-moda" aria-label="Síguenos en TikTok"
                           target="_blank" rel="noopener noreferrer">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <nav class="footer-nav">
            <div class="footer-column">
                <h4>NOSOTROS</h4>
                <ul>
                    <li><a href="{{ route('nosotros') }}">Quiénes somos</a></li>
                    <li><a href="{{ route('blog') }}">Nuestro Blog</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>ATENCIÓN AL CLIENTE</h4>
                <ul>
                    <li><a href="{{ route('metodos.envio') }}">Métodos de envío</a></li>
                    <li><a href="#">Cambios y devoluciones</a></li>
                    <li><a href="{{ route('terminos') }}">Términos y condiciones</a></li>
                    <li><a href="{{ route('reclamos.create') }}">Libro de reclamaciones</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>CONTACTO</h4>
                <address>
                    <ul>
                        <li>
                            <a href="https://api.whatsapp.com/send?phone=51936033151&text=Hola%20Bella%20%F0%9F%92%9C%E2%9C%A8"
                               aria-label="Llámanos al +51 936033151">
                                <i class="fa-brands fa-whatsapp"></i> +51 936033151
                            </a>
                        </li>
                    </ul>
                </address>
            </div>
        </nav>

        <div class="footer-newsletter">
            <h4>SUSCRÍBETE A NUESTRAS NOVEDADES</h4>
            <p>Sé el primero en enterarte de promociones exclusivas.</p>
            <form action="#" method="POST">
                <label for="newsletter-email" class="sr-only">Correo electrónico</label>
                <input type="email" id="newsletter-email" name="email"
                       placeholder="Ingresa tu correo electrónico"
                       required>
                <a href="#">Suscribirme</a>
            </form>
            <p class="privacy-note">
                Al suscribirte, aceptas nuestra
                <a href="{{ route('politica.privacidad') }}">Política de Privacidad</a>.
            </p>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="payment-methods">
            <h4>Métodos de pago</h4>
            <img src="{{ asset('IMG/visa.png') }}" alt="Visa" style="width: 40px; height: auto;">
            <img src="{{ asset('IMG/mastercard.png') }}" alt="Mastercard" style="width: 40px; height: auto;">
            <img src="{{ asset('IMG/yape.jpg') }}" alt="Yape" style="width: 40px; height: auto;">
            <img src="{{ asset('IMG/plin.png') }}" alt="Plin" style="width: 40px; height: auto;">
        </div>
        <p>&copy; 2025 – Todos los derechos reservados – Diseñado por Equipo 04</p>
    </div>
</footer>

<script src="{{ asset('JS/chatbot.js') }}"></script>
<script src="{{ asset('JS/carrito.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const iconoUsuario = document.getElementById("usuario-toggle");
        const dropdown = document.getElementById("user-dropdown");

        if (iconoUsuario && dropdown) {
            iconoUsuario.addEventListener("click", function (e) {
                e.stopPropagation();
                dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
            });

            document.addEventListener("click", function (e) {
                if (!dropdown.contains(e.target) && e.target !== iconoUsuario) {
                    dropdown.style.display = "none";
                }
            });
        }
    });
</script>

@stack('scripts')
</body>
</html>