<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail; // Importante
use App\Mail\WelcomeMail;            // Importante

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

        // 1. LOGIN CLIENTE
        $cliente = Cliente::where('correo', $request->usuario)->first();

        if ($cliente && Hash::check($request->contrasena, $cliente->clave)) {
            Auth::login($cliente);
            $request->session()->regenerate();

            return redirect()->route('home')
                ->with('status', 'Bienvenido(a) ' . $cliente->nombre);
        }

        // 2. LOGIN EMPLEADO
        $empleado = Empleado::where('correo', $request->usuario)->first();

        if ($empleado && $request->contrasena == $empleado->dni) {
            session([
                'id_usuario'   => $empleado->id_empleado,
                'nombre'       => $empleado->nombres,
                'tipo_usuario' => 'empleado',
                'cargo'        => $empleado->cargo,
            ]);

            return redirect()->route('dashboard')
                ->with('status', 'Bienvenido al sistema interno: ' . $empleado->nombres);
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

    // --- FUNCIÓN DE REGISTRO MODIFICADA ---
    public function register(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:50',
            'correo'   => 'required|email|max:100|unique:clientes,correo',
            'clave'    => 'required|string|min:6', 
            'telefono' => 'nullable|string|max:9',
        ]);

        $cliente = Cliente::create([
            'nombre'         => $request->nombre,
            'correo'         => $request->correo,
            'clave'          => Hash::make($request->clave), 
            'telefono'       => $request->telefono,
            'direccion'      => $request->direccion ?? null,
            'fecha_registro' => now(),
            'estado'         => 'activo',
        ]);

        // --- ENVIAR CORREO DE BIENVENIDA ---
        try {
            Mail::to($cliente->correo)->send(new WelcomeMail($cliente));
        } catch (\Exception $e) {
            // Si falla el correo (ej. mala config .env), no detenemos el registro
            // Solo lo registramos en el log para no asustar al usuario
            \Log::error('Error enviando correo de bienvenida: ' . $e->getMessage());
        }

        Auth::login($cliente);

        return redirect()->route('home')
            ->with('success', 'Registro completado. ¡Bienvenida a Jelou Moda! Te hemos enviado un correo.');
    }

    public function showResetForm()
    {
        return view('home.recuperar');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'correo'          => 'required|email',
            'clave'           => 'required|string|min:6',
            'confirmar_clave' => 'required|same:clave', 
        ], [
            'confirmar_clave.same' => 'Las contraseñas no coinciden.',
        ]);

        $cliente = Cliente::where('correo', $request->correo)->first();

        if ($cliente) {
            $cliente->clave = Hash::make($request->clave);
            $cliente->save();
            return redirect()->route('login')->with('status', 'Contraseña actualizada correctamente.');
        }

        return back()->with('error', 'Correo no encontrado.');
    }
}