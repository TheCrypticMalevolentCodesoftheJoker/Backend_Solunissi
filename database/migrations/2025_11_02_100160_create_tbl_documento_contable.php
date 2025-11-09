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
        Schema::create('tbl_documento_contable', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 50);
            $table->string('numero', 50)->unique();
            $table->date('fecha_emision');
            $table->decimal('monto', 12, 2)->default(0);
            $table->unsignedBigInteger('transaccion_id');
            $table->unsignedBigInteger('proveedor_cliente_id')->nullable();
            $table->timestamps();

            $table->foreign('transaccion_id')->references('id')->on('tbl_transaccion_contable')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_documento_contable');
    }
};
