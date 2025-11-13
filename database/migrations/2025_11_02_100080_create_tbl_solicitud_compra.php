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
        Schema::create('tbl_solicitud_compra', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 10)->unique()->nullable();
            $table->unsignedBigInteger('proyecto_id');
            $table->unsignedBigInteger('supervisor_id');
            $table->date('fecha_solicitud');
            $table->string('estado', 50);

            $table->foreign('proyecto_id')->references('id')->on('tbl_proyecto')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('id')->on('tbl_empleado')->onDelete('cascade');
        });
        Schema::create('tbl_solicitud_compra_detalle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('solicitud_compra_id');
            $table->unsignedBigInteger('material_id');
            $table->string('unidad_medida', 50);
            $table->decimal('cantidad', 10, 2);

            $table->foreign('solicitud_compra_id')->references('id')->on('tbl_solicitud_compra')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('tbl_material')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_solicitud_compra_detalle');
        Schema::dropIfExists('tbl_solicitud_compra');
    }
};
