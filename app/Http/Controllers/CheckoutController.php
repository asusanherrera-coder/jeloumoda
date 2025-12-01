<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        // Asegurar que el usuario esté logueado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para continuar.');
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('catalogo.index')
                ->with('error', 'Tu carrito está vacío.');
        }

        return view('checkout.index', compact('cart'));
    }

    public function procesar(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para procesar la compra.');
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('catalogo.index');
        }

        $montoTotal = 0;
        foreach ($cart as $item) {
            $montoTotal += $item['precio'] * $item['cantidad'];
        }

        $transactionId = 'TRANS-' . Str::random(12);

        Compra::create([
            'transaction_id' => $transactionId,
            'metodo_pago'    => $request->input('metodo_pago', 'plin'),
            'monto_total'    => $montoTotal,
            'estado_pago'    => 'completado',
            'datos_carrito'  => json_encode($cart),
            'fecha_compra'   => now(),
            'id_usuario'     => Auth::id(),  // ← CORREGIDO
        ]);

        session()->forget('cart');

        return redirect()->route('home')
            ->with('success', 'Compra realizada correctamente. ID: ' . $transactionId);
    }
}
