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
        Schema::create('tbl_contrato_pago', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 10)->unique()->nullable();
            $table->foreignId('contrato_id')->constrained('tbl_contrato')->onDelete('cascade');
            $table->decimal('monto', 12, 2);
            $table->date('fecha_pago');
            $table->string('medio_pago', 50)->default('Efectivo');
            $table->string('estado', 50)->default('Registrado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_contrato_pago');
    }
};
