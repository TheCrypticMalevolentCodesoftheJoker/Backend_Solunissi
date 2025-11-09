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
        Schema::create('tbl_incidencia_produccion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id');
            $table->text('descripcion');
            $table->string('tipo', 50);
            $table->date('fecha_reporte');
            $table->unsignedBigInteger('responsable_id');
            $table->string('estado', 50)->default('Pendiente');
            $table->timestamps();

            $table->foreign('proyecto_id')->references('id')->on('tbl_proyecto')->onDelete('cascade');
            $table->foreign('responsable_id')->references('id')->on('tbl_empleado')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_incidencia_produccion');
    }
};
