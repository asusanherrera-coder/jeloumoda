<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use App\Models\Talla;
use Illuminate\Http\Request;

class CatalogoAdminController extends Controller
{
    public function index()
    {
        $productos = Catalogo::with('talla')
            ->orderByDesc('id_producto')
            ->paginate(10);

        return view('catalogoAdmin.index', compact('productos'));
    }

    public function create()
    {
        $tallas = Talla::orderBy('nombre_talla')->get();

        return view('catalogoAdmin.create', compact('tallas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'        => 'required|string|max:100',
            'categoria'     => 'required|string|max:50',
            'precio'        => 'required|numeric|min:0',
            'id_talla'      => 'required|exists:talla,id_talla',
            'descripcion'   => 'required|string',
            'stock'         => 'required|integer|min:0',
            'imagen'        => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'estado'        => 'required|in:activo,inactivo',
        ]);

        // ⬇️ Manejo de imagen
        $nombreImagen = null;
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreImagen = time() . '_' . $file->getClientOriginalName();

        
            $file->move(public_path('IMG/PRODUCTOS'), $nombreImagen);
        }

        Catalogo::create([
            'nombre'        => $request->nombre,
            'categoria'     => $request->categoria,
            'precio'        => $request->precio,
            'id_talla'      => $request->id_talla,
            'descripcion'   => $request->descripcion,
            'stock'         => $request->stock,
            'imagen'        => $nombreImagen,
            'estado'        => $request->estado,
            'fecha_agregado'=> now(), 
        ]);

        return redirect()->route('catalogoAdmin.index')
            ->with('status', 'Producto registrado correctamente.');
    }

    public function edit(Catalogo $producto)
    {
        $tallas = Talla::orderBy('nombre_talla')->get();

        return view('catalogoAdmin.edit', compact('producto', 'tallas'));
    }

    public function update(Request $request, Catalogo $producto)
    {
        $request->validate([
            'nombre'        => 'required|string|max:100',
            'categoria'     => 'required|string|max:50',
            'precio'        => 'required|numeric|min:0',
            'id_talla'      => 'required|exists:talla,id_talla',
            'descripcion'   => 'required|string',
            'stock'         => 'required|integer|min:0',
            'imagen'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'estado'        => 'required|in:activo,inactivo',
        ]);

        $data = $request->only([
            'nombre',
            'categoria',
            'precio',
            'id_talla',
            'descripcion',
            'stock',
            'estado',
        ]);

       
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreImagen = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('IMG/PRODUCTOS'), $nombreImagen);

            

            $data['imagen'] = $nombreImagen;
        }

        $producto->update($data);

        return redirect()->route('catalogoAdmin.index')
            ->with('status', 'Producto actualizado correctamente.');
    }

    public function destroy(Catalogo $producto)
    {
        
        $producto->delete();

     
        return redirect()->route('catalogoAdmin.index')
            ->with('status', 'Producto eliminado correctamente.');
    }
}
