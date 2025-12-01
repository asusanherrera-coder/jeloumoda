<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id_empleado');            // int(11) PK
            $table->string('dni', 8);
            $table->string('nombres', 100);
            $table->integer('telefono');                  // int(9)
            $table->string('correo', 100);
            $table->string('cargo', 50);
            $table->string('direccion', 150);
            $table->date('fecha_ingreso');                // date
            $table->string('estado', 10);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
