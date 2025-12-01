<?php

namespace App\Http\Controllers;

use App\Models\Reclamo;
use Illuminate\Http\Request;

class ReclamoController extends Controller
{
    
    public function create()
    {
        return view('home.libro-reclamaciones');
    }

   
    public function store(Request $request)
    {
        $data = $request->validate([
            'tipo_documento'   => 'required|string|max:20',
            'num_documento'    => 'required|string|max:20',
            'nombre'           => 'required|string|max:255',
            'apellido'         => 'required|string|max:255',
            'direccion'        => 'required|string|max:255',
            'departamento'     => 'required|string|max:100',
            'provincia'        => 'required|string|max:100',
            'distrito'         => 'required|string|max:100',
            'telefono'         => 'required|string|max:50',
            'email'            => 'required|email|max:255',
            'monto'            => 'nullable|numeric|min:0',
            'descripcion'      => 'required|string',
            'tipo_reclamo'     => 'required|string|max:50',
            'detalle_reclamo'  => 'required|string',
            'pedido'           => 'required|string',
            'fecha_reclamo'    => 'required|date',
        ]);

        Reclamo::create($data);

        return redirect()
            ->route('reclamos.create')
            ->with('success', 'Tu reclamo/queja ha sido enviado correctamente.');
    }
}
