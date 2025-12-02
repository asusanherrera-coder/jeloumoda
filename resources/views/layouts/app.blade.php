<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Token de seguridad para la IA --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Jelou Moda')</title>

    <script src="https://kit.fontawesome.com/f368768ce7.js" crossorigin="anonymous"></script>

    {{-- Bootstrap CSS --}}
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">
    
    {{-- Estilos Propios --}}
    <link rel="stylesheet" href="{{ asset('CSS/header.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/style.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/chatbot.css') }}">

    @stack('styles')

    <style>
        /* ESTILOS DE IMPRESIÓN */
        @media print {
            .main-header, footer, .no-print, #chatbotModal, .menu-toggle { display: none !important; }
            body { background: white; margin: 0; padding: 0; }
            .container { max-width: 100% !important; }
        }

        /* Utilidades */
        .hidden { display: none !important; }
        .flex { display: flex !important; }

        /* --- ESTILOS MENÚ HAMBURGUESA (MÓVIL) --- */
        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 5px;
        }
        .menu-toggle .bar {
            height: 3px;
            width: 25px;
            background-color: #333; /* Color de las barras */
            margin: 4px 0;
            transition: 0.3s;
            border-radius: 2px;
        }

        /* Responsive */
        @media screen and (max-width: 992px) {
            .header-content {
                flex-wrap: wrap;
            }
            .menu-toggle {
                display: flex;
                order: 1; /* Poner a la derecha o izquierda según diseño */
                margin-left: 20px;
            }
            .nav-links {
                display: none;
                flex-direction: column;
                width: 100%;
                background-color: white;
                position: absolute;
                top: 80px; /* Ajustar según altura del header */
                left: 0;
                padding: 20px;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                z-index: 1000;
                text-align: center;
            }
            .nav-links.active {
                display: flex;
            }
            .nav-links li {
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>

{{-- HEADER --}}
<header class="main-header">
    <div class="header-content">
        {{-- LOGO --}}
        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('IMG/Logo.png') }}" alt="Jelou Moda Logo">
            </a>
        </div>
        
        {{-- NAVEGACIÓN --}}
        <nav class="navbar">
            {{-- Botón Hamburguesa (Móvil) --}}
            <div class="menu-toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

            <ul class="nav-links">
                <li><a href="{{ route('home') }}">INICIO</a></li>
                <li><a href="{{ route('catalogo.index') }}">CATÁLOGO</a></li>
                <li><a href="{{ route('nosotros') }}">NOSOTROS</a></li>
                <li><a href="{{ route('blog') }}">BLOG</a></li>
                <li><a href="{{ route('contacto.create') }}">CONTACTO</a></li>
            </ul>
        </nav>
        
        {{-- ACCIONES --}}
        <div class="header-actions">
            @php $cartCount = collect(session('cart', []))->sum('cantidad'); @endphp
            <a href="{{ route('carrito.index') }}" class="cart-link" title="Carrito">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="cart-count">{{ $cartCount }}</span>
            </a>

            @auth
                {{-- USUARIO LOGUEADO --}}
                <div class="user-menu-wrapper">
                    <button id="usuario-toggle" class="user-toggle-btn">
                        <i class="fas fa-user"></i> {{ Auth::user()->nombre }}
                    </button>
                    <div id="user-dropdown" class="user-dropdown-menu" style="display: none;"> 
                        <a href="{{ route('perfil.index') }}" class="dropdown-item">Mi Perfil</a>
                        
                        <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                            @csrf
                            <button type="submit" class="logout-btn dropdown-item">Cerrar sesión</button>
                        </form>
                    </div>
                </div>
            @else
                @if(session('tipo_usuario') === 'empleado')
                    {{-- EMPLEADO --}}
                    <div class="user-menu-wrapper">
                        <button id="usuario-toggle" class="user-toggle-btn">
                            <i class="fas fa-user-tie"></i> {{ session('nombre') }}
                        </button>
                        <div id="user-dropdown" class="user-dropdown-menu" style="display: none;"> 
                            <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" class="logout-btn dropdown-item">Cerrar sesión</button>
                            </form>
                        </div>
                    </div>
                @else
                    {{-- INVITADO --}}
                    <a href="{{ route('login') }}" class="login-link"><i class="fas fa-user"></i> Iniciar Sesión</a>
                @endif
            @endauth
        </div>
    </div>
</header>

<main style="min-height: 60vh;">
    @yield('content')
</main>

{{-- FOOTER ORIGINAL RESTAURADO --}}
<footer>
    <div class="footer-container">
        <div class="footer-brand-info">
            <a href="{{ route('home') }}">
                <img src="{{ asset('IMG/Logo.png') }}" alt="Logo de Jelou Moda" class="footer-logo">
            </a>
            <p class="brand-slogan">Descubre tu estilo único con Jelou Moda.</p>
            <div class="social-media">
                <h4>Síguenos</h4>
                <ul>
                    <li><a href="https://www.facebook.com/p/Jelou-Moda--100072189085624/" target="_blank"><i class="fa-brands fa-square-facebook"></i></a></li>
                    <li><a href="https://www.tiktok.com/discover/jelou-moda" target="_blank"><i class="fa-brands fa-tiktok"></i></a></li>
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
                    <li><a href="{{ route('terminos') }}">Términos y condiciones</a></li>
                    <li><a href="{{ route('reclamos.create') }}">Libro de reclamaciones</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>CONTACTO</h4>
                <address>
                    <ul>
                        <li><a href="https://api.whatsapp.com/send?phone=51936033151"><i class="fa-brands fa-whatsapp"></i> +51 936033151</a></li>
                        <li>contacto@jeloumoda.com</li>
                    </ul>
                </address>
            </div>
        </nav>

        <div class="footer-newsletter">
            <h4>SUSCRÍBETE A NUESTRAS NOVEDADES</h4>
            <form action="#" method="POST">
                <label for="newsletter-email" class="sr-only">Correo electrónico</label>
                <input type="email" id="newsletter-email" name="email" placeholder="Ingresa tu correo electrónico" required>
                <a href="#">Suscribirme</a>
            </form>
            <p class="privacy-note">Al suscribirte, aceptas nuestra <a href="{{ route('politica.privacidad') }}">Política de Privacidad</a>.</p>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="payment-methods">
            <h4>Métodos de pago</h4>
            <img src="{{ asset('IMG/yape.jpg') }}" alt="Yape" style="width: 40px; height: auto;">
            <img src="{{ asset('IMG/plin.png') }}" alt="Plin" style="width: 40px; height: auto;">
        </div>
        <p>&copy; 2025 – Todos los derechos reservados – Diseñado por Xiomara Basurto - Aracely Herrera - Susan Herrera</p>
    </div>
</footer>

{{-- MODAL DEL CHATBOT (Sin botón flotante, se activa desde el menú) --}}
<div id="chatbotModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 overflow-hidden flex flex-col" style="background: white; width: 350px; max-width: 90%; height: 500px; max-height: 90vh; position: absolute; bottom: 80px; right: 20px; border-radius: 15px; display: flex; flex-direction: column; box-shadow: 0 5px 25px rgba(0,0,0,0.2);">
        
        {{-- Cabecera --}}
        <div class="bg-pink-600 p-4 flex justify-between items-center" style="background: #b0256e; color: white; padding: 15px; display: flex; justify-content: space-between;">
            <div class="flex items-center gap-2">
                <span class="font-bold text-lg">Modist - Tu Asesor 👗✨</span>
            </div>
            <button id="closeChatbotBtn" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer;">&times;</button>
        </div>

        {{-- Chat --}}
        <div id="chatbox" class="flex-1 p-4 overflow-y-auto bg-gray-50 space-y-4" style="flex: 1; padding: 15px; overflow-y: auto; background: #f9fafb;"></div>

        {{-- Loading --}}
        <div id="loadingIndicator" class="hidden p-2 text-center text-gray-500 text-sm" style="display: none; text-align: center; color: #666; padding: 5px;">Modist está pensando...</div>

        {{-- Input --}}
        <div class="p-4 border-t bg-white flex gap-2" style="padding: 10px; border-top: 1px solid #eee; display: flex; gap: 5px;">
            <input type="text" id="chatinput" placeholder="Pregunta sobre ropa..." style="flex: 1; border: 1px solid #ddd; border-radius: 20px; padding: 8px 15px;">
            <button id="sendButton" style="background: #b0256e; color: white; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; display: flex; justify-content: center; align-items: center;">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<script src="{{ asset('JS/carrito.js') }}"></script>
{{-- Script del Chatbot --}}
<script src="{{ asset('JS/chatbot.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // 1️⃣ MENÚ HAMBURGUESA (MÓVIL)
    const menuToggle = document.getElementById("mobile-menu");
    const navLinks = document.querySelector(".nav-links");

    if(menuToggle && navLinks){
        menuToggle.addEventListener("click", (e) => {
            e.stopPropagation();
            navLinks.classList.toggle("active");
        });
        document.addEventListener("click", (e) => {
            if(!navLinks.contains(e.target) && e.target !== menuToggle){
                navLinks.classList.remove("active");
            }
        });
    }

    // 2️⃣ MENÚ USUARIO DESPLEGABLE
    const userToggle = document.getElementById("usuario-toggle");
    const userDropdown = document.getElementById("user-dropdown");

    if(userToggle && userDropdown){
        userToggle.addEventListener("click", (e) => {
            e.stopPropagation();
            userDropdown.style.display = userDropdown.style.display === "block" ? "none" : "block";
        });
        document.addEventListener("click", (e) => {
            if(!userDropdown.contains(e.target) && e.target !== userToggle){
                userDropdown.style.display = "none";
            }
        });
    }

    // 3️⃣ ABRIR CHATBOT DESDE ENLACES (Ya no botón flotante)
    // Buscamos todos los botones que deban abrir el chat (menú usuario, menú móvil, etc)
    const openChatIds = ['openChatbotBtn', 'openChatbotBtnGuest', 'mobileChatBtn'];
    
    openChatIds.forEach(id => {
        const btn = document.getElementById(id);
        if(btn) {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                // Llamamos a la función global que define chatbot.js (si ya cargó)
                // O simulamos click en el modal si no está expuesta
                const modal = document.getElementById('chatbotModal');
                const input = document.getElementById('chatinput');
                if(modal) {
                    modal.classList.remove("hidden");
                    modal.classList.add("flex");
                    if(input) input.focus();
                }
            });
        }
    });
});
</script>

@stack('scripts')
</body>
</html>