{{-- resources/views/home/nosotros.blade.php --}}
@extends('layouts.app')

@section('title', 'Nosotros - Jelou Moda')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Nosotros.css') }}">
@endpush

@section('content')
    <main>
        <section id="about-hero">
            <h1>Conoce la Esencia de Jelou Moda</h1>
            <p>Descubre quiénes somos, nuestra pasión por la moda femenina y lo que nos impulsa.</p>
        </section>

        <section id="who-we-are">
            <div class="content-wrapper">
                <div class="about-text">
                    <h2>¿Quiénes Somos?</h2>
                    <p>
                        <strong>¡Bienvenida a Jelou Moda!</strong> Somos tu destino en línea para moda que inspira y empodera.
                        Ofrecemos una cuidadosa selección de ropa y zapatillas de la más alta calidad, pensadas para la mujer moderna.
                        En Jelou Moda, destacamos por nuestra <strong>navegación sencilla</strong>, <strong>precios accesibles</strong> y un compromiso genuino con la satisfacción de nuestras clientas.
                        Creemos que la moda es una forma de expresión, y por eso te invitamos a descubrir un estilo original y auténtico con Jelou Moda.
                    </p>
                    <p>
                        Nuestra misión va más allá de vender prendas; buscamos crear una comunidad donde cada mujer se sienta segura, bella y única.
                        Nos esforzamos por traerte las últimas tendencias sin sacrificar la comodidad ni la versatilidad, para que encuentres el atuendo perfecto para cada momento de tu vida.
                    </p>
                </div>
                <div class="about-image">
                    <img src="{{ asset('IMG/visionmision.jpeg') }}"
                         alt="Equipo de Jelou Moda sonriendo y trabajando en un estudio de moda">
                </div>
            </div>
        </section>

        <section id="mission-vision">
            <div class="mv-container">
                <div class="mv-item">
                    <h3>Nuestra Misión</h3>
                    <p>
                        Brindar a las mujeres una experiencia de moda única, ofreciendo prendas de vestir
                        modernas, cómodas y accesibles que resalten su estilo y personalidad, con un
                        compromiso constante con la calidad, la atención al cliente y la innovación en
                        nuestras colecciones. Aspiramos a ser más que una tienda, ser una fuente de inspiración y confianza
                        para cada una de nuestras clientas.
                    </p>
                </div>

                <div class="mv-item">
                    <h3>Nuestra Visión</h3>
                    <p>
                        Ser una marca líder en moda femenina a nivel nacional, reconocida por su creatividad,
                        estilo y compromiso con empoderar a las mujeres a través de prendas de alta
                        calidad que sean seguras, auténticas y a la vanguardia. Soñamos con vestir a cada mujer peruana
                        con confianza y distinción, haciendo de Jelou Moda un referente de estilo y buen gusto.
                    </p>
                </div>
            </div>
        </section>

        <section id="our-values">
            <h2>Nuestros Valores</h2>
            <div class="values-grid">
                <article class="value-item">
                    <h3><i class="fa-solid fa-heart"></i> Pasión por la Moda</h3>
                    <p>Vivimos y respiramos las tendencias, siempre buscando lo mejor para ti.</p>
                </article>
                <article class="value-item">
                    <h3><i class="fa-solid fa-hand-holding-heart"></i> Calidad y Confianza</h3>
                    <p>Cada prenda es seleccionada con rigurosidad para asegurar tu satisfacción.</p>
                </article>
                <article class="value-item">
                    <h3><i class="fa-solid fa-lightbulb"></i> Innovación Constante</h3>
                    <p>Siempre a la vanguardia, trayendo las últimas novedades y estilos frescos.</p>
                </article>
                <article class="value-item">
                    <h3><i class="fa-solid fa-people-group"></i> Empoderamiento Femenino</h3>
                    <p>Creemos en la fuerza y la belleza de cada mujer, y lo reflejamos en nuestras prendas.</p>
                </article>
            </div>
        </section>

        <section id="call-to-action-about">
            <h2>Únete a la Familia Jelou Moda</h2>
            <p>Te invitamos a explorar nuestra colección y a formar parte de nuestra comunidad de mujeres con estilo.</p>
            <a href="{{ route('catalogo.index') }}" class="button-primary">VER PRODUCTOS</a>
            <a href="{{ route('contacto.create') }}" class="button-secondary">CONTÁCTANOS</a>
        </section>
    </main>

    {{-- Botón flotante del chatbot --}}
    <div id="floatingChatbotBtn" class="floating-btn">
        <img src="{{ asset('IMG/Modist_Icon.png') }}" alt="Modist Chat" class="profile-pic-large">
    </div>

    {{-- Modal del chatbot --}}
    <div id="chatbotModal" class="chatbot-modal hidden">
        <div class="chatbot-modal-content">
            <div class="chatbot-modal-header">
                <h2 class="text-2xl font-bold">Modist - Tu Asesor Personal 👗✨</h2>
                <button id="closeChatbotBtn" class="close-btn">&times;</button>
            </div>

            <div id="chatbox">
                <!-- Los mensajes se insertan por JavaScript -->
            </div>

            <div id="loadingIndicator" class="hidden">
                Modist está procesando la información de moda... <span class="animate-pulse">...</span>
            </div>

            <div class="flex gap-2 mt-4">
                <input
                    type="text"
                    id="chatinput"
                    placeholder="Pregunta a Modist sobre moda..."
                    class="flex-grow p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-sm"
                >
                <button
                    id="sendButton"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                >
                    Enviar
                </button>
            </div>
        </div>
    </div>
@endsection
