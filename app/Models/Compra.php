<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';
    protected $primaryKey = 'id_compra';
    public $timestamps = false;

    protected $fillable = [
        'transaction_id',
        'metodo_pago',
        'monto_total',
        'estado_pago',
        'datos_carrito',
        'fecha_compra',
        'numero_tarjeta_ultimos_4',
        'nombre_tarjeta',
        'fecha_vencimiento',
        'id_usuario',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_usuario', 'id_cliente');
    }
}