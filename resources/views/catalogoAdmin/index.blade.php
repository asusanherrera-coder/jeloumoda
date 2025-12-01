@extends('layouts.app')

@section('title', 'Gestión de Catálogo')

@push('styles')
    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .btn-primary, .btn-secondary, .btn-danger {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-primary { background-color: #2563eb; color: #fff; }
        .btn-secondary { background-color: #6b7280; color: #fff; }
        .btn-danger { background-color: #dc2626; color: #fff; }
        .btn-primary:hover { background-color: #1d4ed8; }
        .btn-secondary:hover { background-color: #4b5563; }
        .btn-danger:hover { background-color: #b91c1c; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 10px 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }
        th {
            background: #f3f4f6;
            text-align: left;
        }
        tr:nth-child(even) {
            background: #f9fafb;
        }
        .badge {
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
        }
        .badge-activo {
            background-color: #dcfce7;
            color: #15803d;
        }
        .badge-inactivo {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .img-thumb {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
@endpush

@section('content')
    <div class="page-header">
        <h1>Gestión de Catálogo</h1>
        <a href="{{ route('catalogoAdmin.create') }}" class="btn-primary">
            + Nuevo producto
        </a>
    </div>

    @if (session('status'))
        <div style="background:#dcfce7;color:#166534;padding:10px;border-radius:8px;margin-bottom:15px;">
            {{ session('status') }}
        </div>
    @endif

    @if ($productos->count())
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Talla</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Fecha agregado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->id_producto }}</td>
                    <td>
                        @if($producto->imagen)
                            <img src="{{ asset('IMG/PRODUCTOS/' . $producto->imagen) }}"
                                 alt="{{ $producto->nombre }}"
                                 class="img-thumb">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->categoria }}</td>
                    <td>{{ $producto->talla->nombre_talla ?? '-' }}</td>
                    <td>S/ {{ number_format($producto->precio, 2, '.', ',') }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>
                        <span class="badge badge-{{ $producto->estado }}">
                            {{ ucfirst($producto->estado) }}
                        </span>
                    </td>
                    <td>{{ $producto->fecha_agregado }}</td>
                    <td>
                        <a href="{{ route('catalogoAdmin.edit', $producto->id_producto) }}"
                           class="btn-secondary">
                            Editar
                        </a>

                        <form action="{{ route('catalogoAdmin.destroy', $producto->id_producto) }}"
                              method="POST"
                              style="display:inline-block"
                              onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div style="margin-top: 15px;">
            {{ $productos->links() }}
        </div>
    @else
        <p>No hay productos registrados.</p>
    @endif
@endsection
