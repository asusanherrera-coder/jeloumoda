@extends('layouts.app')

@section('title', 'Contactos recibidos')

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
        background: #dbeafe;
        color: #1e40af;
        font-size: 12px;
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <h1>Contactos recibidos</h1>
</div>

@if (session('status'))
    <div style="background:#dcfce7;color:#166534;padding:10px;border-radius:8px;margin-bottom:15px;">
        {{ session('status') }}
    </div>
@endif

@if ($contactos->count())
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Tipo</th>
                <th>Mensaje</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($contactos as $contacto)
                <tr>
                    <td>{{ $contacto->id_contacto }}</td>
                    <td>{{ $contacto->nombre }}</td>
                    <td>{{ $contacto->correo }}</td>
                    <td>{{ $contacto->telefono }}</td>
                    <td>
                        <span class="badge-tipo">{{ $contacto->tipo }}</span>
                    </td>
                    <td>{{ $contacto->mensaje }}</td>

                    <td>
                        <form action="{{ route('contactos.destroy', $contacto->id_contacto) }}"
                              method="POST"
                              onsubmit="return confirm('¿Seguro que deseas eliminar este contacto?');">

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
        {{ $contactos->links() }}
    </div>

@else
    <p>No hay contactos registrados aún.</p>
@endif

@endsection
