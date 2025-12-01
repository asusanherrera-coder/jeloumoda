<?php

namespace App\Http\Controllers;

use App\Models\Contacto;

class ContactoAdminController extends Controller
{
    // Listado de contactos
    public function index()
    {
        $contactos = Contacto::orderByDesc('id_contacto')->paginate(10);

        return view('contactos.index', compact('contactos'));
    }

    // Eliminar contacto
    public function destroy(Contacto $contacto)
    {
        $contacto->delete();

        return redirect()->route('contactos.index')
            ->with('status', 'Contacto eliminado correctamente.');
    }
}
