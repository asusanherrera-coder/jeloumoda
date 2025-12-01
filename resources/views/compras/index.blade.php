@extends('layouts.app')

@section('title', 'Compras realizadas')

@push('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        margin-top: 10px;
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

    .badge-estado {
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 12px;
    }

    .estado-completado {
        background-color: #dcfce7;
        color: #15803d;
    }

    .estado-pendiente {
        background-color: #fef9c3;
        color: #854d0e;
    }

    .estado-cancelado {
        background-color: #fee2e2;
        color: #b91c1c;
    }

    .btn-danger {
        background-color: #dc2626;
        color: #fff;
        padding: 6px 12px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-size: 13px;
    }

    .btn-danger:hover {
        background-color: #b91c1c;
    }

    .datos-carrito {
        max-width: 250px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <h1>Compras realizadas</h1>
</div>

@if (session('status'))
    <div style="background:#dcfce7;color:#166534;padding:10px;border-radius:8px;margin-bottom:15px;">
        {{ session('status') }}
    </div>
@endif

@if ($compras->count())
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Transacción</th>
                <th>Cliente</th>
                <th>Método de pago</th>
                <th>Monto total</th>
                <th>Estado pago</th>
                <th>Fecha</th>
                <th>Carrito</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($compras as $compra)
                <tr>
                    <td>{{ $compra->id_compra }}</td>
                    <td>{{ $compra->transaction_id }}</td>
                    <td>
                        @if($compra->cliente)
                            {{ $compra->cliente->nombre }}
                        @else
                            <em>Sin cliente</em>
                        @endif
                    </td>
                    <td>{{ ucfirst($compra->metodo_pago) }}</td>
                    <td>S/ {{ number_format($compra->monto_total, 2, '.', ',') }}</td>
                    <td>
                        @php
                            $estadoClass = 'estado-' . strtolower($compra->estado_pago);
                        @endphp
                        <span class="badge-estado {{ $estadoClass }}">
                            {{ ucfirst($compra->estado_pago) }}
                        </span>
                    </td>
                    <td>{{ $compra->fecha_compra }}</td>
                    <td class="datos-carrito" title="{{ $compra->datos_carrito }}">
                        {{ $compra->datos_carrito }}
                    </td>

                    {{-- ACCIONES: PDF + ELIMINAR --}}
                    <td>
                        <div style="display: flex; gap: 6px;">
                            {{-- Botón PDF --}}
                            <a href="{{ route('compras.pdf', $compra->id_compra) }}"
                               class="btn btn-sm btn-primary"
                               target="_blank">
                               <button class="btn-blue">PDF</button>
                            </a>

                            {{-- Botón Eliminar --}}
                            <form action="{{ route('compras.destroy', $compra->id_compra) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Seguro que deseas eliminar esta compra?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 15px;">
        {{ $compras->links() }}
    </div>
@else
    <p>No hay compras registradas.</p>
@endif

@endsection
