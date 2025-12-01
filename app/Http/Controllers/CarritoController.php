<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CarritoController extends Controller
{
    public function index()
{
    // 🛑 ¡ELIMINA ESTA LÍNEA!
    // session()->forget('cart'); 

    $cart = session()->get('cart', []);
    
    // Asegúrate de que el cálculo del total esté correcto
    $total = collect($cart)->sum(function ($item) {
        // Esta línea ahora funcionará correctamente porque el método add
        // ya asegura que el array $item tenga la clave 'precio'
        return $item['precio'] * $item['cantidad']; 
    });

    return view('carrito.index', compact('cart', 'total'));
}

    public function add(Request $request)
    {
        // 1. Validación (ya tienes esto)
        $request->validate([
            'id_producto_variacion' => 'required|integer',
            'cantidad' => 'required|integer|min:1',
            'accion' => 'required|string|in:carrito,comprar'
        ]);

        $id = $request->input('id_producto_variacion'); // ID de la variación/talla
        $cantidad = $request->input('cantidad');
        $accion = $request->input('accion');
        
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            // Producto ya existe, solo actualiza la cantidad
            $cart[$id]['cantidad'] += $cantidad;

        } else {
            // Producto NUEVO
            
            // 🛑 PASO CLAVE: OBTENER LOS DATOS DEL MODELO Catalogo
            // Asumiendo que el ID de la variación tiene los datos del precio e imagen
            $producto = Catalogo::find($id); 

            if (!$producto) {
                return redirect()->back()->with('error', 'El producto seleccionado no existe.');
            }

            // Crear el array del ítem completo para la sesión
            $cart[$id] = [
                "id" => $id, 
                "nombre" => $producto->nombre,
                "precio" => $producto->precio, // <-- ¡ASEGURAMOS ESTA CLAVE!
                "imagen" => $producto->imagen, // <-- ¡Y ESTA!
                "cantidad" => $cantidad
                // Puedes añadir la talla u otros detalles aquí
            ];
        }

        session()->put('cart', $cart);

        // ... Lógica de Redirección (comprar o carrito) ...
        if ($accion === 'comprar') {
            return redirect()->route('checkout.index'); 
        }

       return redirect()->back()->with('success', 'Producto añadido al carrito!');
    }

    public function updateQuantity(Request $request, Catalogo $producto)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$producto->id_producto])) {
            return back();
        }

        $cantidad = max(1, (int) $request->input('cantidad', 1));
        $cart[$producto->id_producto]['cantidad'] = $cantidad;

        session()->put('cart', $cart);

        return back()->with('success', 'Cantidad actualizada.');
    }

    public function remove(Catalogo $producto)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$producto->id_producto])) {
            unset($cart[$producto->id_producto]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Producto eliminado del carrito.');
    }

    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Carrito vaciado.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('carrito.index')
                ->with('error', 'Tu carrito está vacío.');
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
        return redirect()->route('carrito.index')
            ->with('error', 'Tu carrito está vacío.');
    }

    $request->validate([
        'metodo_pago' => 'required|in:plin,yape,tarjeta',
        'numero_tarjeta' => 'nullable|string|max:16',
        'nombre_tarjeta' => 'nullable|string|max:255',
        'fecha_vencimiento' => 'nullable|string|max:10',
    ]);

    $total = collect($cart)->sum(function ($item) {
        return $item['precio'] * $item['cantidad'];
    });

    $metodoPago = $request->metodo_pago;

    $compra = Compra::create([
        'transaction_id'            => 'TRANS-' . Str::random(12),
        'metodo_pago'               => $metodoPago,
        'monto_total'               => $total,
        'estado_pago'               => 'completado',
        'datos_carrito'             => json_encode($cart),
        'fecha_compra'              => now(),
        'numero_tarjeta_ultimos_4'  => $metodoPago === 'tarjeta'
                                        ? substr($request->numero_tarjeta, -4)
                                        : null,
        'nombre_tarjeta'            => $metodoPago === 'tarjeta'
                                        ? $request->nombre_tarjeta
                                        : null,
        'fecha_vencimiento'         => $metodoPago === 'tarjeta'
                                        ? $request->fecha_vencimiento
                                        : null,
        
        // ✔ CORRECCIÓN
        'id_usuario'                => session('id_usuario'),
    ]);

    session()->forget('cart');

    return redirect()->route('home')
        ->with('status', 'Compra realizada con éxito. Código: ' . $compra->transaction_id);
}

}
