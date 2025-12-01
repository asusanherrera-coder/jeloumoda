<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('home.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'usuario'     => 'required|email',
            'contrasena'  => 'required|string',
        ]);

        // ----------- LOGIN COMO CLIENTE -----------
        $cliente = Cliente::where('correo', $request->usuario)
            ->where('clave', $request->contrasena)
            ->first();

        if ($cliente) {
        auth()->login($cliente); // <-- ESTA ES LA CLAVE

        return redirect()->route('home')
            ->with('status', 'Bienvenido(a) ' . $cliente->nombre);
    }


        // ----------- LOGIN COMO EMPLEADO -----------
        $empleado = Empleado::where('correo', $request->usuario)
            ->where('dni', $request->contrasena)
            ->first();

        if ($empleado) {

            // Guardar sesión manual para empleados (si necesitas)
            session([
                'id_usuario'   => $empleado->id_empleado,
                'nombre'       => $empleado->nombres,
                'tipo_usuario' => 'empleado',
            ]);

            return redirect()->route('dashboard')
                ->with('status', 'Bienvenido(a) ' . $empleado->nombres);
        }

        return back()
            ->withInput()
            ->with('error', 'Correo electrónico o contraseña incorrectos.');
    }



    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }




    public function showRegisterForm()
    {
        return view('home.registro');
    }



    public function register(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:50',
            'correo'   => 'required|email|max:100|unique:clientes,correo',
            'clave'    => 'required|string|min:6|max:255',
            'telefono' => 'nullable|string|max:9',
            'direccion'=> 'nullable|string|max:100',
        ]);

        $cliente = Cliente::create([
            'nombre'         => $request->nombre,
            'correo'         => $request->correo,
            'clave'          => $request->clave, // si deseas, puedes encriptarla
            'telefono'       => $request->telefono,
            'direccion'      => $request->direccion,
            'fecha_registro' => now(),
            'estado'         => 'activo',
        ]);

        // Login automático después de registrarse
        Auth::login($cliente);

        return redirect()->route('home')
            ->with('success', 'Registro completado correctamente. ¡Bienvenida a Jelou Moda!');
    }


    public function showResetForm()
    {
        return view('home.recuperar');
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'correo'          => 'required|email',
            'clave'           => 'required|string|min:6|max:255',
            'confirmar_clave' => 'required|same:clave',
        ], [
            'confirmar_clave.same' => 'Las contraseñas no coinciden.',
        ]);

        $cliente = Cliente::where('correo', $request->correo)->first();

        if (!$cliente) {
            return back()
                ->withInput()
                ->with('error', 'No se encontró un usuario con ese correo.');
        }

        $cliente->clave = $request->clave;
        $cliente->save();

        return back()->with('status', 'Tu contraseña se actualizó correctamente.');
    }
}
