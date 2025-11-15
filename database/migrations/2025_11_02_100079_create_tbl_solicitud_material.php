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
        Schema::create('tbl_solicitud_material', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained('tbl_proyecto')->onDelete('cascade');
            $table->date('fecha_solicitud');
            $table->string('estado', 50);
        });
        Schema::create('tbl_solicitud_material_detalle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitud_material_id')->constrained('tbl_solicitud_material')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('tbl_material')->onDelete('cascade');
            $table->decimal('cantidad', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_solicitud_material_detalle');
        Schema::dropIfExists('tbl_solicitud_material');
    }
};
