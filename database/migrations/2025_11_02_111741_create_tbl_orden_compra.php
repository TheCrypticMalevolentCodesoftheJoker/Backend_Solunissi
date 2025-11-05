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
            $table->unsignedBigInteger('cotizacion_id');
            $table->string('numero', 50)->unique();
            $table->date('fecha_emision');
            $table->string('estado', 50)->default('Pendiente');
            $table->unsignedBigInteger('transaccion_id');
            $table->timestamps();

            $table->foreign('cotizacion_id')->references('id')->on('tbl_cotizacion')->onDelete('cascade');
            $table->foreign('transaccion_id')->references('id')->on('tbl_transaccion_contable')->onDelete('cascade');
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
