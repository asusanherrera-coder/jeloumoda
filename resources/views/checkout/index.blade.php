@extends('layouts.app')

@section('title', 'Finalizar Compra - Pago')

@push('styles')
    <style>
        .checkout-wrapper {
            max-width: 800px;
            margin: 3rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .checkout-header {
            text-align: center;
            margin-bottom: 2rem;
            border-bottom: 2px dashed #f0f0f0;
            padding-bottom: 1.5rem;
        }
        .checkout-header h1 {
            color: #b0256e; /* Color marca */
            font-weight: 700;
        }
        .payment-methods {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-bottom: 20px;
        }
        .payment-option {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 150px;
            text-align: center;
            opacity: 0.6;
        }
        .payment-option:hover {
            border-color: #b0256e;
            opacity: 1;
        }
        .payment-option.active {
            border-color: #b0256e;
            background-color: #fff0f6;
            opacity: 1;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(176, 37, 110, 0.2);
        }
        .payment-option img {
            width: 60px;
            height: auto;
            margin-bottom: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .qr-display {
            display: none;
            text-align: center;
            background: #fafafa;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
            border: 1px solid #eee;
        }
        .qr-display img {
            max-width: 250px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .upload-section {
            margin-top: 25px;
            padding: 20px;
            border: 2px dashed #b0256e;
            border-radius: 12px;
            background: #fffafa;
            text-align: center;
        }
        .upload-section input[type="file"] {
            margin-top: 10px;
        }
        .summary-list {
            list-style: none;
            padding: 0;
            margin: 0;
            background: #f9fafb;
            padding: 15px;
            border-radius: 8px;
        }
        .summary-list li {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }
        .total-row {
            font-size: 1.2rem;
            font-weight: bold;
            color: #b0256e;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
        }
        .btn-confirm {
            background: #b0256e;
            color: white;
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            margin-top: 30px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-confirm:hover {
            background: #8a1c53;
        }
    </style>
@endpush

@section('content')
    <div class="checkout-wrapper">
        <div class="checkout-header">
            <h1><i class="fa-solid fa-lock"></i> Pago Seguro</h1>
            <p class="text-muted">Escanea el QR, paga y sube tu captura.</p>
        </div>

        <div class="row">
            {{-- Columna Izquierda: Resumen --}}
            <div class="col-md-5 mb-4">
                <h4 class="mb-3">Resumen del Pedido</h4>
                <ul class="summary-list">
                    @foreach($cart as $item)
                        <li>
                            <span>{{ $item['nombre'] }} <small class="text-muted">x{{ $item['cantidad'] }}</small></span>
                            <span>S/ {{ number_format($item['precio'] * $item['cantidad'], 2) }}</span>
                        </li>
                    @endforeach
                    <li class="total-row">
                        <span>Total a Pagar:</span>
                        <span>S/ {{ number_format($total, 2) }}</span>
                    </li>
                </ul>
                <div class="alert alert-warning mt-3">
                    <small><i class="fa-solid fa-triangle-exclamation"></i> Tu pedido quedará en estado <strong>PENDIENTE</strong> hasta que el administrador verifique tu captura de pago.</small>
                </div>
            </div>

            {{-- Columna Derecha: Formulario de Pago --}}
            <div class="col-md-7">
                {{-- IMPORTANTE: enctype para subir archivos --}}
                <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data" id="checkout-form">
                    @csrf

                    <h4 class="mb-3">Selecciona Método de Pago</h4>
                    
                    {{-- Input oculto que guarda el valor real --}}
                    <input type="hidden" name="metodo_pago" id="metodo_pago" required>

                    <div class="payment-methods">
                        {{-- Opción Yape --}}
                        <div class="payment-option" onclick="selectPayment('yape')">
                            <img src="{{ asset('IMG/yape.jpg') }}" alt="Yape"> <!-- Asegurate de tener este icono pequeño -->
                            <strong>Yape</strong>
                        </div>

                        {{-- Opción Plin --}}
                        <div class="payment-option" onclick="selectPayment('plin')">
                            <img src="{{ asset('IMG/plin.png') }}" alt="Plin"> <!-- Asegurate de tener este icono pequeño -->
                            <strong>Plin</strong>
                        </div>
                    </div>

                    {{-- QR DISPLAYS --}}
                    <div id="qr-yape" class="qr-display">
                        <h5 class="text-primary fw-bold">Yapear a: Jelou Moda</h5>
                        <img src="{{ asset('IMG/yapeqr.PNG') }}" alt="QR Yape">
                        <p class="mt-2 text-muted">Escanea desde tu app de Yape</p>
                    </div>

                    <div id="qr-plin" class="qr-display">
                        <h5 class="text-info fw-bold">Plinear a: Jelou Moda</h5>
                        <img src="{{ asset('IMG/plinqr.PNG') }}" alt="QR Plin">
                        <p class="mt-2 text-muted">Escanea desde tu app de Plin, Interbank o Scotiabank</p>
                    </div>

                    {{-- SUBIDA DE ARCHIVO (OBLIGATORIA) --}}
                    <div id="upload-area" class="upload-section" style="display: none;">
                        <label for="comprobante" class="form-label fw-bold">
                            <i class="fa-solid fa-camera"></i> Sube la captura de tu pago (Obligatorio)
                        </label>
                        <input type="file" class="form-control" name="comprobante" id="comprobante" accept="image/*" required>
                        <small class="text-muted d-block mt-1">Formatos aceptados: JPG, PNG, JPEG</small>
                    </div>

                    <button type="submit" class="btn-confirm">
                        <i class="fa-solid fa-check-circle"></i> Confirmar Pago
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function selectPayment(method) {
        // 1. Actualizar el input oculto
        document.getElementById('metodo_pago').value = method;

        // 2. Estilos visuales de selección
        document.querySelectorAll('.payment-option').forEach(el => el.classList.remove('active'));
        
        // Encontrar el div clickeado y activarlo (usamos event.currentTarget en onclick inline es dificil, mejor logica simple)
        // Buscamos por texto o imagen es sucio, mejor hacemos esto:
        const options = document.querySelectorAll('.payment-option');
        if(method === 'yape') options[0].classList.add('active');
        if(method === 'plin') options[1].classList.add('active');

        // 3. Mostrar QR correspondiente
        document.getElementById('qr-yape').style.display = 'none';
        document.getElementById('qr-plin').style.display = 'none';
        
        if (method === 'yape') document.getElementById('qr-yape').style.display = 'block';
        if (method === 'plin') document.getElementById('qr-plin').style.display = 'block';

        // 4. Mostrar área de subida
        document.getElementById('upload-area').style.display = 'block';
    }
</script>
@endpush