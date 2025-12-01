<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reclamos', function (Blueprint $table) {
            $table->increments('id_reclamo');             // int(11) PK
            $table->string('tipo_documento', 50);
            $table->integer('num_documento');             // int(11)
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('direccion', 100);
            $table->string('departamento', 20);
            $table->string('provincia', 50);
            $table->string('distrito', 50);
            $table->integer('telefono');                  // int(11)
            $table->string('email', 50);
            $table->decimal('monto', 10, 0);              // decimal(10,0)
            $table->string('descripcion', 255);
            $table->string('tipo_reclamo', 255);
            $table->string('detalle_reclamo', 255);
            $table->string('pedido', 255);
            $table->date('fecha_reclamo');                // date
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reclamos');
    }
};
