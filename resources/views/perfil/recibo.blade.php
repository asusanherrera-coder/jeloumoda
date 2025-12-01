@extends('layouts.app')

@section('title', 'Confirmación de pago - Jelou Moda')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/perfil.css') }}">
    {{-- Tailwind solo para esta vista (usa @stack("styles") en el layout) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .invoice-container,
            .invoice-container * {
                visibility: visible;
            }

            .invoice-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 20px;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
@endpush

@section('content')
    <div class="bg-[#fef1f7] text-gray-800 py-10">
        <div class="flex flex-col items-center justify-center min-h-[70vh] px-4">
            <div class="bg-white rounded-xl shadow-2xl p-8 md:p-12 w-full max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-bold text-center text-[#b0256e] mb-8">
                    Confirmación de Pago
                </h1>

                <div id="payment-receipt"
                     class="invoice-container p-6 bg-white rounded-lg shadow-inner">

                    {{-- Cabecera --}}
                    <div class="flex justify-between items-center mb-6 border-b pb-4">
                        {{-- Puedes cambiar esta imagen por tu logo real --}}
                        <img src="{{ asset('IMG/Logo.png') }}"
                             alt="Jelou Moda Logo"
                             class="h-10">
                        <h2 class="text-2xl font-bold text-gray-700">Boleta de Venta</h2>
                    </div>

                    {{-- Datos de la transacción --}}
                    <div id="transaction-details" class="space-y-2 mb-6">
                        <p><strong>Transacción ID:</strong> {{ $transactionId }}</p>
                        <p><strong>Método de Pago:</strong> {{ ucfirst($compra->metodo_pago) }}</p>
                        <p><strong>Fecha:</strong> {{ $compra->fecha_compra }}</p>
                    </div>

                    {{-- Detalle de productos --}}
                    <div id="receipt-items" class="border-t pt-4">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Detalle del Pedido</h3>

                        <div id="item-list" class="space-y-4">
                            @if (!empty($items))
                                @foreach($items as $item)
                                    @php
                                        // Limpiar nombre (quitar talla entre paréntesis al final)
                                        $nombreProductoLimpio = preg_replace('/\s*\(.*?\)\s*$/', '', $item['nombre'] ?? '');
                                        $precio = (float) ($item['precio'] ?? 0);
                                        $cantidad = (int) ($item['cantidad'] ?? 0);
                                        $subtotal = $precio * $cantidad;
                                    @endphp

                                    <div class="flex justify-between items-center py-2 border-b">
                                        <div class="flex items-center space-x-4">
                                            @if(!empty($item['imagen']))
                                                <img src="{{ asset('IMG/PRODUCTOS/' . $item['imagen']) }}"
                                                     alt="{{ $nombreProductoLimpio }}"
                                                     class="w-16 h-auto rounded-lg">
                                            @endif

                                            <div>
                                                <p class="font-medium">{{ $nombreProductoLimpio }}</p>
                                                <p class="text-sm text-gray-500">
                                                    Cantidad: {{ $cantidad }} x S/
                                                    {{ number_format($precio, 2) }}
                                                </p>
                                            </div>
                                        </div>

                                        <p class="font-bold">
                                            S/ {{ number_format($subtotal, 2) }}
                                        </p>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-center text-gray-500">
                                    No hay productos en esta compra.
                                </p>
                            @endif
                        </div>
                    </div>

                    {{-- Total --}}
                    <div id="receipt-total"
                         class="flex justify-end items-center mt-6 border-t pt-4">
                        <p class="text-2xl font-bold text-[#b0256e]">
                            Total Pagado: S/ {{ number_format($compra->monto_total, 2) }}
                        </p>
                    </div>
                </div>

                {{-- Botón imprimir --}}
                <div class="no-print text-center mt-8">
                    <button onclick="window.print()"
                            class="bg-[#b0256e] text-white py-3 px-6 rounded-lg font-bold text-lg shadow-lg hover:bg-[#a11b65] transition-colors duration-200">
                        <i class="fas fa-print mr-2"></i> Imprimir Boleta
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
