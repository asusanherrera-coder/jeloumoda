<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacto', function (Blueprint $table) {
            $table->increments('id_contacto');             // int(11) PK
            $table->string('nombre', 255);
            $table->string('correo', 255);
            $table->integer('telefono');                   // int(11)
            $table->string('tipo', 255);
            $table->string('mensaje', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacto');
    }
};
