@extends('layouts.app')

@section('title', 'Index - Jelou Moda')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/index.css') }}">
@endpush

@section('content')
    <section id="hero-video">
        <!-- La imagen de fondo -->
        <img src="{{ asset('IMG/fondoprincipal.jpg') }}"
             alt="Modelo de Jelou Moda con ropa urbana"
             class="hero-background-image">

        <!-- La capa de texto con el fondo transparente que cubrirá toda la sección -->
        <div class="hero-overlay-text">
            <h2>Descubre tu estilo único en Jelou Moda</h2>
            <p>Moda urbana que te define. Encuentra la prenda perfecta para cada ocasión.</p>
            <a href="{{ route('catalogo.index') }}" class="button-primary">EXPLORAR COLECCIÓN</a>
        </div>
    </section>

    <section id="features">
        <h2>Por qué elegir JELOU MODA</h2>
        <div class="features-grid">
            <article class="feature-item">
                <div class="feature-icon-wrapper">
                    <i class="fas fa-shipping-fast" aria-hidden="true"></i>
                </div>
                <h3>Entrega rápida y segura</h3>
                <p>Llevamos la moda a la puerta de tu casa, en cualquier lugar del Perú. Envíos garantizados.</p>
            </article>
            <article class="feature-item">
                <div class="feature-icon-wrapper">
                    <i class="fas fa-tshirt" aria-hidden="true"></i>
                </div>
                <h3>Estilo que habla por ti</h3>
                <p>Cada prenda de JELOU MODA está pensada para destacar tu personalidad. Colores neutros, cortes
                    modernos y calidad asegurada.</p>
            </article>
            <article class="feature-item">
                <div class="feature-icon-wrapper">
                    <i class="fas fa-heart" aria-hidden="true"></i>
                </div>
                <h3>Pensado para tu día a día</h3>
                <p>Diseños que se adaptan a ti: para el trabajo, para salir, para todo momento.</p>
            </article>
        </div>
    </section>

    <section id="about-us-intro">
        <h2>Bienvenida a JELOU MODA: Tu Estilo, Tu Esencia</h2>
        <div class="about-us-content">
            <div class="about-us-text">
                <h3>Moda urbana que te define</h3>
                <p>Explora prendas pensadas para destacar tu estilo único. Ropa moderna, cómoda y con personalidad.
                    Ideal para tu día a día.</p>
                <h3>Diseñado para ti, pensando en ti</h3>
                <p>En JELOU MODA creemos que la moda debe adaptarse a ti, no al revés. Nuestro compromiso es
                    ofrecerte prendas que no solo te hagan lucir bien, sino que te hagan sentir auténtica y
                    empoderada.</p>
                <div class="about-us-buttons">
                    <a href="{{ route('catalogo.index') }}" class="button-secondary">EXPLORAR PRODUCTOS</a>
                    <a href="{{ route('blog') }}" class="button-secondary">VER NOVEDADES</a>
                </div>
            </div>
            <div class="about-us-image">
                <img src="{{ asset('IMG/modelo.jpg') }}"
                     alt="Modelo con conjunto urbano y moderno de Jelou Moda">
            </div>
        </div>
    </section>

    <section id="testimonials">
        <h2>Lo que dicen nuestros clientes</h2>
        <div class="testimonials-grid">
            <article class="testimonial-item">
                <p>“Pedí por Facebook y el mismo día ya estaban enviando. ¡Recomendado!”</p>
                <div class="client-info">
                    <img src="{{ asset('IMG/Andres.jpeg') }}" alt="Foto de Andrés R.">
                    <p><strong>Andrés R.</strong><br>Comprador de Arequipa</p>
                </div>
            </article>
            <article class="testimonial-item">
                <p>“¡La calidad es buenaza y la ropa llega súper rápido!”</p>
                <div class="client-info">
                    <img src="{{ asset('IMG/Valeria.jpeg') }}" alt="Foto de Valeria T.">
                    <p><strong>Valeria T.</strong><br>Cliente frecuente de Lima</p>
                </div>
            </article>
            <article class="testimonial-item">
                <p>“Super Confiable .... me llegó mi pedido como lo quería ...”</p>
                <div class="client-info">
                    <img src="{{ asset('IMG/Adriana.jpeg') }}" alt="Foto de Adriana Sc">
                    <p><strong>Adriana Sc</strong><br>Fan de la moda urbana</p>
                </div>
            </article>
        </div>
    </section>

    <!-- Botón flotante para abrir el chatbot -->
    <div id="floatingChatbotBtn" class="floating-btn">
        <img src="{{ asset('IMG/Modist_Icon.png') }}" alt="Modist Chat" class="profile-pic-large">
    </div>

    <!-- Modal del Chatbot Modist -->
    <div id="chatbotModal" class="chatbot-modal hidden">
        <div class="chatbot-modal-content">
            <div class="chatbot-modal-header">
                <h2 class="text-2xl font-bold">Modist - Tu Asesor Personal 👗✨</h2>
                <button id="closeChatbotBtn" class="close-btn">&times;</button>
            </div>

            <div id="chatbox"></div>

            <div id="loadingIndicator" class="hidden">
                Modist está procesando la información de moda...
                <span class="animate-pulse">...</span>
            </div>

            <div class="flex gap-2 mt-4">
                <input type="text" id="chatinput" placeholder="Pregunta a Modist sobre moda..."
                       class="flex-grow p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-sm">
                <button id="sendButton"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    Enviar
                </button>
            </div>
        </div>
    </div>
@endsection
