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
        Schema::create('tbl_factura', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contrato_id');
            $table->string('numero', 50)->unique();
            $table->date('fecha_emision');
            $table->decimal('monto_total', 12, 2);
            $table->string('estado', 50)->default('Emitida');
            $table->unsignedBigInteger('transaccion_id')->nullable();
            $table->timestamps();

            $table->foreign('contrato_id')->references('id')->on('tbl_contrato')->onDelete('cascade');
            $table->foreign('transaccion_id')->references('id')->on('tbl_transaccion_contable')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_factura');
    }
};
