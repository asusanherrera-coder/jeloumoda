<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        
        $cargoSession = session('cargo', '');
        
        $cargo = strtolower($cargoSession);

        $cargosPermitidos = ['administrador', 'admin', 'gerente', 'jefe', 'encargado'];

        if (!in_array($cargo, $cargosPermitidos)) {
            
            // Debug opcional: Si te sigue rebotando, descomenta la siguiente línea para ver qué detecta:
            // dd("Tu cargo detectado es: " . $cargoSession);

            return redirect()->route('dashboard')
                ->with('error', 'Acceso denegado. Se requieren permisos de Administrador.');
        }

        return $next($request);
    }
}