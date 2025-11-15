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
            $table->string('codigo', 10)->unique()->nullable();
            $table->foreignId('contrato_id')->constrained('tbl_contrato')->onDelete('cascade');
            $table->foreignId('proyecto_id')->nullable()->constrained('tbl_proyecto')->onDelete('set null');
            $table->date('fecha_emision')->default(now());
            $table->decimal('monto_total', 12, 2);
            $table->string('estado', 50);
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
