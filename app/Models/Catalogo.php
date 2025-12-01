<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Talla;   

class Catalogo extends Model
{
    protected $table = 'catalogo';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'categoria',
        'precio',
        'id_talla',
        'descripcion',
        'stock',
        'imagen',
        'estado',
        'fecha_agregado',
    ];

    public function talla()
    {
        return $this->belongsTo(Talla::class, 'id_talla', 'id_talla');
    }
}
