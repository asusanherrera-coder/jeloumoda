<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Importar Hash

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('home.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'usuario'    => 'required|email',
            'contrasena' => 'required|string',
        ]);

        // 1. Buscar al cliente por correo
        $cliente = Cliente::where('correo', $request->usuario)->first();

        // 2. Verificar si existe y si la contraseña coincide (usando Hash)
        if ($cliente && Hash::check($request->contrasena, $cliente->clave)) {
            
            // Iniciar sesión y regenerar token de seguridad
            Auth::login($cliente);
            $request->session()->regenerate();

            return redirect()->route('home')
                ->with('status', 'Bienvenido(a) ' . $cliente->nombre);
        }

        // ----------- LOGIN COMO EMPLEADO (Mantenemos tu lógica o la adaptamos) -----------
        // Nota: Idealmente los empleados deberían tener su propia tabla con Hash también.
        // Por ahora lo dejo funcional como lo tenías, pero sugiero hashear esto en el futuro.
        $empleado = Empleado::where('correo', $request->usuario)
            ->where('dni', $request->contrasena) // Asumo que aquí usas DNI como pass temporal
            ->first();

        if ($empleado) {
            session([
                'id_usuario'   => $empleado->id_empleado,
                'nombre'       => $empleado->nombres,
                'tipo_usuario' => 'empleado',
            ]);

            return redirect()->route('dashboard')
                ->with('status', 'Bienvenido admin: ' . $empleado->nombres);
        }

        return back()
            ->withInput($request->only('usuario'))
            ->with('error', 'Credenciales incorrectas.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('home.registro');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:50',
            'correo'   => 'required|email|max:100|unique:clientes,correo',
            'clave'    => 'required|string|min:6|confirmed', // 'confirmed' busca clave_confirmation
            'telefono' => 'nullable|string|max:9',
        ]);
        // Nota: En tu vista de registro, el campo de repetir contraseña debe llamarse name="clave_confirmation"

        $cliente = Cliente::create([
            'nombre'         => $request->nombre,
            'correo'         => $request->correo,
            'clave'          => Hash::make($request->clave), // <--- AQUI HASHEAMOS
            'telefono'       => $request->telefono,
            'direccion'      => $request->direccion ?? null,
            'fecha_registro' => now(),
            'estado'         => 'activo',
        ]);

        Auth::login($cliente);

        return redirect()->route('home')
            ->with('success', 'Registro completado. ¡Bienvenida!');
    }

    public function showResetForm()
    {
        return view('home.recuperar');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'correo'          => 'required|email',
            'clave'           => 'required|string|min:6|confirmed', // 'confirmed' busca clave_confirmation
        ]);

        $cliente = Cliente::where('correo', $request->correo)->first();

        if (!$cliente) {
            return back()->with('error', 'Correo no encontrado.');
        }

        $cliente->clave = Hash::make($request->clave); // <--- HASHEAMOS AL RECUPERAR
        $cliente->save();

        return redirect()->route('login')->with('status', 'Contraseña actualizada. Inicia sesión.');
    }
}