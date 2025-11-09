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
        Schema::create('tbl_contrato', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->string('numero', 50)->unique();
            $table->date('fecha_firma');
            $table->decimal('monto_total', 12, 2);
            $table->string('estado', 50)->default('Activo');
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('tbl_cliente')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_contrato');
    }
};
