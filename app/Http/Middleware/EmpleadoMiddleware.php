<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EmpleadoMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session('tipo_usuario') !== 'empleado') {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión como empleado para acceder al dashboard.');
        }

        return $next($request);
    }
}
