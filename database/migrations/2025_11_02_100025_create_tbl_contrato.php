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
            $table->string('codigo', 10)->unique()->nullable();
            $table->foreignId('cliente_id')->constrained('tbl_cliente')->onDelete('cascade');
            $table->string('tipo_servicio', 100);
            $table->text('descripcion')->nullable();
            $table->date('fecha_firma');
            $table->date('fecha_vencimiento')->nullable();
            $table->decimal('monto_total', 12, 2);
            $table->string('estado', 50);
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
