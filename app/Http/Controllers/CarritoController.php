<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function index() {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(function ($item) { return $item['precio'] * $item['cantidad']; });
        return view('carrito.index', compact('cart', 'total'));
    }

    public function add(Request $request) {
        $request->validate([
            'id_producto_variacion' => 'required|integer',
            'cantidad' => 'required|integer|min:1',
            'accion' => 'required|string|in:carrito,comprar'
        ]);

        $id = $request->input('id_producto_variacion');
        $cantidad = $request->input('cantidad');
        $accion = $request->input('accion');
        
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['cantidad'] += $cantidad;
        } else {
            // Cargamos la relación 'talla' para obtener el nombre (S, M, L)
            $producto = Catalogo::with('talla')->find($id);

            if (!$producto) return redirect()->back()->with('error', 'Producto no existe.');

            // Obtenemos el nombre de la talla si existe la relación
            $nombreTalla = $producto->talla ? $producto->talla->nombre_talla : 'Única';

            $cart[$id] = [
                "id" => $id, 
                "nombre" => $producto->nombre,
                "precio" => $producto->precio, 
                "imagen" => $producto->imagen,
                "cantidad" => $cantidad,
                "talla" => $nombreTalla 
            ];
        }

        session()->put('cart', $cart);

        if ($accion === 'comprar') return redirect()->route('checkout.index');
        return redirect()->back()->with('success', 'Producto añadido!');
    }

    public function updateQuantity(Request $request, Catalogo $producto) {
        $cart = session()->get('cart', []);
        if (!isset($cart[$producto->id_producto])) return back();
        $cantidad = max(1, (int) $request->input('cantidad', 1));
        $cart[$producto->id_producto]['cantidad'] = $cantidad;
        session()->put('cart', $cart);
        return back()->with('success', 'Actualizado.');
    }

    public function remove(Catalogo $producto) {
        $cart = session()->get('cart', []);
        if (isset($cart[$producto->id_producto])) {
            unset($cart[$producto->id_producto]);
            session()->put('cart', $cart);
        }
        return back()->with('success', 'Eliminado.');
    }

    public function clear() {
        session()->forget('cart');
        return back()->with('success', 'Carrito vaciado.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }
        $total = collect($cart)->sum(function ($item) {
            return $item['precio'] * $item['cantidad'];
        });

        return view('checkout.index', compact('cart', 'total'));
    }

    public function procesarCompra(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }

        $request->validate([
            'metodo_pago' => 'required|in:plin,yape',
            'comprobante' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $total = collect($cart)->sum(function ($item) {
            return $item['precio'] * $item['cantidad'];
        });

        $nombreArchivo = null;
        if ($request->hasFile('comprobante')) {
            $imagen = $request->file('comprobante');
            $nombreArchivo = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('IMG/comprobantes'), $nombreArchivo);
        }

        $compra = Compra::create([
            'transaction_id'     => 'TRANS-' . Str::random(12),
            'metodo_pago'        => $request->metodo_pago,
            'monto_total'        => $total,
            'estado_pago'        => 'pendiente',
            'datos_carrito'      => json_encode($cart),
            'fecha_compra'       => now(),
            'id_usuario'         => Auth::check() ? Auth::user()->id_cliente : session('id_usuario'),
            'imagen_comprobante' => $nombreArchivo, 
        ]);

        session()->forget('cart');

        return redirect()->route('perfil.detalle', $compra->id_compra) 
            ->with('status', '¡Compra registrada! Estamos verificando tu pago.');
    }
}