@extends('layouts.app')

@section('title', 'Gestión de Compras')

@push('styles')
<style>
    /* Estilos corregidos */
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); overflow: hidden; }
    th, td { padding: 12px 15px; border-bottom: 1px solid #eee; text-align: left; vertical-align: middle; }
    th { background-color: #f8f9fa; font-weight: 600; color: #555; }
    
    .badge-estado { padding: 5px 10px; border-radius: 20px; font-size: 11px; font-weight: bold; text-transform: uppercase; }
    .estado-aprobado { background-color: #d1fae5; color: #065f46; }
    .estado-pendiente { background-color: #fef9c3; color: #854d0e; }
    .estado-rechazado { background-color: #fee2e2; color: #991b1b; }

    .btn-action { border: none; padding: 6px 10px; border-radius: 6px; cursor: pointer; margin-right: 5px; color: #fff; }
    .btn-view-img { background-color: #8b5cf6; }
    .btn-pdf { background-color: #3b82f6; }
    .btn-delete { background-color: #ef4444; }

    /* Modal Styles */
    #imageModal { display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.8); align-items: center; justify-content: center; }
    .modal-content { position: relative; background-color: #fff; padding: 10px; border-radius: 8px; max-width: 90%; max-height: 90%; }
    .modal-content img { max-width: 100%; max-height: 80vh; display: block; margin: 0 auto; }
    .close-modal { position: absolute; top: -15px; right: -15px; background: white; color: black; border-radius: 50%; width: 30px; height: 30px; text-align: center; line-height: 30px; font-weight: bold; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.3); }
</style>
@endpush

@section('content')

<div class="page-header">
    <h1><i class="fa-solid fa-list-check"></i> Gestión de Compras</h1>
</div>

@if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif

<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Cliente</th>
                <th>Método</th>
                <th>Comprobante</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($compras as $compra)
                <tr>
                    <td>#{{ $compra->id_compra }}</td>
                    <td>
                        {{ $compra->cliente ? $compra->cliente->nombre : 'Desconocido' }}<br>
                        <small class="text-muted">{{ $compra->cliente ? $compra->cliente->telefono : '' }}</small>
                    </td>
                    <td>
                        {{-- CORRECCIÓN ICONOS: Usamos condicionales para la extensión correcta --}}
                        @if(strtolower($compra->metodo_pago) == 'yape')
                            <img src="{{ asset('IMG/yape.jpg') }}" width="24" style="vertical-align: middle;"> Yape
                        @elseif(strtolower($compra->metodo_pago) == 'plin')
                            {{-- Asegúrate que este archivo exista en public/IMG/plin.png --}}
                            <img src="{{ asset('IMG/plin.png') }}" width="24" style="vertical-align: middle;"> Plin
                        @else
                            {{ ucfirst($compra->metodo_pago) }}
                        @endif
                    </td>
                    <td>
                        @if($compra->imagen_comprobante)
                            <button type="button" class="btn-action btn-view-img" 
                                    onclick="openModal('{{ asset('IMG/comprobantes/' . $compra->imagen_comprobante) }}')">
                                <i class="fa-solid fa-image"></i> Ver
                            </button>
                        @else
                            <span class="text-muted text-small">Sin foto</span>
                        @endif
                    </td>
                    <td>S/ {{ number_format($compra->monto_total, 2) }}</td>
                    <td>
                        <form action="{{ route('compras.cambiarEstado', $compra->id_compra) }}" method="POST" style="display: flex; gap: 5px;">
                            @csrf
                            @method('PUT')
                            <select name="estado" style="padding: 4px; border-radius: 4px; border: 1px solid #ccc;">
                                <option value="pendiente" {{ $compra->estado_pago == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="aprobado" {{ $compra->estado_pago == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                                <option value="rechazado" {{ $compra->estado_pago == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                            </select>
                            <button type="submit" class="btn-action" style="background: #10b981; margin: 0;"><i class="fa-solid fa-check"></i></button>
                        </form>
                    </td>
                    <td>{{ date('d/m/Y', strtotime($compra->fecha_compra)) }}</td>
                    <td>
                        <a href="{{ route('compras.pdf', $compra->id_compra) }}" target="_blank" class="btn-action btn-pdf"><i class="fa-solid fa-file-pdf"></i></a>
                        
                        <form action="{{ route('compras.destroy', $compra->id_compra) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar?');">
                            @csrf @method('DELETE')
                            <button class="btn-action btn-delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- MODAL FUERA DE LA TABLA --}}
<div id="imageModal">
    <div class="modal-content">
        <div class="close-modal" onclick="closeModal()">×</div>
        <img id="modalImage" src="" alt="Comprobante">
    </div>
</div>

@endsection

@push('scripts')
<script>
    function openModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').style.display = 'flex';
    }
    function closeModal() {
        document.getElementById('imageModal').style.display = 'none';
    }
    window.onclick = function(event) {
        var modal = document.getElementById('imageModal');
        if (event.target == modal) {
            closeModal();
        }
    }
</script>
@endpush