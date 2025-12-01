<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function index()
    {
       
        $clientes = Cliente::orderByDesc('fecha_registro')->paginate(10);

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:50',
            'correo'   => 'required|email|max:100|unique:clientes,correo',
            'clave'    => 'required|string|min:6',
            'telefono' => 'nullable|string|max:20',
            'direccion'=> 'nullable|string|max:100',
            'estado'   => 'required|in:activo,inactivo',
        ]);

        Cliente::create([
            'nombre'         => $request->nombre,
            'correo'         => $request->correo,
            'clave'          => Hash::make($request->clave), 
            'telefono'       => $request->telefono,
            'direccion'      => $request->direccion,
            'fecha_registro' => now(),
            'estado'         => $request->estado,
        ]);

        return redirect()
            ->route('clientes.index')
            ->with('status', 'Cliente creado correctamente.');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre'   => 'required|string|max:50',
            'correo'   => 'required|email|max:100|unique:clientes,correo,' . $cliente->id_cliente . ',id_cliente',
            'clave'    => 'nullable|string|min:6',
            'telefono' => 'nullable|string|max:20',
            'direccion'=> 'nullable|string|max:100',
            'estado'   => 'required|in:activo,inactivo',
        ]);

        $data = [
            'nombre'    => $request->nombre,
            'correo'    => $request->correo,
            'telefono'  => $request->telefono,
            'direccion' => $request->direccion,
            'estado'    => $request->estado,
        ];

        if ($request->filled('clave')) {
            $data['clave'] = Hash::make($request->clave);
        }

        $cliente->update($data);

        return redirect()
            ->route('clientes.index')
            ->with('status', 'Cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()
            ->route('clientes.index')
            ->with('status', 'Cliente eliminado correctamente.');
    }
}
