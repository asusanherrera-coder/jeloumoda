<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable
{
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'correo',
        'clave',
        'telefono',
        'direccion',
        'fecha_registro',
        'estado',
    ];

    // Laravel busca automáticamente 'password', así que lo renombramos virtualmente
    public function getAuthPassword()
    {
        return $this->clave;
    }
}
