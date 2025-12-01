@extends('layouts.app')

@section('title', $productoPrincipal->nombre . ' - Jelou Moda')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/detalle.css') }}">
@endpush

@section('content')
    <section id="product-details-section">
        <div class="product-details-container">
            {{-- COLUMNA IMAGEN --}}
            <div class="product-image-column">
                <img src="{{ asset('IMG/PRODUCTOS/' . $productoPrincipal->imagen) }}"
                     alt="Imagen de {{ $productoPrincipal->nombre }}">
            </div>

            {{-- COLUMNA INFO --}}
            <div class="product-info-column">
                <h1>{{ $productoPrincipal->nombre }}</h1>

                <p class="product-description">
                    {{ $productoPrincipal->descripcion }}
                </p>

                <p class="product-price">
                    S/ {{ number_format($productoPrincipal->precio, 2, '.', ',') }}
                </p>

                {{-- FORMULARIO: enviar al carrito --}}
                <form method="POST" action="{{ route('carrito.add', $productoPrincipal->id_producto) }}">
                    @csrf

                    <label for="talla-select">Elige tu talla:</label>
                    <select name="id_producto_variacion" id="talla-select">
                        @foreach($variaciones as $var)
                            @php $stock = (int) $var->stock; @endphp

                            @if($stock > 0)
                                <option value="{{ $var->id_producto }}"
                                        data-stock="{{ $stock }}"
                                        {{ $loop->first ? 'selected' : '' }}>
                                    {{ $var->nombre_talla }}
                                </option>
                            @else
                                <option value="{{ $var->id_producto }}"
                                        data-stock="0"
                                        disabled>
                                    {{ $var->nombre_talla }} (Agotado)
                                </option>
                            @endif
                        @endforeach
                    </select>

                    {{-- Selector de cantidad --}}
                    <div class="quantity-selector">
                        <button type="button" class="quantity-btn" id="decrease-btn">-</button>
                        <input type="number"
                               id="product-quantity"
                               value="1"
                               min="1"
                               max="1"
                               readonly>
                        <button type="button" class="quantity-btn" id="increase-btn">+</button>
                    </div>

                    {{-- este input oculto es el que realmente se envía en el POST --}}
                    <input type="hidden" name="cantidad" id="cantidad-input-hidden" value="1">

                    <p id="stock-message" style="margin-top: 10px; font-size: 0.9em;"></p>

                    <div class="product-actions-buttons">
                        <button type="submit"
                                class="add-to-cart-button"
                                id="add-to-cart-btn"
                                name="accion"
                                value="carrito">
                            Añadir al carrito
                        </button>

                        {{-- si luego quieres que compre directo, puedes redirigir al checkout desde el controller --}}
                        <button type="submit"
                                class="buy-now-button"
                                id="buy-now-btn"
                                name="accion"
                                value="comprar">
                            Comprar ahora
                        </button>
                    </div>
                </form>

                {{-- Link para volver --}}
                <p style="margin-top: 20px;">
                    <a href="{{ route('catalogo.index') }}">← Volver al catálogo</a>
                </p>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tallaSelect      = document.getElementById('talla-select');
        const quantityInput    = document.getElementById('product-quantity');
        const decreaseBtn      = document.getElementById('decrease-btn');
        const increaseBtn      = document.getElementById('increase-btn');
        const stockMessage     = document.getElementById('stock-message');
        const addToCartBtn     = document.getElementById('add-to-cart-btn');
        const buyNowBtn        = document.getElementById('buy-now-btn');
        const hiddenCantidad   = document.getElementById('cantidad-input-hidden');

        function syncCantidadHidden() {
            hiddenCantidad.value = quantityInput.value;
        }

        function updateQuantityControls() {
            const selectedOption = tallaSelect.options[tallaSelect.selectedIndex];
            const stock = parseInt(selectedOption.dataset.stock);

            quantityInput.setAttribute('max', stock);

            if (parseInt(quantityInput.value) > stock) {
                quantityInput.value = stock;
            }

            if (stock === 0) {
                quantityInput.value = 0;
                addToCartBtn.disabled = true;
                buyNowBtn.disabled    = true;
                stockMessage.textContent = "¡Agotado!";
                stockMessage.style.color = "red";
            } else {
                if (parseInt(quantityInput.value) === 0) {
                    quantityInput.value = 1;
                }
                addToCartBtn.disabled = false;
                buyNowBtn.disabled    = false;
                stockMessage.textContent = `Stock disponible: ${stock}`;
                stockMessage.style.color = "green";
            }

            decreaseBtn.disabled = parseInt(quantityInput.value) <= 1;
            increaseBtn.disabled = parseInt(quantityInput.value) >= stock;

            syncCantidadHidden();
        }

        if (tallaSelect) {
            tallaSelect.addEventListener('change', updateQuantityControls);
            updateQuantityControls(); // al cargar
        }

        if (decreaseBtn && increaseBtn && quantityInput) {
            decreaseBtn.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                    updateQuantityControls();
                }
            });

            increaseBtn.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                let maxStock = parseInt(quantityInput.getAttribute('max'));
                if (currentValue < maxStock) {
                    quantityInput.value = currentValue + 1;
                    updateQuantityControls();
                }
            });
        }
    });
</script>
@endpush
