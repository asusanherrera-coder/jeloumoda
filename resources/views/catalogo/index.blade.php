@extends('layouts.app')

@section('title', 'Catálogo - Jelou Moda')

@push('styles')
<style>
    /* Estructura del Catálogo */
    .catalogo-container {
        display: flex; gap: 30px; padding: 40px 20px; max-width: 1200px; margin: 0 auto;
    }
    /* Sidebar */
    .filters-sidebar {
        width: 250px; flex-shrink: 0; background: #fff; padding: 20px;
        border-radius: 10px; border: 1px solid #eee; height: fit-content;
    }
    .filter-group { margin-bottom: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 15px; }
    .filter-group:last-child { border-bottom: none; }
    .filter-title { font-weight: bold; margin-bottom: 10px; display: block; color: #333; }
    .filter-input { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px; }
    .btn-filter { width: 100%; background-color: #b0256e; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer; font-weight: bold; transition: background 0.3s; }
    .btn-filter:hover { background-color: #8a1c53; }
    .btn-reset { display: block; text-align: center; margin-top: 10px; color: #666; font-size: 0.9em; text-decoration: underline; }

    /* Grid */
    .products-grid { flex: 1; }
    .products-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 25px; }
    
    .product-card {
        background: #fff; border-radius: 10px; overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s; border: 1px solid #f0f0f0;
        text-align: center; padding-bottom: 15px; position: relative;
        display: flex; flex-direction: column;
    }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    
    .product-img-container {
        width: 100%; height: 250px; overflow: hidden; background-color: #f9f9f9;
        display: flex; align-items: center; justify-content: center;
    }
    .product-img { width: 100%; height: 100%; object-fit: cover; }
    
    .product-info { padding: 15px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; }
    .product-category { color: #999; font-size: 0.85em; text-transform: uppercase; margin-bottom: 5px; }
    .product-title { font-size: 1rem; font-weight: 600; margin: 5px 0; color: #333; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; min-height: 40px;}
    .product-price { color: #b0256e; font-weight: bold; font-size: 1.1rem; margin: 10px 0; }
    
    .btn-view {
        display: block; width: 100%; padding: 10px 0;
        background-color: transparent; border: 1px solid #b0256e;
        color: #b0256e; border-radius: 20px; text-decoration: none;
        transition: all 0.3s; font-weight: 600;
    }
    .btn-view:hover { background-color: #b0256e; color: white; }

    @media (max-width: 768px) { .catalogo-container { flex-direction: column; } .filters-sidebar { width: 100%; } }
</style>
@endpush

@section('content')

{{-- Banner --}}
<div style="background-color: #fce4ec; padding: 30px; text-align: center; margin-bottom: 20px;">
    <h1 style="color: #b0256e; font-weight: bold; margin: 0;">Catálogo de Colección</h1>
    <p style="color: #666; margin-top: 5px;">Descubre las últimas tendencias en moda urbana</p>
</div>

<div class="catalogo-container">
    
    {{-- SIDEBAR FILTROS --}}
    <aside class="filters-sidebar">
        <form action="{{ route('catalogo.index') }}" method="GET">
            
            <div class="filter-group">
                <label class="filter-title"><i class="fa-solid fa-search"></i> Buscar</label>
                <input type="text" name="buscar" class="filter-input" placeholder="Ej: Polo, Jeans..." value="{{ request('buscar') }}">
            </div>

            <div class="filter-group">
                <label class="filter-title"><i class="fa-solid fa-layer-group"></i> Categoría</label>
                <select name="categoria" class="filter-input">
                    <option value="">Todas las categorías</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat }}" {{ request('categoria') == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-title"><i class="fa-solid fa-tag"></i> Precio (S/)</label>
                <div style="display: flex; gap: 5px;">
                    <input type="number" name="precio_min" class="filter-input" placeholder="Min" min="0" value="{{ request('precio_min') }}">
                    <input type="number" name="precio_max" class="filter-input" placeholder="Max" min="0" value="{{ request('precio_max') }}">
                </div>
            </div>

            <div class="filter-group">
                <label class="filter-title"><i class="fa-solid fa-sort"></i> Ordenar</label>
                <select name="orden" class="filter-input">
                    <option value="recientes" {{ request('orden') == 'recientes' ? 'selected' : '' }}>Más recientes</option>
                    <option value="precio_asc" {{ request('orden') == 'precio_asc' ? 'selected' : '' }}>Precio: Bajo a Alto</option>
                    <option value="precio_desc" {{ request('orden') == 'precio_desc' ? 'selected' : '' }}>Precio: Alto a Bajo</option>
                </select>
            </div>

            <button type="submit" class="btn-filter">Filtrar Productos</button>
            
            @if(request()->anyFilled(['buscar', 'categoria', 'precio_min', 'precio_max']))
                <a href="{{ route('catalogo.index') }}" class="btn-reset">Borrar filtros</a>
            @endif
        </form>
    </aside>

    {{-- PRODUCTOS --}}
    <div class="products-grid">
        <div style="margin-bottom: 20px; color: #666; font-size: 0.95em;">
            Se encontraron <strong>{{ $productos->total() }}</strong> modelos disponibles.
        </div>

        @if($productos->count() > 0)
            <div class="products-list">
                @foreach($productos as $producto)
                    <div class="product-card">
                        <a href="{{ route('catalogo.show', $producto->id_producto) }}" class="product-img-container">
                            <img src="{{ asset('IMG/PRODUCTOS/' . $producto->imagen) }}" 
                                 alt="{{ $producto->nombre }}" 
                                 class="product-img"
                                 onerror="this.src='{{ asset('IMG/default-product.png') }}'">
                        </a>
                        
                        <div class="product-info">
                            <div>
                                <div class="product-category">{{ $producto->categoria }}</div>
                                <h3 class="product-title">
                                    <a href="{{ route('catalogo.show', $producto->id_producto) }}" style="color: inherit; text-decoration: none;">
                                        {{ $producto->nombre }}
                                    </a>
                                </h3>
                                <div class="product-price">S/ {{ number_format($producto->precio, 2) }}</div>
                            </div>
                            
                            {{-- Solo botón de Ver Detalle para elegir talla --}}
                            <a href="{{ route('catalogo.show', $producto->id_producto) }}" class="btn-view">
                                Ver Opciones
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="margin-top: 40px; display: flex; justify-content: center;">
                {{ $productos->links() }}
            </div>
        @else
            <div style="text-align: center; padding: 60px 20px; background: #fff; border-radius: 10px; border: 1px dashed #ddd;">
                <i class="fa-regular fa-face-frown-open fa-3x" style="color: #ccc; margin-bottom: 15px;"></i>
                <h3 style="color: #555;">No encontramos coincidencias</h3>
                <p style="color: #888;">Intenta usar palabras más generales o limpia los filtros.</p>
                <a href="{{ route('catalogo.index') }}" class="btn-view" style="max-width: 200px; margin: 20px auto;">Ver todo</a>
            </div>
        @endif
    </div>
</div>
@endsection