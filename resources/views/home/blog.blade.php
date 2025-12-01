@extends('layouts.app')

@section('title', 'Blog de Moda y Estilo - Jelou Moda')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Blog.css') }}">
@endpush

@section('content')

    <section id="blog-hero">
        <h1>Blog de Moda y Estilo de Jelou Moda</h1>
        <p>Descubre los mejores consejos, tendencias y novedades para realzar tu estilo único.</p>
    </section>

    <section id="latest-posts">
        <h2>Artículos Destacados</h2>
        <div class="blog-post-grid">

            <article class="blog-post-card">
                <div class="post-content">
                    <h3>5 Formas de Combinar tu Ropa sin Perder tu Estilo</h3>
                    <p class="post-meta">
                        Publicado el
                        <time datetime="2025-07-19">19 de Julio de 2025</time>
                        por <span class="author">Equipo Jelou Moda</span>
                    </p>
                    <p>
                        En JELOU MODA creemos que vestir bien no tiene que ser complicado. Aquí te compartimos
                        nuestros tips preferidos para mantenerte cómoda, auténtica y a la moda sin perder tu esencia:
                    </p>
                    <ol>
                        <li><strong>Mezcla y combina tus prendas favoritas:</strong> Combinar una prenda cómoda con
                            jeans pitillo crea equilibrio y refleja tu estilo.</li>
                        <li><strong>Colores neutros + toque llamativo:</strong> Usa colores básicos y neutros como base,
                            y añade un accesorio llamativo para destacar.</li>
                        <li><strong>Encuentra tu fit perfecto:</strong> Conocer tu tipo de cuerpo ayuda a encontrar
                            ropa que resalte lo mejor de ti.</li>
                        <li><strong>Accesorios con personalidad:</strong> Unos buenos lentes, carteras o collares
                            elevan todo tu look. Apuesta por piezas versátiles y con carácter.</li>
                        <li><strong>No te olvides de la actitud:</strong> La confianza es la mejor prenda. No copies,
                            ¡inspírate! Usa lo que te hace sentir tú misma.</li>
                    </ol>
                </div>
            </article>

            <article class="blog-post-card">
                <div class="post-content">
                    <h3>Tendencias de Moda Urbana 2025: Lo que se viene</h3>
                    <p class="post-meta">
                        Publicado el
                        <time datetime="2025-07-15">15 de Julio de 2025</time>
                        por <span class="author">Jelou Moda Style Team</span>
                    </p>
                    <p>
                        JELOU MODA te cuenta lo último en estilo callejero para que siempre estés un paso adelante.
                    </p>
                    <p>
                        El 2025 trae una mezcla poderosa entre lo retro y lo futurista en la moda urbana. Aquí te
                        contamos lo que se viene con fuerza:
                    </p>
                    <ul>
                        <li><strong>Colores grises, cromo y neón:</strong> Inspirados en lo futurista y lo urbano,
                            estos tonos dominarán los outfits más creativos.</li>
                        <li><strong>Estampados gráficos:</strong> Los dibujos y ilustraciones estilizadas gritan el
                            vibe juvenil que no dejarás de ver.</li>
                        <li><strong>Baggy jeans:</strong> Vuelven los pantalones extra sueltos con bolsillos grandes,
                            retomando los looks de los noventa.</li>
                        <li><strong>Chaquetas oversized:</strong> Con bloques de color, materiales mixtos y diseños que
                            combinan lo estético con lo funcional.</li>
                        <li><strong>Calzado con plataforma:</strong> Las botas y zapatillas renovadas se vuelven el
                            centro del look completo.</li>
                    </ul>
                    <p>
                        Usa estas piezas y exprésate como quieras – ¡sé tú con plenitud!
                    </p>
                </div>
            </article>

        </div>
    </section>

    {{-- Modal del carrito, como en tu página original --}}
    <div class="cart-overlay" id="cart-overlay" aria-hidden="true" role="dialog" aria-labelledby="cart-title">
        <div class="cart-modal">
            <button class="close-cart" aria-label="Cerrar carrito">&times;</button>
            <h2 id="cart-title">Tu Carrito</h2>
            <div id="cart-items">
                <p>El carrito está vacío.</p>
            </div>
            <div class="cart-total">
                <h4>Total: <span id="cart-total-price">S/ 0.00</span></h4>
            </div>
            <button class="checkout-button">Pagar ahora</button>
        </div>
    </div>

    {{-- Botón flotante + modal del chatbot --}}
    <div id="floatingChatbotBtn" class="floating-btn">
        <img src="{{ asset('IMG/Modist_Icon.png') }}" alt="Modist Chat" class="profile-pic-large">
    </div>

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
                <input type="text" id="chatinput"
                       placeholder="Pregunta a Modist sobre moda..."
                       class="flex-grow p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-sm">
                <button id="sendButton"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    Enviar
                </button>
            </div>
        </div>
    </div>

@endsection
