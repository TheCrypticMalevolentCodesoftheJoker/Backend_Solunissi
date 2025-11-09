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
        Schema::create('tbl_pago', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('factura_id');
            $table->date('fecha_pago');
            $table->decimal('monto', 12, 2);
            $table->string('metodo_pago', 50);
            $table->unsignedBigInteger('transaccion_id')->nullable();
            $table->timestamps();

            $table->foreign('factura_id')->references('id')->on('tbl_factura')->onDelete('cascade');
            $table->foreign('transaccion_id')->references('id')->on('tbl_transaccion_contable')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pago');
    }
};
