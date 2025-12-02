@extends('layouts.app')

@section('title', 'Recibo de Compra #' . $transactionId)

@push('styles')
<style>
    .receipt-container {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        padding: 40px;
        max-width: 800px;
        margin: 30px auto;
        position: relative;
        border-top: 5px solid #b0256e;
    }
    
    .receipt-header {
        display: flex; justify-content: space-between; align-items: flex-start;
        border-bottom: 2px dashed #f0f0f0; padding-bottom: 20px; margin-bottom: 30px;
    }

    .brand-section h2 { color: #b0256e; font-weight: 800; margin: 0; text-transform: uppercase; letter-spacing: 1px; }
    .brand-section p { color: #666; margin: 2px 0; font-size: 0.9em; }

    .invoice-info { text-align: right; }
    .invoice-info h4 { margin: 0; color: #333; font-weight: 700; }
    .invoice-info span { display: block; color: #888; font-size: 0.9em; margin-top: 5px; }

    .client-section {
        display: flex; justify-content: space-between; margin-bottom: 30px;
        background: #fcfcfc; padding: 20px; border-radius: 8px; border: 1px solid #f5f5f5;
    }

    .client-col h5 { font-size: 0.85em; text-transform: uppercase; color: #999; font-weight: 700; margin-bottom: 10px; }
    .client-col p { margin: 0; font-weight: 600; color: #444; font-size: 1.05em; }
    .client-col small { color: #777; font-weight: 400; display: block; margin-top: 3px; }

    .receipt-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    .receipt-table th { background: #f8f9fa; text-align: left; padding: 12px; font-size: 0.85em; text-transform: uppercase; color: #666; font-weight: 700; border-bottom: 2px solid #eee; }
    .receipt-table td { padding: 15px 12px; border-bottom: 1px solid #f5f5f5; color: #333; font-size: 0.95em; }
    .receipt-table tr:last-child td { border-bottom: none; }
    
    .total-section { display: flex; justify-content: flex-end; padding-top: 20px; border-top: 2px solid #eee; }
    .total-box { text-align: right; width: 250px; }
    .total-row { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 0.95em; color: #666; }
    .total-final { font-size: 1.3em; font-weight: 800; color: #b0256e; margin-top: 10px; border-top: 1px solid #eee; padding-top: 10px; }

    .status-stamp { display: inline-block; padding: 5px 12px; border-radius: 4px; font-weight: 700; text-transform: uppercase; font-size: 0.8em; letter-spacing: 1px; }
    .st-aprobado { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
    .st-pendiente { background: #fef9c3; color: #854d0e; border: 1px solid #fde047; }
    .st-rechazado { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

    @media print {
        .main-header, footer, .chatbot-container, .no-print, .breadcrumb { display: none !important; }
        body { background: white; margin: 0; }
        .receipt-container { box-shadow: none; border: none; margin: 0; padding: 0; max-width: 100%; border-top: none; }
    }
</style>
@endpush

@section('content')
<div class="container" style="padding-top: 20px;">
    
    <div class="no-print mb-3">
        <a href="{{ route('perfil.index') }}" class="text-muted text-decoration-none">
            <i class="fa-solid fa-arrow-left"></i> Volver a mis compras
        </a>
    </div>

    <div class="receipt-container">
        
        <div class="receipt-header">
            <div class="brand-section">
                <h2>Jelou Moda</h2>
                <p>RUC: 10123456789</p>
                <p>Lima, Perú</p>
                <p>contacto@jeloumoda.com</p>
            </div>
            <div class="invoice-info">
                <h4>BOLETA DE VENTA</h4>
                <span>N° Operación: <strong>{{ $transactionId }}</strong></span>
                <span>Fecha: {{ \Carbon\Carbon::parse($compra->fecha_compra)->format('d/m/Y h:i A') }}</span>
                <div style="margin-top: 10px;">
                    @php
                        $estado = strtolower($compra->estado_pago);
                        $claseEstado = match($estado) {
                            'aprobado', 'completado' => 'st-aprobado',
                            'rechazado', 'cancelado' => 'st-rechazado',
                            default => 'st-pendiente',
                        };
                    @endphp
                    <span class="status-stamp {{ $claseEstado }}">{{ ucfirst($compra->estado_pago) }}</span>
                </div>
            </div>
        </div>

        <div class="client-section">
            <div class="client-col">
                <h5>Facturado a:</h5>
                <p>{{ Auth::user()->nombre }}</p>
                <small>{{ Auth::user()->correo }}</small>
                <small>Tel: {{ Auth::user()->telefono ?? 'No registrado' }}</small>
            </div>
            <div class="client-col" style="text-align: right;">
                <h5>Método de Pago:</h5>
                <p style="text-transform: capitalize;">
                    @if(in_array($compra->metodo_pago, ['yape', 'plin']))
                        <img src="{{ asset('IMG/' . $compra->metodo_pago . '.jpg') }}" alt="" style="width: 20px; vertical-align: middle;">
                    @endif
                    {{ $compra->metodo_pago }}
                </p>
                <small>Pago Digital</small>
            </div>
        </div>

        <table class="receipt-table">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th style="text-align: center;">Cantidad</th>
                    <th style="text-align: right;">Precio Unit.</th>
                    <th style="text-align: right;">Importe</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    @php
                        $item = (array)$item;
                        $nombre = $item['nombre'] ?? 'Producto';
                        $talla = $item['talla'] ?? ''; // <--- RECUPERAMOS LA TALLA
                        $cantidad = $item['cantidad'] ?? 1;
                        $precio = $item['precio'] ?? 0;
                        $subtotal = $precio * $cantidad;
                    @endphp
                    <tr>
                        <td>
                            <strong>{{ $nombre }}</strong>
                            {{-- MOSTRAR TALLA SI EXISTE --}}
                            @if(!empty($talla)) 
                                <br><small class="text-muted">Talla: <strong>{{ $talla }}</strong></small> 
                            @endif
                        </td>
                        <td style="text-align: center;">{{ $cantidad }}</td>
                        <td style="text-align: right;">S/ {{ number_format($precio, 2) }}</td>
                        <td style="text-align: right; font-weight: 600;">S/ {{ number_format($subtotal, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No hay detalles disponibles</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="total-section">
            <div class="total-box">
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span>S/ {{ number_format($compra->monto_total / 1.18, 2) }}</span>
                </div>
                <div class="total-row">
                    <span>IGV (18%):</span>
                    <span>S/ {{ number_format($compra->monto_total - ($compra->monto_total / 1.18), 2) }}</span>
                </div>
                <div class="total-row total-final">
                    <span>TOTAL:</span>
                    <span>S/ {{ number_format($compra->monto_total, 2) }}</span>
                </div>
            </div>
        </div>

        <div style="margin-top: 40px; text-align: center; color: #999; font-size: 0.85em; border-top: 1px solid #f0f0f0; padding-top: 20px;">
            <p>Gracias por tu compra en Jelou Moda. <br> Para cualquier consulta, contáctanos al WhatsApp +51 936 033 151.</p>
        </div>

        <div class="text-center mt-4 no-print">
            <button onclick="window.print()" class="btn btn-dark rounded-pill px-4">
                <i class="fa-solid fa-print"></i> Imprimir Comprobante
            </button>
        </div>

    </div>
</div>
@endsection