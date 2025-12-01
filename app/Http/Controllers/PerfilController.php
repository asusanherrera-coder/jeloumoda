<?php

namespace App\Http\Controllers;

use App\Models\Compra;

class PerfilController extends Controller
{
 
    public function recibo(string $transactionId)
    {
   
        $compra = Compra::where('transaction_id', $transactionId)->firstOrFail();

      
        $items = json_decode($compra->datos_carrito, true) ?? [];

        return view('perfil.recibo', [
            'transactionId' => $transactionId,
            'compra'        => $compra,
            'items'         => $items,
        ]);
    }
}
