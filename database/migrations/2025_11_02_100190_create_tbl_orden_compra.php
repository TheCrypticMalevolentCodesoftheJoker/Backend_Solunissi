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
        Schema::create('tbl_orden_compra', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->unique()->nullable();
            $table->foreignId('cotizacion_id')->constrained('tbl_cotizacion')->cascadeOnDelete();
            $table->decimal('total_orden_compra', 12, 2)->default(0);
            $table->date('fecha_emision');
            $table->string('estado', 50)->default('Pendiente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_orden_compra');
    }
};
