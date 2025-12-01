@extends('layouts.app')

@section('title', 'Libro de Reclamaciones - Jelou Moda')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/LibroReclamaciones.css') }}">
@endpush

@section('content')
<main class="libro-reclamaciones-main">
    <section class="complaint-form-section">
        <h1>Libro de Reclamaciones</h1>
        <p class="intro-text">
            En Jelou Moda, valoramos tu opinión. Si tienes alguna queja o reclamo sobre nuestros
            productos o servicios, por favor, completa el siguiente formulario. Nos comprometemos
            a responderte en el menor tiempo posible.
        </p>

        @if(session('success'))
            <div style="background:#dcfce7;color:#166534;padding:10px;border-radius:8px;margin-bottom:15px;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background:#fee2e2;color:#b91c1c;padding:10px;border-radius:8px;margin-bottom:15px;">
                <strong>Corrige los siguientes errores:</strong>
                <ul style="margin:5px 0 0 18px;">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reclamos.store') }}" method="POST" class="complaint-form">
            @csrf

            <h2>1. Identificación del Consumidor</h2>

            <div class="form-group">
                <label for="doc-type">Tipo de Documento:</label>
                <select id="doc-type" name="tipo_documento" required>
                    <option value="">Selecciona</option>
                    <option value="DNI" {{ old('tipo_documento')=='DNI' ? 'selected' : '' }}>DNI</option>
                    <option value="CE" {{ old('tipo_documento')=='CE' ? 'selected' : '' }}>Carné de Extranjería</option>
                </select>
            </div>

            <div class="form-group">
                <label for="doc-number">N° de Documento:</label>
                <input type="text" id="doc-number" name="num_documento"
                       value="{{ old('num_documento') }}" required>
            </div>

            <div class="form-group">
                <label for="nombre">Nombres:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellidos:</label>
                <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}" required>
            </div>

            <div class="form-group">
                <label for="direccion">Domicilio:</label>
                <input type="text" id="direccion" name="direccion"
                       placeholder="Dirección completa"
                       value="{{ old('direccion') }}" required>
            </div>

            <div class="form-group-inline">
                <div class="form-group">
                    <label for="departamento">Departamento:</label>
                    <input type="text" id="departamento" name="departamento"
                           value="{{ old('departamento') }}" required>
                </div>
                <div class="form-group">
                    <label for="provincia">Provincia:</label>
                    <input type="text" id="provincia" name="provincia"
                           value="{{ old('provincia') }}" required>
                </div>
                <div class="form-group">
                    <label for="distrito">Distrito:</label>
                    <input type="text" id="distrito" name="distrito"
                           value="{{ old('distrito') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono"
                       value="{{ old('telefono') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}" required>
            </div>

            <h2>2. Identificación del Bien Contratado</h2>

            <div class="form-group">
                <label for="order-amount">Monto del Pedido (S/):</label>
                <input type="number" id="order-amount" name="monto" step="0.01" min="0"
                       value="{{ old('monto') }}">
            </div>

            <div class="form-group">
                <label for="product-description">Descripción del Bien/Servicio:</label>
                <textarea id="product-description" name="descripcion" rows="3"
                          placeholder="Ej. Blusa de seda color rosa, Talla M, Pedido #12345"
                          required>{{ old('descripcion') }}</textarea>
            </div>

            <div class="form-group">
                <label for="complaint-type">Tipo de Reclamo:</label>
                <select id="complaint-type" name="tipo_reclamo" required>
                    <option value="">Selecciona</option>
                    <option value="reclamo" {{ old('tipo_reclamo')=='reclamo' ? 'selected' : '' }}>
                        Reclamo (Disconformidad con el producto o servicio)
                    </option>
                    <option value="queja" {{ old('tipo_reclamo')=='queja' ? 'selected' : '' }}>
                        Queja (Malestar con la atención, pero no directamente con el producto)
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="complaint-detail">Detalle del Reclamo/Queja:</label>
                <textarea id="complaint-detail" name="detalle_reclamo" rows="6"
                          placeholder="Describe detalladamente lo sucedido..." required>{{ old('detalle_reclamo') }}</textarea>
            </div>

            <div class="form-group">
                <label for="consumer-request">Pedido del Consumidor:</label>
                <textarea id="consumer-request" name="pedido" rows="3"
                          placeholder="¿Qué solución esperas?" required>{{ old('pedido') }}</textarea>
            </div>

            <div class="form-group">
                <label for="claim-date">Fecha del Reclamo:</label>
                <input type="date" id="claim-date" name="fecha_reclamo"
                       value="{{ old('fecha_reclamo', now()->toDateString()) }}" required>
            </div>

            <div class="form-group checkbox-group">
                <input type="checkbox" id="privacy-consent" name="consentimiento" required>
                <label for="privacy-consent">
                    Autorizo el tratamiento de mis datos personales de acuerdo con la Ley N° 29733,
                    Ley de Protección de Datos Personales.
                </label>
            </div>

            <button type="submit" class="submit-button">Enviar Reclamo/Queja</button>
        </form>
    </section>
</main>


{{-- Botón + modal del chatbot --}}
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
