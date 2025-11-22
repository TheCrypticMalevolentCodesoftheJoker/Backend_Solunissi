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
        Schema::create('tbl_s_m_pendiente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitud_material_id')->constrained('tbl_solicitud_material')->onDelete('cascade');
            $table->foreignId('proyecto_id')->constrained('tbl_proyecto')->onDelete('cascade');
            $table->dateTime('fecha');
            $table->string('estado', 50)->default('Pendiente');
        });

        Schema::create('tbl_s_m_pendiente_detalle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('s_m_pendiente_id')->constrained('tbl_s_m_pendiente')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('tbl_material')->onDelete('cascade');
            $table->decimal('cantidad', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_s_m_pendiente_detalle');
        Schema::dropIfExists('tbl_s_m_pendiente');
    }
};
