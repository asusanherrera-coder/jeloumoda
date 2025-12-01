<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::orderBy('id_empleado', 'desc')->paginate(10);

        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni'           => 'required|digits:8|unique:empleados,dni',
            'nombres'       => 'required|string|max:100',
            'telefono'      => 'nullable|digits_between:7,9',
            'correo'        => 'required|email|max:100|unique:empleados,correo',
            'cargo'         => 'required|string|max:50',
            'direccion'     => 'nullable|string|max:150',
            'fecha_ingreso' => 'required|date',
            'estado'        => 'required|in:activo,inactivo',
        ]);

        Empleado::create($request->all());

        return redirect()->route('empleados.index')
            ->with('status', 'Empleado registrado correctamente.');
    }

    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'dni'           => 'required|digits:8|unique:empleados,dni,' . $empleado->id_empleado . ',id_empleado',
            'nombres'       => 'required|string|max:100',
            'telefono'      => 'nullable|digits_between:7,9',
            'correo'        => 'required|email|max:100|unique:empleados,correo,' . $empleado->id_empleado . ',id_empleado',
            'cargo'         => 'required|string|max:50',
            'direccion'     => 'nullable|string|max:150',
            'fecha_ingreso' => 'required|date',
            'estado'        => 'required|in:activo,inactivo',
        ]);

        $empleado->update($request->all());

        return redirect()->route('empleados.index')
            ->with('status', 'Empleado actualizado correctamente.');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()->route('empleados.index')
            ->with('status', 'Empleado eliminado correctamente.');
    }
}
