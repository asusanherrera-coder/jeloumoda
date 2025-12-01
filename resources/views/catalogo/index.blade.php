@extends('layouts.app')

@section('title', 'Catálogo - Jelou Moda')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Catalogo.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/carrito.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('CSS/index.css') }}"> --}}
@endpush

@section('content')
    <section id="page-hero">
        <h1>Descubre nuestra colección</h1>
        <p>Explora las últimas tendencias en moda femenina. ¡Encuentra el look perfecto para ti!</p>
    </section>

   <section class="catalogo-productos">
        @if($productos->count())
            <div class="product-grid">
                @foreach($productos as $producto)
                    <article class="product-item">
                        {{-- La imagen y el título ya enlazan al detalle, lo cual es correcto --}}
                        <a href="{{ route('catalogo.show', $producto->id_producto) }}"
                            aria-label="Ver detalles de {{ $producto->nombre }}">
                            <img src="{{ asset('IMG/PRODUCTOS/' . $producto->imagen) }}"
                                alt="{{ $producto->nombre }}">
                            <h3 class="product-title">{{ $producto->nombre }}</h3>
                        </a>

                        <p class="product-price">
                            S/ {{ number_format($producto->precio, 2, '.', ',') }}
                        </p>

                        {{-- 🛑 ZONA DE CAMBIO: Aquí insertamos el enlace "Ver Detalles" --}}
                        
                        <a href="{{ route('catalogo.show', $producto->id_producto) }}"
                            class="add-to-cart-button ver-opciones-btn" 
                            aria-label="Ver tallas y opciones de {{ $producto->nombre }}">
                            VER DETALLES
                        </a>
                        
                        {{-- 🛑 FIN ZONA DE CAMBIO --}}

                    </article>
                @endforeach
            </div>
            
            {{-- ... paginación ... --}}
            
        @else
            <p>No se encontraron productos en el catálogo.</p>
        @endif
    </section>

<div class="d-flex justify-content-center mt-5">
    {{ $productos->links() }} 
</div>
    <!-- Chatbot -->
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
