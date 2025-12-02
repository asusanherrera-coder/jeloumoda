@extends('layouts.app')

@section('title', $productoBase->nombre . ' - Jelou Moda')

@push('styles')
<style>
    .product-detail-container {
        max-width: 1100px;
        margin: 40px auto;
        padding: 0 20px;
    }
    
    .product-wrapper {
        display: flex;
        gap: 50px;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    /* Imagen */
    .detail-image-container {
        flex: 1;
        max-width: 500px;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #eee;
    }
    .detail-image {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.3s;
    }
    .detail-image:hover {
        transform: scale(1.05);
    }

    /* Info */
    .detail-info {
        flex: 1;
    }
    .detail-category {
        color: #999;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }
    .detail-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: #333;
        line-height: 1.2;
    }
    .detail-price {
        font-size: 1.8rem;
        color: #b0256e;
        font-weight: bold;
        margin-bottom: 25px;
    }
    .detail-description {
        color: #666;
        line-height: 1.6;
        margin-bottom: 30px;
        font-size: 1rem;
    }

    /* Selector de Tallas */
    .size-selector {
        margin-bottom: 30px;
    }
    .size-label {
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
        color: #333;
    }
    .sizes-options {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .size-radio {
        display: none; /* Ocultar el radio button real */
    }
    .size-btn {
        padding: 10px 20px;
        border: 2px solid #ddd;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s;
        background: #fff;
        min-width: 50px;
        text-align: center;
    }
    /* Estilo cuando está seleccionado */
    .size-radio:checked + .size-btn {
        border-color: #b0256e;
        background-color: #b0256e;
        color: white;
        box-shadow: 0 4px 10px rgba(176, 37, 110, 0.3);
    }
    .size-radio:disabled + .size-btn {
        opacity: 0.5;
        cursor: not-allowed;
        background: #f9f9f9;
        text-decoration: line-through;
    }

    /* Acciones */
    .actions {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }
    .qty-input {
        width: 70px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        text-align: center;
        font-size: 1.1rem;
    }
    .btn-add-cart {
        flex: 1;
        background-color: #333;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 8px;
        font-weight: bold;
        font-size: 1.1rem;
        cursor: pointer;
        transition: background 0.3s;
    }
    .btn-add-cart:hover {
        background-color: #000;
    }

    /* Relacionados */
    .related-section {
        margin-top: 60px;
    }
    .related-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 20px;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 10px;
    }

    @media (max-width: 768px) {
        .product-wrapper { flex-direction: column; gap: 20px; }
    }
</style>
@endpush

@section('content')

<div class="product-detail-container">
    
    {{-- Mensajes de éxito/error --}}
    @if(session('success'))
        <div class="alert alert-success" style="background:#dcfce7; color:#166534; padding:15px; border-radius:8px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="product-wrapper">
        {{-- Columna Izquierda: Imagen --}}
        <div class="detail-image-container">
            {{-- Usamos data-fallback para evitar errores de sintaxis en JS --}}
            <img src="{{ asset('IMG/PRODUCTOS/' . $productoBase->imagen) }}" 
                 alt="{{ $productoBase->nombre }}" 
                 class="detail-image"
                 data-fallback="{{ asset('IMG/default-product.png') }}"
                 onerror="this.onerror=null; this.src=this.dataset.fallback;">
        </div>

        {{-- Columna Derecha: Información --}}
        <div class="detail-info">
            <div class="detail-category">{{ $productoBase->categoria }}</div>
            <h1 class="detail-title">{{ $productoBase->nombre }}</h1>
            <div class="detail-price">S/ {{ number_format($productoBase->precio, 2) }}</div>
            
            <div class="detail-description">
                {{ $productoBase->descripcion ?: 'Prenda exclusiva de Jelou Moda, diseñada para destacar tu estilo urbano y moderno.' }}
            </div>

            {{-- FORMULARIO DE COMPRA --}}
            {{-- Usamos el ID del producto base por defecto en la ruta, pero el input hidden es el que manda --}}
            <form action="{{ route('carrito.add', $productoBase->id_producto) }}" method="POST">
                @csrf
                <input type="hidden" name="accion" value="carrito">
                
                {{-- Selector de Tallas (Dinámico según BD) --}}
                <div class="size-selector">
                    <span class="size-label">Selecciona tu Talla:</span>
                    <div class="sizes-options">
                        @foreach($variaciones as $index => $variacion)
                            {{-- Buscamos el nombre de la talla usando la relación si existe, o un placeholder --}}
                            @php
                                // Asumimos que tienes relación 'talla' en el modelo Catalogo
                                // Si no, puedes mostrar el ID o necesitarás hacer un join en el controlador
                                $nombreTalla = $variacion->talla ? $variacion->talla->nombre_talla : 'Talla ' . $variacion->id_talla;
                            @endphp

                            <input type="radio" 
                                   name="id_producto_variacion" 
                                   id="talla-{{ $variacion->id_producto }}" 
                                   value="{{ $variacion->id_producto }}" 
                                   class="size-radio"
                                   {{ $index === 0 ? 'checked' : '' }} {{-- Seleccionar el primero por defecto --}}
                                   required>
                            
                            <label for="talla-{{ $variacion->id_producto }}" class="size-btn">
                                {{ $nombreTalla }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="actions">
                    <input type="number" name="cantidad" value="1" min="1" class="qty-input">
                    <button type="submit" class="btn-add-cart">
                        <i class="fa-solid fa-cart-plus"></i> Añadir al Carrito
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Productos Relacionados --}}
    @if($relacionados->count() > 0)
        <div class="related-section">
            <h3 class="related-title">También te podría gustar</h3>
            <div class="row row-cols-2 row-cols-md-4 g-4">
                @foreach($relacionados as $rel)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm">
                            <a href="{{ route('catalogo.show', $rel->id_producto) }}">
                                {{-- Aplicamos el mismo fix de data-fallback aquí --}}
                                <img src="{{ asset('IMG/PRODUCTOS/' . $rel->imagen) }}" 
                                     class="card-img-top" 
                                     alt="{{ $rel->nombre }}" 
                                     style="height: 200px; object-fit: cover;"
                                     data-fallback="{{ asset('IMG/default-product.png') }}"
                                     onerror="this.onerror=null; this.src=this.dataset.fallback;">
                            </a>
                            <div class="card-body text-center">
                                <h6 class="card-title text-truncate">{{ $rel->nombre }}</h6>
                                <p class="card-text fw-bold text-pink-600">S/ {{ number_format($rel->precio, 2) }}</p>
                                <a href="{{ route('catalogo.show', $rel->id_producto) }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">Ver</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection