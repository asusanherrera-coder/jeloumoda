<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    protected $table = 'talla';
    protected $primaryKey = 'id_talla';
    public $timestamps = false;

    protected $fillable = [
        'nombre_talla',
    ];

    public function productos()
    {
        return $this->hasMany(Catalogo::class, 'id_talla', 'id_talla');
    }
}