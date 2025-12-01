<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('talla', function (Blueprint $table) {
            $table->increments('id_talla');              // int(11) PK
            $table->string('nombre_talla', 10);          // varchar(10) NOT NULL
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('talla');
    }
};
