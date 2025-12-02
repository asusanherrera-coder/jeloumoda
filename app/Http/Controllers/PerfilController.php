<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Compra;
use App\Models\Cliente;

class PerfilController extends Controller
{
    public function index()
    {
        $cliente = Auth::user();

        // Obtener historial de compras
        // CORRECCIÓN: Usamos 'id_usuario' que es lo que tienes en tu BD
        $compras = Compra::where('id_usuario', $cliente->id_cliente)
                         ->orderBy('fecha_compra', 'desc')
                         ->get();

        return view('perfil.index', compact('cliente', 'compras'));
    }

    public function update(Request $request)
    {
        $cliente = Auth::user();
        $clienteDB = Cliente::find($cliente->id_cliente);

        $request->validate([
            'nombre'    => 'required|string|max:50',
            'telefono'  => 'nullable|string|max:9',
            'direccion' => 'nullable|string|max:100',
            'clave_nueva' => 'nullable|string|min:6',
        ]);

        $clienteDB->nombre = $request->nombre;
        $clienteDB->telefono = $request->telefono;
        $clienteDB->direccion = $request->direccion;

        if ($request->filled('clave_nueva')) {
            $clienteDB->clave = Hash::make($request->clave_nueva);
        }

        $clienteDB->save();

        return back()->with('success', 'Perfil actualizado correctamente.');
    }

    public function detalleCompra($id)
    {
        // 1. Buscamos la compra
        $compra = Compra::where('id_compra', $id)
                        ->where('id_usuario', Auth::user()->id_cliente)
                        ->firstOrFail();

        $transactionId = $compra->transaction_id; // Usamos el real de la BD

        // 2. CORRECCIÓN IMPORTANTE: Leemos 'datos_carrito' en lugar de 'detalle_compra'
        $items = [];
        if (!empty($compra->datos_carrito)) {
            $items = is_string($compra->datos_carrito) ? json_decode($compra->datos_carrito, true) : $compra->datos_carrito;
        }

        return view('perfil.recibo', compact('compra', 'transactionId', 'items'));
    }
}