<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Cliente extends Authenticatable
{
    use Notifiable;

    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';

    // --- CORRECCIÓN CRÍTICA ---
    // Esto soluciona el error "Unknown column updated_at".
    // Le decimos a Laravel que NO intente llenar created_at ni updated_at automáticamente.
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

    protected $hidden = [
        'clave',
    ];

    public function getAuthPassword()
    {
        return $this->clave;
    }
}