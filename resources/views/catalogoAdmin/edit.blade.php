@extends('layouts.app')

@section('title', 'Editar producto')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Registro.css') }}">
@endpush

@section('content')
    <div class="wrapper-admin" style="max-width:600px;margin:40px auto;background:#fff;padding:25px 30px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.08);">
        <h2>Editar producto #{{ $producto->id_producto }}</h2>

        @if ($errors->any())
            <div style="background:#fee2e2;color:#b91c1c;padding:8px 12px;border-radius:8px;margin-bottom:10px;">
                <strong>Corrige los siguientes errores:</strong>
                <ul style="margin:5px 0 0 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('catalogoAdmin.update', $producto) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre"
                   value="{{ old('nombre', $producto->nombre) }}" required>

            <label for="categoria">Categoría:</label>
            <input type="text" id="categoria" name="categoria"
                   value="{{ old('categoria', $producto->categoria) }}" required>

            <label for="precio">Precio (S/):</label>
            <input type="number" step="0.01" id="precio" name="precio"
                   value="{{ old('precio', $producto->precio) }}" required>

            <label for="id_talla">Talla:</label>
            <select id="id_talla" name="id_talla" required>
                @foreach($tallas as $talla)
                    <option value="{{ $talla->id_talla }}"
                        {{ old('id_talla', $producto->id_talla) == $talla->id_talla ? 'selected' : '' }}>
                        {{ $talla->nombre_talla }}
                    </option>
                @endforeach
            </select>

            <label for=" descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion', $producto->descripcion) }}</textarea>

            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock"
                   value="{{ old('stock', $producto->stock) }}" required>

            <label>Imagen actual:</label><br>
            @if($producto->imagen)
                <img src="{{ asset('IMG/PRODUCTOS/' . $producto->imagen) }}"
                     alt="{{ $producto->nombre }}"
                     style="width:100px;height:100px;object-fit:cover;border-radius:8px;margin-bottom:8px;">
            @else
                <p>No tiene imagen.</p>
            @endif

            <label for="imagen">Cambiar imagen (opcional):</label>
            <input type="file" id="imagen" name="imagen" accept="image/*">

            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <option value="activo" {{ old('estado', $producto->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ old('estado', $producto->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>

            <div style="margin-top: 15px;">
            <a href="{{ route('catalogoAdmin.index') }}" class="btn-back">Volver</a>
                <button type="submit" class="btn-green" style="background:#16a34a;color:#fff;padding:10px 16px;border-radius:999px;border:none;cursor:pointer;">
                    Actualizar producto
                </button>
            </div>
        </form>
    </div>
@endsection
