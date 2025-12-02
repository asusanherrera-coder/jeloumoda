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
    
    {{-- Asegúrate que estas rutas sean correctas en tu proyecto --}}
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
                <li><a href="{{ route('blog') }}">BLOG</a></li>
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

            {{-- LOGICA DE USUARIO SIMPLIFICADA (BLADE NATIVO) --}}
            
            {{-- CASO 1: CLIENTE LOGUEADO (Auth) --}}
            @auth
                <div class="user-menu-wrapper">
                    <button id="usuario-toggle" class="user-toggle-btn">
                        <i class="fas fa-user"></i> {{ Auth::user()->nombre }}
                    </button>

                    <div id="user-dropdown" class="user-dropdown-menu" style="display: none;"> 
                        <div class="dropdown-item-text"><a href="{{ route('perfil.index') }}" class="dropdown-item">
                            <i class="fa-solid fa-user-circle"></i> Mi Perfil</a>
                        </div>
                        
                        {{-- Botón Cerrar Sesión --}}
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="logout-btn dropdown-item" style="width: 100%; text-align: left; background: none; border: none; padding: 10px 15px; cursor: pointer;">
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>

            {{-- CASO 2: VERIFICAR SI ES EMPLEADO (Session) --}}
            @else
                @if(session('tipo_usuario') === 'empleado')
                    <div class="user-menu-wrapper">
                        <button id="usuario-toggle" class="user-toggle-btn">
                            <i class="fas fa-user"></i> {{ session('nombre') }}
                        </button>
    
                        <div id="user-dropdown" class="user-dropdown-menu" style="display: none;"> 
                            <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                            
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="logout-btn dropdown-item" style="width: 100%; text-align: left; background: none; border: none; padding: 10px 15px; cursor: pointer;">
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>

                {{-- CASO 3: INVITADO (Muestra Login) --}}
                @else
                    <a href="{{ route('login') }}" class="login-link" aria-label="Iniciar sesión">
                        <i class="fas fa-user"></i> Iniciar Sesión
                    </a>
                @endif
            @endauth

        </div>
    </div>
</header>

<main>
    @yield('content')
</main>

{{-- Footer --}}
<footer>
    <div class="footer-container">
        {{-- ... Tu contenido del footer se mantiene igual ... --}}
        <div class="footer-brand-info">
             <p>&copy; 2025 Jelou Moda</p>
        </div>
    </div>
</footer>

{{-- Scripts --}}
<script src="{{ asset('JS/carrito.js') }}"></script>

<script>
    // Script para manejar el menú desplegable del usuario
    document.addEventListener("DOMContentLoaded", function () {
        const iconoUsuario = document.getElementById("usuario-toggle");
        const dropdown = document.getElementById("user-dropdown");

        if (iconoUsuario && dropdown) {
            iconoUsuario.addEventListener("click", function (e) {
                e.preventDefault(); // Evitar saltos
                e.stopPropagation();
                dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
            });

            // Cerrar al hacer clic fuera
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