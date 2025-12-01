<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id_cliente');           // int(11) PK
            $table->string('nombre', 50);               // varchar(50)
            $table->string('correo', 100);              // varchar(100)
            $table->string('clave', 255);               // varchar(255)
            $table->string('telefono', 9);              // varchar(9)
            $table->string('direccion', 100);           // varchar(100)
            $table->dateTime('fecha_registro');         // datetime
            $table->string('estado', 10);               // varchar(10)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
