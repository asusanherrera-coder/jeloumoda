<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catalogo', function (Blueprint $table) {
            $table->increments('id_producto');           // int(11) PK
            $table->string('nombre', 100);               // varchar(100)
            $table->string('categoria', 50);             // varchar(50)
            $table->decimal('precio', 10, 2);            // decimal(10,2)
            $table->unsignedInteger('id_talla');         // int(11)
            $table->text('descripcion');                 // text
            $table->integer('stock');                    // int(11)
            $table->string('imagen', 255);               // varchar(255)
            $table->string('estado', 10);                // varchar(10)
            $table->dateTime('fecha_agregado');          // datetime

            // FK opcional (si quieres que MySQL lo valide)
            $table->foreign('id_talla')
                  ->references('id_talla')->on('talla');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catalogo');
    }
};
