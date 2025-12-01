<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;   

class ContactoController extends Controller
{
    public function create()
    {
        return view('home.contacto');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'   => 'required|string|max:255',
            'correo'   => 'required|email|max:255',
            'telefono' => 'nullable|string|max:50',
            'tipo'     => 'required|string|max:255',
            'mensaje'  => 'required|string',
        ]);

     
        Contacto::create($data);

        return redirect()
            ->route('contacto.create')
            ->with('success', 'Tu mensaje ha sido enviado correctamente.');
    }
}
