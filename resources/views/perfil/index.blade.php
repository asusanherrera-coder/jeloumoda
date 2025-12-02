@extends('layouts.app')

@section('title', 'Mi Perfil - Jelou Moda')

@push('styles')
<style>
    .profile-header {
        background-color: #f8f9fa;
        padding: 40px 0;
        margin-bottom: 30px;
        border-bottom: 1px solid #e9ecef;
    }
    .profile-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 20px;
    }
    .profile-card .card-header {
        background-color: #fff;
        border-bottom: 1px solid #f0f0f0;
        font-weight: 600;
        color: #d63384;
        padding: 15px 20px;
        border-radius: 12px 12px 0 0;
    }
    /* Estilos de Estado */
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85em;
        font-weight: 700;
        text-transform: uppercase;
        display: inline-block;
    }
    .status-pendiente { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
    .status-aprobado, .status-completado { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    .status-rechazado, .status-cancelado { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
</style>
@endpush

@section('content')

<div class="profile-header text-center">
    <div class="container">
        <h1>Mi Perfil</h1>
        <p class="text-muted">Gestiona tus datos personales y revisa tus compras</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row">
        
        {{-- COLUMNA IZQUIERDA: Editar Datos --}}
        <div class="col-lg-4">
            <div class="card profile-card">
                <div class="card-header">
                    <i class="fa-solid fa-user-pen"></i> Mis Datos Personales
                </div>
                <div class="card-body">
                    
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('perfil.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label text-muted small">Correo Electrónico</label>
                            <input type="email" class="form-control" value="{{ $cliente->correo }}" disabled style="background-color: #e9ecef;">
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $cliente->telefono) }}">
                        </div>

                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <textarea class="form-control" id="direccion" name="direccion" rows="2">{{ old('direccion', $cliente->direccion) }}</textarea>
                        </div>

                        <hr class="my-4">
                        <h6 class="text-muted mb-3"><i class="fa-solid fa-lock"></i> Seguridad</h6>

                        <div class="mb-3">
                            <label for="clave_nueva" class="form-label">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="clave_nueva" name="clave_nueva" placeholder="Opcional">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">Actualizar Datos</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- COLUMNA DERECHA: Historial de Compras --}}
        <div class="col-lg-8">
            <div class="card profile-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fa-solid fa-receipt"></i> Mis Compras / Boletas</span>
                    <span class="badge bg-secondary">{{ $compras->count() }} Pedidos</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4"># Compra</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th class="text-end pe-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($compras as $compra)
                                    <tr>
                                        <td class="ps-4 fw-bold text-muted">#{{ str_pad($compra->id_compra, 6, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($compra->fecha_compra)->format('d/m/Y') }}</td>
                                        
                                        {{-- CORRECCIÓN 1: Usar 'monto_total' --}}
                                        <td class="fw-bold">S/ {{ number_format($compra->monto_total, 2) }}</td>
                                        
                                        <td>
                                            {{-- CORRECCIÓN 2: Usar 'estado_pago' --}}
                                            @php
                                                $estado = strtolower($compra->estado_pago);
                                                $estadoClass = match($estado) {
                                                    'aprobado', 'completado' => 'status-aprobado',
                                                    'rechazado', 'cancelado' => 'status-rechazado',
                                                    default => 'status-pendiente',
                                                };
                                            @endphp
                                            <span class="status-badge {{ $estadoClass }}">
                                                {{ ucfirst($compra->estado_pago) }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-4">
                                            {{-- Enlace al detalle usando ID Compra --}}
                                            <a href="{{ route('perfil.detalle', $compra->id_compra) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fa-solid fa-eye"></i> Ver Detalle
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="fa-solid fa-bag-shopping fa-3x mb-3 text-secondary"></i>
                                            <p>Aún no has realizado ninguna compra.</p>
                                            <a href="{{ route('catalogo.index') }}" class="btn btn-primary mt-2">Ir al Catálogo</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection