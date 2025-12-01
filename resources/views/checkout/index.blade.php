@extends('layouts.app')

@section('title', 'Checkout')

@push('styles')
    <style>
        .checkout-wrapper {
            max-width: 700px;
            margin: 2rem auto;
            padding: 1.5rem;
            background:#fff;
            border-radius:12px;
            box-shadow:0 4px 12px rgba(0,0,0,0.06);
        }
        .checkout-summary {
            margin-bottom:1rem;
        }
        .checkout-summary ul {
            list-style:none;
            padding-left:0;
        }
        .checkout-summary li {
            display:flex;
            justify-content:space-between;
            margin-bottom:4px;
        }
        .form-row {
            margin-bottom:0.75rem;
        }
        label { display:block;font-size:0.9rem;margin-bottom:2px; }
        select, input[type="text"], input[type="number"] {
            width:100%;
            padding:0.45rem 0.6rem;
            border-radius:6px;
            border:1px solid #d1d5db;
            font-size:0.9rem;
        }
        .btn-primary {
            background:#16a34a;color:#fff;border:none;
            padding:0.5rem 1rem;border-radius:999px;
            cursor:pointer;
        }
    </style>
@endpush

@section('content')
    <div class="checkout-wrapper">
        <h1>Resumen de compra</h1>

        <div class="checkout-summary">
            <ul>
                @foreach($cart as $item)
                    <li>
                        <span>{{ $item['nombre'] }} x{{ $item['cantidad'] }}</span>
                        <span>S/ {{ number_format($item['precio'] * $item['cantidad'], 2, '.', ',') }}</span>
                    </li>
                @endforeach
            </ul>
            <p style="margin-top:8px;">
                <strong>Total: S/ {{ number_format($total, 2, '.', ',') }}</strong>
            </p>
        </div>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf

            <div class="form-row">
                <label for="metodo_pago">Método de pago</label>
                <select name="metodo_pago" id="metodo_pago" required>
                    <option value="">Selecciona...</option>
                    <option value="plin">Plin</option>
                    <option value="yape">Yape</option>
                    <option value="tarjeta">Tarjeta de crédito/débito</option>
                </select>
            </div>

            <div id="tarjeta-fields" style="display:none;">
                <div class="form-row">
                    <label for="numero_tarjeta">Número de tarjeta</label>
                    <input type="text" name="numero_tarjeta" id="numero_tarjeta">
                </div>
                <div class="form-row">
                    <label for="nombre_tarjeta">Nombre en la tarjeta</label>
                    <input type="text" name="nombre_tarjeta" id="nombre_tarjeta">
                </div>
                <div class="form-row">
                    <label for="fecha_vencimiento">Fecha de vencimiento (MM/AA)</label>
                    <input type="text" name="fecha_vencimiento" id="fecha_vencimiento">
                </div>
            </div>

            <button type="submit" class="btn-primary">Confirmar compra</button>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    const metodoPago = document.getElementById('metodo_pago');
    const tarjetaFields = document.getElementById('tarjeta-fields');

    metodoPago.addEventListener('change', function () {
        if (this.value === 'tarjeta') {
            tarjetaFields.style.display = 'block';
        } else {
            tarjetaFields.style.display = 'none';
        }
    });
</script>
@endpush
