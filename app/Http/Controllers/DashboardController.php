<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $empleadosRecientes = Empleado::orderBy('fecha_ingreso', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.index', compact('empleadosRecientes'));
    }
}
