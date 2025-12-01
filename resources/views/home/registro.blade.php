@extends('layouts.app')

@section('title', 'Registro de Cliente - Jelou Moda')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Registro.css') }}">
@endpush

@section('content')
    <div class="wrapper">

        {{-- Mensajes de validación --}}
        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <ul style="margin:0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Mensaje de éxito opcional --}}
        @if (session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('registro.store') }}" method="POST">
            @csrf

            <h2>Registro de Cliente</h2>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre"
                   value="{{ old('nombre') }}" required>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo"
                   value="{{ old('correo') }}" required>

            <label for="clave">Contraseña:</label>
            <div class="password-container" style="position:relative;">
                <input type="password" id="clave" name="clave" required>
                <i class="fas fa-eye toggle-password" id="togglePassword"
                   style="position:absolute; right:10px; top:50%; transform:translateY(-50%); cursor:pointer; color:#666;"></i>
            </div>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono"
                   value="{{ old('telefono') }}">

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion"
                   value="{{ old('direccion') }}">

            <button type="submit">Registrarse</button>

            <p>¿Ya tienes cuenta?
                <a href="{{ route('login') }}">Inicia sesión</a>
            </p>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField   = document.getElementById('clave');

    if (togglePassword && passwordField) {
        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    }
</script>
@endpush
