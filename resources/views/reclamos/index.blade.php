@extends('layouts.app')

@section('title', 'Reclamos')

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

    .badge-tipo {
        padding: 4px 10px;
        border-radius: 999px;
        background: #e0f2fe;
        color: #0369a1;
        font-size: 12px;
    }

    .texto-largo {
        max-width: 260px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <h1>Reclamos</h1>
</div>

@if (session('status'))
    <div style="background:#dcfce7;color:#166534;padding:10px;border-radius:8px;margin-bottom:15px;">
        {{ session('status') }}
    </div>
@endif

@if ($reclamos->count())
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Documento</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Monto</th>
                <th>Tipo reclamo</th>
                <th>Detalle</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($reclamos as $reclamo)
                <tr>
                    <td>{{ $reclamo->id_reclamo }}</td>
                    <td>{{ $reclamo->nombre }} {{ $reclamo->apellido }}</td>
                    <td>{{ $reclamo->tipo_documento }} {{ $reclamo->num_documento }}</td>
                    <td>{{ $reclamo->telefono }}</td>
                    <td>{{ $reclamo->email }}</td>
                    <td>S/ {{ number_format($reclamo->monto, 2, '.', ',') }}</td>
                    <td>
                        <span class="badge-tipo">{{ $reclamo->tipo_reclamo }}</span>
                    </td>
                    <td class="texto-largo"
                        title="{{ $reclamo->detalle_reclamo }}">
                        {{ $reclamo->detalle_reclamo }}
                    </td>
                    <td>{{ $reclamo->fecha_reclamo }}</td>
                    <td>
                        <form action="{{ route('reclamos.destroy', $reclamo->id_reclamo) }}"
                              method="POST"
                              onsubmit="return confirm('¿Seguro que deseas eliminar este reclamo?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 15px;">
        {{ $reclamos->links() }}
    </div>
@else
    <p>No hay reclamos registrados.</p>
@endif

@endsection
