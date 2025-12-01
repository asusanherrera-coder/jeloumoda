@extends('layouts.app')

@section('title', 'Empleados - Jelou Moda')

@push('styles')
    <style>
        .page-wrapper {
            max-width: 1100px;
            margin: 2rem auto;
            padding: 1.5rem;
        }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .page-header h1 {
            font-size: 1.5rem;
            margin: 0;
        }
        .btn-primary {
            background: #e63946;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 999px;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .btn-primary:hover { background: #c72733; }

        .status-message {
            background: #d4edda;
            color: #155724;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        table.empleados-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .empleados-table th,
        .empleados-table td {
            padding: 0.55rem 0.7rem;
            border-bottom: 1px solid #eee;
            text-align: left;
        }
        .empleados-table th {
            background: #fafafa;
            font-weight: 600;
        }
        .badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 999px;
            font-size: 0.75rem;
        }
        .badge-activo {
            background: #d4edda;
            color: #155724;
        }
        .badge-inactivo {
            background: #f8d7da;
            color: #721c24;
        }
        .table-actions {
            display: flex;
            gap: 0.3rem;
        }
        .btn-sm {
            padding: 0.25rem 0.6rem;
            font-size: 0.8rem;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        .btn-edit {
            background: #ffd166;
            color: #333;
        }
        .btn-delete {
            background: #e63946;
            color: #fff;
        }
    </style>
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="page-header">
            <h1>Empleados</h1>
            <a href="{{ route('empleados.create') }}" class="btn-primary">
                <i class="fa-solid fa-user-plus"></i> Nuevo empleado
            </a>
        </div>

        @if(session('status'))
            <div class="status-message">
                {{ session('status') }}
            </div>
        @endif

        @if($empleados->count())
            <table class="empleados-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>DNI</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Cargo</th>
                        <th>Estado</th>
                        <th style="width: 130px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->id_empleado }}</td>
                            <td>{{ $empleado->nombres }}</td>
                            <td>{{ $empleado->dni }}</td>
                            <td>{{ $empleado->telefono }}</td>
                            <td>{{ $empleado->correo }}</td>
                            <td>{{ $empleado->cargo }}</td>
                            <td>
                                @if(strtolower($empleado->estado) === 'activo')
                                    <span class="badge badge-activo">Activo</span>
                                @else
                                    <span class="badge badge-inactivo">{{ $empleado->estado }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('empleados.edit', $empleado) }}"
                                       class="btn-sm btn-edit">Editar</a>

                                    <form action="{{ route('empleados.destroy', $empleado) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar este empleado?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm btn-delete">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top: 1rem;">
                {{ $empleados->links() }}
            </div>
        @else
            <p>No hay empleados registrados.</p>
        @endif
    </div>
@endsection
