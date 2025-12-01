@extends('layouts.app')

@section('title', 'Recuperar Contraseña - Jelou Moda')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/InicioSesion.css') }}">
@endpush

@section('content')
    <div class="wrapper">

        {{-- Mensaje de éxito --}}
        @if (session('status'))
            <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align:center;">
                {{ session('status') }}
            </div>
        @endif

        {{-- Mensaje de error personalizado --}}
        @if (session('error'))
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align:center;">
                {{ session('error') }}
            </div>
        @endif

        {{-- Errores de validación --}}
        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <ul style="margin:0; padding-left:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf

            <h2>Cambiar Contraseña</h2>

            <label for="correo">Ingresa tu correo:</label>
            <input type="email" id="correo" name="correo"
                   value="{{ old('correo') }}" required>

            <label for="clave">Ingresa tu nueva contraseña:</label>
            <div class="password-wrapper" style="position:relative;">
                <input type="password" id="clave" name="clave" required>
                <i class="fas fa-eye toggle-password"
                   onclick="togglePassword('clave', this)"
                   style="position:absolute; top:50%; right:10px; transform:translateY(-50%); cursor:pointer; color:#888;"></i>
            </div>

            <label for="confirmar-clave">Confirma tu nueva contraseña:</label>
            <div class="password-wrapper" style="position:relative;">
                <input type="password" id="confirmar-clave" name="confirmar_clave" required>
                <i class="fas fa-eye toggle-password"
                   onclick="togglePassword('confirmar-clave', this)"
                   style="position:absolute; top:50%; right:10px; transform:translateY(-50%); cursor:pointer; color:#888;"></i>
            </div>
            <span id="mensaje-error" style="color: red; display: none;">Las contraseñas no coinciden.</span><br>

            <button type="submit" name="cambiar" onclick="return verificarClave()">Cambiar</button>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    function togglePassword(inputId, icon) {
        const input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }

    function verificarClave() {
        const clave      = document.getElementById("clave").value;
        const confirmar  = document.getElementById("confirmar-clave").value;
        const mensaje    = document.getElementById("mensaje-error");

        if (clave !== confirmar) {
            mensaje.style.display = "inline";
            return false;
        }

        mensaje.style.display = "none";
        return true;
    }

    const confirmarInput = document.getElementById("confirmar-clave");
    if (confirmarInput) {
        confirmarInput.addEventListener("input", function () {
            document.getElementById("mensaje-error").style.display = "none";
        });
    }
</script>
@endpush
