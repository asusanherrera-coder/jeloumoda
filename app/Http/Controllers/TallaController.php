<?php

namespace App\Http\Controllers;

use App\Models\Talla;
use Illuminate\Http\Request;

class TallaController extends Controller
{
    public function index()
    {
        
        $tallas = Talla::orderBy('id_talla', 'asc')->paginate(10);

        return view('tallas.index', compact('tallas'));
    }

    public function create()
    {
        return view('tallas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_talla' => 'required|string|max:10|unique:talla,nombre_talla',
        ]);

        Talla::create([
            'nombre_talla' => $request->nombre_talla,
        ]);

        return redirect()
            ->route('tallas.index')
            ->with('status', 'Talla creada correctamente.');
    }

    public function edit(Talla $talla)
    {
        return view('tallas.edit', compact('talla'));
    }

    public function update(Request $request, Talla $talla)
    {
        $request->validate([
            'nombre_talla' => 'required|string|max:10|unique:talla,nombre_talla,' . $talla->id_talla . ',id_talla',
        ]);

        $talla->update([
            'nombre_talla' => $request->nombre_talla,
        ]);

        return redirect()
            ->route('tallas.index')
            ->with('status', 'Talla actualizada correctamente.');
    }

    public function destroy(Talla $talla)
    {
       
        $talla->delete();

        return redirect()
            ->route('tallas.index')
            ->with('status', 'Talla eliminada correctamente.');
    }
}
