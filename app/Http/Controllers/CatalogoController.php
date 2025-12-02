<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogoController extends Controller
{
    public function index(Request $request)
    {
        // Iniciamos la consulta
        // TRUCO: Usamos groupBy para que no se repitan los nombres (agrupa tallas)
        // Seleccionamos el ID mínimo para tener una referencia, y los datos visuales
        $query = Catalogo::select('nombre', 'categoria', 'precio', 'imagen', DB::raw('MIN(id_producto) as id_producto'))
                         ->where('estado', 'activo');

        // 1. Filtro por Nombre
        if ($request->has('buscar') && $request->buscar != '') {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        // 2. Filtro por Categoría
        if ($request->has('categoria') && $request->categoria != '') {
            $query->where('categoria', $request->categoria);
        }

        // 3. Filtros de Precio
        if ($request->filled('precio_min')) {
            $query->where('precio', '>=', $request->precio_min);
        }
        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }

        // Agrupamos para eliminar duplicados visuales
        $query->groupBy('nombre', 'categoria', 'precio', 'imagen');

        // 4. Ordenamiento
        if ($request->has('orden')) {
            if ($request->orden == 'precio_asc') {
                $query->orderBy('precio', 'asc');
            } elseif ($request->orden == 'precio_desc') {
                $query->orderBy('precio', 'desc');
            } else {
                $query->orderBy('id_producto', 'desc');
            }
        } else {
            $query->orderBy('id_producto', 'desc');
        }

        // Paginación
        $productos = $query->paginate(12)->withQueryString();

        // Categorías para el filtro
        $categorias = Catalogo::select('categoria')
                        ->where('estado', 'activo')
                        ->distinct()
                        ->orderBy('categoria', 'asc')
                        ->pluck('categoria');

        return view('catalogo.index', compact('productos', 'categorias'));
    }

    public function show($id)
    {
        // 1. Buscamos el producto base seleccionado
        $productoBase = Catalogo::findOrFail($id);

        // 2. Buscamos TODAS las tallas de este mismo producto (mismo nombre)
        // Esto es vital para que en la vista de detalle salgan los botones S, M, L
        $variaciones = Catalogo::where('nombre', $productoBase->nombre)
                               ->where('estado', 'activo')
                               ->get();

        // 3. Productos relacionados (misma categoría, diferente nombre)
        // CORRECCIÓN: Especificamos las columnas y agrupamos por todas ellas para evitar error 1055
        $relacionados = Catalogo::select('nombre', 'categoria', 'precio', 'imagen', DB::raw('MIN(id_producto) as id_producto'))
                            ->where('categoria', $productoBase->categoria)
                            ->where('nombre', '!=', $productoBase->nombre)
                            ->where('estado', 'activo')
                            ->groupBy('nombre', 'categoria', 'precio', 'imagen') // Agregamos todos los campos del select al group by
                            ->take(4)
                            ->get();

        // Enviamos $variaciones a la vista show
        return view('catalogo.show', compact('productoBase', 'variaciones', 'relacionados'));
    }
}