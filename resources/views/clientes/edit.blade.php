@extends('layouts.app')

@section('title', 'Editar cliente - Jelou Moda')

@push('styles')
    <style>
        .form-wrapper {
            max-width: 600px;
            margin: 2rem auto;
            padding: 1.5rem;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .form-wrapper h1 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }
        .form-group {
            margin-bottom: 0.9rem;
        }
        .form-group label {
            display: block;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.45rem 0.6rem;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 0.9rem;
        }
        .form-actions {
            margin-top: 1.2rem;
            display: flex;
            gap: 0.5rem;
        }
        .btn-primary {
            background: #e63946;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 999px;
            border: none;
            font-size: 0.9rem;
            cursor: pointer;
        }
        .btn-secondary {
            background: #ccc;
            color: #333;
            padding: 0.5rem 1rem;
            border-radius: 999px;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .error-text {
            color: #e63946;
            font-size: 0.78rem;
        }
        .helper-text {
            font-size: 0.78rem;
            color: #777;
        }
    </style>
@endpush

@section('content')
    <div class="form-wrapper">
        <h1>Editar cliente</h1>

        <form action="{{ route('clientes.update', $cliente) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre">Nombre completo</label>
                <input type="text" id="nombre" name="nombre"
                       value="{{ old('nombre', $cliente->nombre) }}" required>
                @error('nombre')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" id="correo" name="correo"
                       value="{{ old('correo', $cliente->correo) }}" required>
                @error('correo')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="clave">Contraseña (opcional)</label>
                <input type="password" id="clave" name="clave">
                <div class="helper-text">
                    Déjalo vacío si no deseas cambiar la contraseña.
                </div>
                @error('clave')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono"
                       value="{{ old('telefono', $cliente->telefono) }}">
                @error('telefono')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion"
                       value="{{ old('direccion', $cliente->direccion) }}">
                @error('direccion')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <select id="estado" name="estado">
                    <option value="activo" {{ old('estado', $cliente->estado) === 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('estado', $cliente->estado) === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('estado')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Actualizar</button>
                <a href="{{ route('clientes.index') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
