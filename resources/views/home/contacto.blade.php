@extends('layouts.app')

@section('title', 'Contacto - Jelou Moda')

@push('styles')
<link rel="stylesheet" href="{{ asset('CSS/Contacto.css') }}">
@endpush

@section('content')

<section id="contact-hero">
    <h1>Contáctanos - Jelou Moda</h1>
    <p>¿Tienes alguna pregunta, sugerencia o necesitas ayuda? Estamos aquí para asistirte.</p>
</section>

<section id="contact-info">
    <h2>Nuestra Información de Contacto</h2>
    <div class="contact-details-grid">
        <address class="contact-method">
            <h3><i class="fa-solid fa-phone"></i> Llámanos</h3>
            <p>Puedes comunicarte con nosotros:</p>
            <ul>
                <li><a href="tel:+51936033151">+51 936 033 151</a></li>
            </ul>
            <p class="schedule">Lunes a Viernes · 9:00 a.m. – 6:00 p.m.</p>
        </address>

        <div class="contact-method">
            <h3><i class="fa-solid fa-envelope"></i> Escríbenos</h3>
            <p>Correo para consultas:</p>
            <p><a href="mailto:info@jeloumoda.com">info@jeloumoda.com</a></p>
            <p class="schedule">Respondemos en 24 – 48 horas.</p>
        </div>

        <div class="contact-method">
            <h3><i class="fa-brands fa-whatsapp"></i> WhatsApp</h3>
            <p>Atención rápida por WhatsApp:</p>
            <p><a href="https://wa.me/51936033151" target="_blank">+51 936 033 151</a></p>
            <p class="schedule">Lunes a Sábado · 9:00 a.m. – 8:00 p.m.</p>
        </div>
    </div>
</section>

<section id="contact-form-section">
    <h2>Envíanos un Mensaje Directo</h2>
    <p>Utiliza este formulario y te responderemos pronto.</p>

    @if(session('success'))
        <div class="alert alert-success" style="background:#d4edda;padding:10px;border-radius:5px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('contacto.store') }}" method="POST" class="contact-form">
        @csrf

        <div class="form-group">
            <label for="name">Nombre Completo:</label>
            <input type="text" id="name" name="nombre" required value="{{ old('nombre') }}">
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="correo" required value="{{ old('correo') }}">
        </div>

        <div class="form-group">
            <label for="phone">Teléfono:</label>
            <input type="tel" id="phone" name="telefono" value="{{ old('telefono') }}">
        </div>

        <div class="form-group">
            <label for="subject">Asunto:</label>
            <input type="text" id="subject" name="tipo" required value="{{ old('tipo') }}">
        </div>

        <div class="form-group">
            <label for="message">Tu Mensaje:</label>
            <textarea id="message" name="mensaje" rows="6" required>{{ old('mensaje') }}</textarea>
        </div>

        <button type="submit" class="submit-button">Enviar Mensaje</button>
    </form>
</section>

@endsection
