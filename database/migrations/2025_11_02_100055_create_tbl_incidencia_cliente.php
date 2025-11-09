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
        Schema::create('tbl_incidencia_cliente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->string('tipo', 100);
            $table->text('descripcion');
            $table->date('fecha_reporte');
            $table->string('estado', 50)->default('Pendiente');
            $table->unsignedBigInteger('proyecto_id')->nullable();
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('tbl_cliente')->onDelete('cascade');
            $table->foreign('proyecto_id')->references('id')->on('tbl_proyecto')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_incidencia_cliente');
    }
};
