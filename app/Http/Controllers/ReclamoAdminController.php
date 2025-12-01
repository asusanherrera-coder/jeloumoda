<?php

namespace App\Http\Controllers;

use App\Models\Reclamo;
use Illuminate\Http\Request;

class ReclamoAdminController extends Controller
{
    public function index()
    {
        $reclamos = Reclamo::orderByDesc('id_reclamo')
            ->paginate(10);

        return view('reclamos.index', compact('reclamos'));
    }

    public function destroy(Reclamo $reclamo)
    {
        $reclamo->delete();

        return redirect()->route('reclamos.index')
            ->with('status', 'Reclamo eliminado correctamente.');
    }
}
