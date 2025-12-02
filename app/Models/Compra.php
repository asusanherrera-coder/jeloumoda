<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compras';
    protected $primaryKey = 'id_compra';

    // --- ESTO SOLUCIONA EL ERROR SQL ---
    public $timestamps = false; 

    protected $fillable = [
        'transaction_id',
        'metodo_pago',
        'monto_total',
        'estado_pago',
        'datos_carrito',
        'fecha_compra',
        'id_usuario', // O 'id_cliente' según tu base de datos
        'imagen_comprobante',
    ];

    // Relación con Cliente
    public function cliente()
    {
        // Ajusta las claves si es necesario
        return $this->belongsTo(Cliente::class, 'id_usuario', 'id_cliente');
    }
}