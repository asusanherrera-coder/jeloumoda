<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; // Importante para Auth::id()

class CarritoController extends Controller
{
    // ... (Tus funciones index, add, updateQuantity, remove, clear se mantienen IGUALES) ...
    
    public function index() {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(function ($item) { return $item['precio'] * $item['cantidad']; });
        return view('carrito.index', compact('cart', 'total'));
    }

    public function add(Request $request) {
        // ... (Tu código existente) ...
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
            $producto = Catalogo::find($id);
            if (!$producto) return redirect()->back()->with('error', 'Producto no existe.');
            $cart[$id] = [
                "id" => $id, "nombre" => $producto->nombre,
                "precio" => $producto->precio, "imagen" => $producto->imagen,
                "cantidad" => $cantidad
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

    // --- FUNCIÓN ACTUALIZADA Y CORREGIDA ---
    public function procesarCompra(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }

        // 1. Validación: Solo Yape/Plin y la IMAGEN OBLIGATORIA
        $request->validate([
            'metodo_pago' => 'required|in:plin,yape',
            'comprobante' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        $total = collect($cart)->sum(function ($item) {
            return $item['precio'] * $item['cantidad'];
        });

        // 2. Guardar la imagen en la carpeta pública
        $nombreArchivo = null;
        if ($request->hasFile('comprobante')) {
            $imagen = $request->file('comprobante');
            // Nombre único: tiempo + nombre original
            $nombreArchivo = time() . '_' . $imagen->getClientOriginalName();
            
            $imagen->move(public_path('IMG/comprobantes'), $nombreArchivo);
        }

        // 3. Crear Compra en la BD (Sin campos de tarjeta)
        $compra = Compra::create([
            'transaction_id'     => 'TRANS-' . Str::random(12),
            'metodo_pago'        => $request->metodo_pago,
            'monto_total'        => $total,
            'estado_pago'        => 'pendiente', // Nace pendiente hasta que revises la foto
            'datos_carrito'      => json_encode($cart),
            'fecha_compra'       => now(),
            
            // Usamos 'id_usuario' como aparece en tu imagen #11
            'id_usuario'         => Auth::check() ? Auth::user()->id_cliente : session('id_usuario'),
            
            // Campo NUEVO que debes agregar a la BD
            'imagen_comprobante' => $nombreArchivo, 
        ]);

        // Vaciar carrito
        session()->forget('cart');

        // Redirigir al recibo
        // CORRECCIÓN AQUI:
        // 1. Cambiamos 'perfil.recibo' por 'perfil.detalle' (que es como se llama en web.php)
        // 2. Cambiamos transaction_id por id_compra (porque tu PerfilController busca por ID numérico)
        return redirect()->route('perfil.detalle', $compra->id_compra) 
            ->with('status', '¡Compra registrada! Estamos verificando tu pago.');
    }
}