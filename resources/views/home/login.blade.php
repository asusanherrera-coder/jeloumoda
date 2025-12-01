@extends('layouts.app')

@section('title', 'Iniciar Sesión - Jelou Moda')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/InicioSesion.css') }}">
@endpush

@section('content')
    <div class="wrapper">

        {{-- Mensaje de error --}}
        @if (session('error'))
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center;">
                <strong>{{ session('error') }}</strong>
            </div>
        @endif

        {{-- Validación de Laravel --}}
        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <ul style="margin:0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST">
            @csrf

            <h2>Iniciar Sesión</h2>

            <label>Correo:</label>
            <input type="text" name="usuario" value="{{ old('usuario') }}" required>

            <label>Contraseña:</label>
            <div style="position: relative;">
                <input type="password" id="contrasena" name="contrasena" required>
                <i class="fas fa-eye" id="togglePassword"
                   style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
            </div>

            {{-- Cambia este link cuando implementes recuperación de contraseña --}}
            <p><a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a></p>


            <button type="submit">Ingresar</button>

            {{-- Cuando tengas registro en Laravel, cambia este enlace a route('registro') --}}
            <p>¿No tienes cuenta? <a href="{{ route('registro.show') }}">Regístrate aquí</a></p>

        </form>
    </div>

    {{-- El footer general ya viene del layout --}}
@endsection

@push('scripts')
<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('contrasena');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.classList.toggle('fa-eye');
            togglePassword.classList.toggle('fa-eye-slash');
        });
    }
</script>
@endpush
