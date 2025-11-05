<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_ruta_transporte', function (Blueprint $table) {
            $table->id();
            $table->string('origen', 150);
            $table->string('destino', 150);
            $table->decimal('distancia_km', 8, 2);
            $table->time('tiempo_estimado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ruta_transporte');
    }
};
