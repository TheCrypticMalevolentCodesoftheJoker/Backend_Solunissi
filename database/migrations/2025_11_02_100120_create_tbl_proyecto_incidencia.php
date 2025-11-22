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
        Schema::create('tbl_proyecto_incidencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained('tbl_proyecto')->onDelete('cascade');
            $table->text('descripcion');
            $table->date('fecha_reporte')->default(now());
            $table->string('estado', 50)->default('Pendiente');
        });
        Schema::create('tbl_proyecto_incidencia_detalle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incidencia_id')->constrained('tbl_proyecto_incidencia')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('tbl_material')->onDelete('cascade');
            $table->decimal('cantidad', 12, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_proyecto_incidencia_detalle');
        Schema::dropIfExists('tbl_proyecto_incidencia');
    }
};
