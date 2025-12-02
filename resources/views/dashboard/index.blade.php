@extends('layouts.app')

@section('title', 'Panel de Control - Jelou Moda')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/dashboard.css') }}">
@endpush

@section('content')
<div class="dashboard-container" style="padding: 40px;">
    
    <h1>Bienvenido(a), {{ session('nombre') }}</h1>
    <p class="text-muted">Cargo: <strong>{{ session('cargo') }}</strong></p>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- LOGICA DE PERMISOS (Similar a tu código antiguo) --}}
    @php
        $cargo = strtolower(session('cargo', ''));
        // Define aquí quién es el jefe
        $esJefe = in_array($cargo, ['administrador', 'admin', 'gerente', 'jefe']);
    @endphp

    <div class="dashboard-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">

        {{-- 1. GESTIÓN DE EMPLEADOS (SOLO JEFES) --}}
        @if($esJefe)
            <div class="card p-3 shadow-sm border-danger">
                <h3><i class="fa-solid fa-users-gear"></i> Empleados</h3>
                <p>Gestionar accesos y personal.</p>
                <a href="{{ route('empleados.index') }}" class="btn btn-danger">Gestionar</a>
            </div>
        @endif

        {{-- 2. CLIENTES (Todos los empleados pueden ver) --}}
        <div class="card p-3 shadow-sm">
            <h3><i class="fa-solid fa-users"></i> Clientes</h3>
            <p>Ver base de datos de clientes.</p>
            <a href="{{ route('clientes.index') }}" class="btn btn-primary">Ver Clientes</a>
        </div>

        {{-- 3. COMPRAS (Todos los empleados pueden ver) --}}
        <div class="card p-3 shadow-sm">
            <h3><i class="fa-solid fa-receipt"></i> Compras</h3>
            <p>Revisar pedidos y estados.</p>
            <a href="{{ route('compras.index') }}" class="btn btn-primary">Ver Compras</a>
        </div>
        
        {{-- 4. RECLAMOS (Todos los empleados) --}}
        <div class="card p-3 shadow-sm">
            <h3><i class="fa-solid fa-clipboard-list"></i> Reclamos</h3>
            <p>Atender quejas de clientes.</p>
            <a href="{{ route('reclamos.index') }}" class="btn btn-primary">Ver Reclamos</a>
        </div>

        {{-- 5. CATÁLOGO (SOLO JEFES - O puedes dejarlo libre si quieres) --}}
        @if($esJefe)
            <div class="card p-3 shadow-sm">
                <h3><i class="fa-solid fa-shirt"></i> Catálogo</h3>
                <p>Editar productos y precios.</p>
                <a href="{{ route('catalogoAdmin.index') }}" class="btn btn-dark">Editar Productos</a>
            </div>
        @endif

    </div>

    <!-- <div style="margin-top: 40px; text-align: center;">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Cerrar Sesión</button>
        </form>
    </div> -->

</div>
@endsection