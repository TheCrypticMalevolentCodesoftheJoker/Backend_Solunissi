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
        Schema::create('tbl_transaccion_contable', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_registro');
            $table->unsignedBigInteger('proyecto_id')->nullable();
            $table->unsignedBigInteger('tipo_transaccion_contable_id');
            $table->unsignedBigInteger('centro_costo_id');
            $table->decimal('monto_total', 12, 2)->default(0);
            $table->string('modulo_origen', 100)->nullable();
            $table->string('referencia_id', 20)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('estado', 50)->default('Pendiente');
            $table->timestamps();

            $table->foreign('proyecto_id')->references('id')->on('tbl_proyecto')->onDelete('set null');
            $table->foreign('tipo_transaccion_contable_id')->references('id')->on('tbl_tipo_transaccion_contable')->onDelete('cascade');
            $table->foreign('centro_costo_id')->references('id')->on('tbl_centro_costo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_transaccion_contable');
    }
};
