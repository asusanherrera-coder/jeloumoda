<?php

namespace App\Http\Controllers;

use App\Models\Catalogo; // Asumo que este es tu modelo de producto
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // ¡Importar DB para usar DB::raw!

class CatalogoController extends Controller
{
   public function index()
    {
        $productos = Catalogo::where('estado', 'activo')
            // Selecciona las columnas que definen la unicidad del producto (nombre, imagen, precio, etc.)
            ->select('nombre', 'imagen', 'precio') 
            
            // Crucial: Usa DB::raw para obtener el ID de uno de los registros del grupo.
            // Esto es necesario para tener un ID al cual enlazar la vista de detalle.
            // Usamos MIN(id_producto) solo para obtener un ID válido para el enlace.
            ->addSelect(DB::raw('MIN(id_producto) as id_producto'))

            // Agrupa por los campos que quieres que definan un producto único
            ->groupBy('nombre', 'imagen', 'precio')
            
            // Si necesitas ordenar, ordena por el campo agrupado, por ejemplo, el nombre
            ->orderBy('nombre') 
            
            // Aplica la paginación
            ->paginate(12);

        // Ya no cargamos la talla aquí, ya que el producto es ahora un "grupo"
        // La talla se seleccionará en la vista de detalle.

        return view('catalogo.index', compact('productos'));
    }

    public function show(Catalogo $producto)
    {
        
        $variaciones = Catalogo::where('nombre', $producto->nombre)
            ->where('estado', 'activo')
            ->join('talla', 'catalogo.id_talla', '=', 'talla.id_talla')
            ->orderBy('talla.nombre_talla')
            ->select('catalogo.*', 'talla.nombre_talla')
            ->get();

        if ($variaciones->isEmpty()) {
            abort(404);
        }

      
        $productoPrincipal = $variaciones->first();

        return view('catalogo.detalle', [
            'productoPrincipal' => $productoPrincipal,
            'variaciones'       => $variaciones,
        ]);
    }
}
