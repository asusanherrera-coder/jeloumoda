@extends('layouts.app')

@section('title', 'Dashboard - Jelou Moda')

@push('styles')
    <style>
        .dashboard-wrapper {
            max-width: 1100px;
            margin: 2rem auto;
            padding: 1.5rem;
        }
        .dashboard-title {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        .dashboard-subtitle {
            color: #666;
            margin-bottom: 1.5rem;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .dashboard-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.06);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .dashboard-card h3 {
            margin: 0;
            font-size: 1.1rem;
        }
        .dashboard-card p {
            margin: 0;
            color: #666;
            font-size: 0.9rem;
        }
        .dashboard-card a {
            margin-top: 0.75rem;
            align-self: flex-start;
            padding: 0.5rem 0.9rem;
            border-radius: 999px;
            background: #e63946;
            color: #fff;
            font-size: 0.85rem;
            text-decoration: none;
            transition: background 0.2s;
        }
        .dashboard-card a:hover {
            background: #c72733;
        }
        .table-wrapper {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.06);
            padding: 1.5rem;
            overflow-x: auto;
        }
        .table-wrapper h2 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        .dashboard-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }
        .dashboard-table th,
        .dashboard-table td {
            padding: 0.55rem 0.6rem;
            border-bottom: 1px solid #eee;
            text-align: left;
        }
        .dashboard-table th {
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
    </style>
@endpush

@section('content')
    <div class="dashboard-wrapper">
        <h1 class="dashboard-title">Panel de administración</h1>
        <p class="dashboard-subtitle">
            Hola <strong>{{ session('nombre') }}</strong>, bienvenido(a) al panel de Jelou Moda.
        </p>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h3><i class="fa-solid fa-user-tie"></i> Empleados</h3>
                <p>Gestiona la información del personal: nuevos ingresos, cambios y bajas.</p>
                <a href="{{ route('empleados.index') }}">Gestionar empleados</a>
            </div>
            <div class="dashboard-card">
                <h3><i class="fa-solid fa-users"></i> Clientes</h3>
                <p>Gestiona las cuentas de las clientas registradas.</p>
                <a href="{{ route('clientes.index') }}">Gestionar clientes</a>
            </div>

            <div class="dashboard-card">
                <h3><i class="fa-solid fa-ruler-horizontal"></i> Tallas</h3>
                <p>Administra las tallas disponibles para los productos.</p>
                <a href="{{ route('tallas.index') }}">Gestionar tallas</a>
            </div>

            <div class="dashboard-card">
                <h3><i class="fa-solid fa-envelope"></i> Contactos</h3>
                <p>Mensajes enviados desde el formulario de contacto.</p>
                <a href="{{ route('contactos.index') }}">Ver contactos</a>
            </div>

            <div class="dashboard-card">
                <h3><i class="fa-solid fa-receipt"></i> Compras</h3>
                <p>Historial de compras realizadas en la tienda.</p>
                <a href="{{ route('compras.index') }}">Ver compras</a>
            </div>

            <div class="dashboard-card">
                <h3><i class="fa-solid fa-clipboard-list"></i> Reclamos</h3>
                <p>Revisa los reclamos registrados por las clientas.</p>
                <a href="{{ route('reclamos.index') }}">Ver reclamos</a>
            </div>





            <div class="dashboard-card">
                <h3><i class="fa-solid fa-shirt"></i> Catálogo</h3>
                <p>Administra los productos que se muestran en la tienda.</p>
                <a href="{{ route('catalogoAdmin.index') }}">Ver catálogo</a>
            </div>


        </div>

        <div class="table-wrapper">
            <h2>Empleados recientes</h2>
            @if($empleadosRecientes->count())
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Cargo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleadosRecientes as $empleado)
                            <tr>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay empleados registrados aún.</p>
            @endif
        </div>
    </div>
@endsection
