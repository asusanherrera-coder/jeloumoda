<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamo extends Model
{
    protected $table = 'reclamos';
    protected $primaryKey = 'id_reclamo';
    public $timestamps = false;

    protected $fillable = [
        'tipo_documento',
        'num_documento',
        'nombre',
        'apellido',
        'direccion',
        'departamento',
        'provincia',
        'distrito',
        'telefono',
        'email',
        'monto',
        'descripcion',
        'tipo_reclamo',
        'detalle_reclamo',
        'pedido',
        'fecha_reclamo',
    ];
}