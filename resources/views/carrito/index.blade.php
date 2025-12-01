@extends('layouts.app')

@section('title', 'Carrito de compras')

@push('styles')
    <style>
        .cart-wrapper {
            max-width: 900px;
            margin: 2rem auto;
            padding: 1.5rem;
        }
        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
        }
        .cart-table th,
        .cart-table td {
            padding: 0.75rem 0.9rem;
            border-bottom: 1px solid #eee;
        }
        .cart-table th {
            background: #f3f4f6;
            text-align: left;
            font-size: 0.9rem;
        }
        .cart-product {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }
        .cart-product img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
        .cart-footer {
            margin-top: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 999px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }
        .btn-primary { background:#16a34a;color:#fff; }
        .btn-secondary { background:#e5e7eb;color:#111827; }
        .btn-danger { background:#dc2626;color:#fff; }
        .btn-link { background:transparent;color:#dc2626;border:none;cursor:pointer;padding:0; }
        .qty-input {
            width: 60px;
        }
    </style>
@endpush

@section('content')
    <div class="cart-wrapper">
        <div class="cart-header">
            <h1>Tu carrito</h1>

            @if(!empty($cart))
                <form action="{{ route('carrito.clear') }}" method="POST"
                      onsubmit="return confirm('¿Vaciar todo el carrito?');">
                    @csrf
                    <button type="submit" class="btn btn-danger">Vaciar carrito</button>
                </form>
            @endif
        </div>

        @if(session('success'))
            <div style="background:#dcfce7;color:#166534;padding:10px;border-radius:8px;margin-bottom:10px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background:#fee2e2;color:#b91c1c;padding:10px;border-radius:8px;margin-bottom:10px;">
                {{ session('error') }}
            </div>
        @endif

        @if(empty($cart))
            <p>Tu carrito está vacío.</p>
            <a href="{{ route('catalogo.index') }}" class="btn btn-primary">Ir al catálogo</a>
        @else
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                        <tr>
                            <td>
                                <div class="cart-product">
                                    <img src="{{ asset('IMG/PRODUCTOS/' . $item['imagen']) }}"
                                         alt="{{ $item['nombre'] }}">
                                    <span>{{ $item['nombre'] }}</span>
                                </div>
                            </td>
                            <td>S/ {{ number_format($item['precio'], 2, '.', ',') }}</td>
                            <td>
                                <form action="{{ route('carrito.updateQuantity', $item['id']) }}"
                                      method="POST">
                                    @csrf
                                    <input type="number"
                                           name="cantidad"
                                           min="1"
                                           value="{{ $item['cantidad'] }}"
                                           class="qty-input">
                                    <button type="submit" class="btn btn-secondary" style="margin-left:4px;">
                                        Actualizar
                                    </button>
                                </form>
                            </td>
                            <td>
                                S/ {{ number_format($item['precio'] * $item['cantidad'], 2, '.', ',') }}
                            </td>
                            <td>
                                <form action="{{ route('carrito.remove', $item['id']) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar este producto del carrito?');">
                                    @csrf
                                    <button type="submit" class="btn-link">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="cart-footer">
                <a href="{{ route('catalogo.index') }}" class="btn btn-secondary">
                    ← Seguir comprando
                </a>

                <div>
                    <strong>Total: S/ {{ number_format($total, 2, '.', ',') }}</strong>
                    <a href="{{ route('checkout.index') }}" class="btn btn-primary" style="margin-left:10px;">
                        Ir a pagar
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
