@extends('layouts.app')

@section('title', 'Nuevo Producto')

@push('styles')
    <style>
        .form-card {
            background:#fff;
            padding:20px;
            border-radius:12px;
            max-width:700px;
            margin:0 auto;
            box-shadow:0 10px 25px rgba(15,23,42,0.08);
        }
        .form-group {
            margin-bottom: 12px;
        }
        label {
            display:block;
            font-weight:600;
            margin-bottom:4px;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"],
        input[type="date"],
        select,
        textarea {
            width:100%;
            padding:8px 10px;
            border-radius:8px;
            border:1px solid #d1d5db;
            font-size:14px;
        }
        textarea { min-height: 90px; }
        .btn-primary, .btn-secondary {
            display:inline-block;
            padding:8px 14px;
            border-radius:6px;
            border:none;
            text-decoration:none;
            cursor:pointer;
            font-size:14px;
        }
        .btn-primary { background-color:#16a34a;color:#fff; }
        .btn-primary:hover { background-color:#15803d; }
        .btn-secondary { background-color:#6b7280;color:#fff; }
        .btn-secondary:hover { background-color:#4b5563; }
        .error {
            color:#b91c1c;
            font-size:12px;
        }
    </style>
@endpush

@section('content')
    <h1 style="margin-bottom:15px;">Registrar nuevo producto</h1>

    @if ($errors->any())
        <div style="background:#fee2e2;color:#b91c1c;padding:10px;border-radius:8px;margin-bottom:15px;">
            <strong>Revisa los errores:</strong>
            <ul style="margin:5px 0 0 18px;font-size:13px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">
        <form action="{{ route('catalogoAdmin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre del producto</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="form-group">
                <label for="categoria">Categoría</label>
                <input type="text" id="categoria" name="categoria" value="{{ old('categoria') }}" required>
            </div>

            <div class="form-group">
                <label for="precio">Precio (S/)</label>
                <input type="number" step="0.01" id="precio" name="precio" value="{{ old('precio') }}" required>
            </div>

            <div class="form-group">
                <label for="id_talla">Talla</label>
                <select id="id_talla" name="id_talla" required>
                    <option value="">-- Selecciona una talla --</option>
                    @foreach($tallas as $talla)
                        <option value="{{ $talla->id_talla }}" {{ old('id_talla') == $talla->id_talla ? 'selected' : '' }}>
                            {{ $talla->nombre_talla }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock') }}" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" required>{{ old('descripcion') }}</textarea>
            </div>

            <div class="form-group">
                <label for="imagen">Imagen del producto</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <select id="estado" name="estado" required>
                    <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div style="margin-top:15px;">
                <button type="submit" class="btn-primary">Guardar producto</button>
                <a href="{{ route('catalogoAdmin.index') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
