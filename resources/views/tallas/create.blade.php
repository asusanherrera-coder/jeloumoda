@extends('layouts.app')

@section('title', 'Nueva talla - Jelou Moda')

@push('styles')
    <style>
        .form-wrapper {
            max-width: 450px;
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
        .form-group input {
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
    </style>
@endpush

@section('content')
    <div class="form-wrapper">
        <h1>Nueva talla</h1>

        <form action="{{ route('tallas.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nombre_talla">Nombre de talla</label>
                <input type="text" id="nombre_talla" name="nombre_talla"
                       value="{{ old('nombre_talla') }}" required>
                @error('nombre_talla')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Guardar</button>
                <a href="{{ route('tallas.index') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
