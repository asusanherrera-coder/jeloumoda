<?php

namespace App\Models;

// Importante: Cambiar de Model a Authenticatable
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Cliente extends Authenticatable
{
    use Notifiable;

    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente'; // Asegúrate que este sea tu ID

    protected $fillable = [
        'nombre',
        'correo',
        'clave',
        'telefono',
        'direccion',
        'fecha_registro',
        'estado',
    ];

    // Ocultar la clave para que no aparezca en respuestas JSON
    protected $hidden = [
        'clave',
    ];

    // ESTO ES CRUCIAL:
    // Le decimos a Laravel que la contraseña está en la columna 'clave'
    public function getAuthPassword()
    {
        return $this->clave;
    }
}