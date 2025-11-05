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
            $table->date('fecha');
            $table->string('tipo', 50);
            $table->text('descripcion')->nullable();
            $table->decimal('monto_total', 12, 2)->default(0);
            $table->unsignedBigInteger('proyecto_id')->nullable();
            $table->unsignedBigInteger('centro_costo_id')->nullable();
            $table->string('referencia_tipo', 100)->nullable();
            $table->unsignedBigInteger('referencia_id')->nullable();
            $table->string('estado', 50)->default('Pendiente');
            $table->timestamps();

            $table->foreign('proyecto_id')->references('id')->on('tbl_proyecto')->onDelete('set null');
            $table->foreign('centro_costo_id')->references('id')->on('tbl_centro_costo')->onDelete('set null');
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
