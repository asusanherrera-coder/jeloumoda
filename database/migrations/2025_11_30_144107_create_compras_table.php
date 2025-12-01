<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id_compra');                // int(11) PK
            $table->string('transaction_id', 255);          // varchar(255)
            $table->string('metodo_pago', 50);              // varchar(50)
            $table->decimal('monto_total', 10, 2);          // decimal(10,2)
            $table->string('estado_pago', 50)->default('completado');
            // Puedes usar json() directamente si tu MySQL lo soporta
            $table->json('datos_carrito');                  // longtext + CHECK json_valid
            $table->timestamp('fecha_compra')
                  ->useCurrent();                           // timestamp default current_timestamp
            $table->string('numero_tarjeta_ultimos_4', 4)->nullable();
            $table->string('nombre_tarjeta', 255)->nullable();
            $table->string('fecha_vencimiento', 10)->nullable();
            $table->unsignedInteger('id_usuario')->nullable(); // int(11) NULL

            // Si más adelante decides que id_usuario referencia a clientes.id_cliente:
            // $table->foreign('id_usuario')
            //       ->references('id_cliente')->on('clientes')
            //       ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
