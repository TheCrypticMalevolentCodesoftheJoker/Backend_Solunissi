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
        Schema::create('tbl_incidencia_inventario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('almacen_id');
            $table->string('tipo', 50);
            $table->decimal('cantidad', 12, 2);
            $table->text('descripcion')->nullable();
            $table->date('fecha_reporte');
            $table->unsignedBigInteger('aprobado_por_id')->nullable();
            $table->timestamps();

            $table->foreign('material_id')->references('id')->on('tbl_material')->onDelete('cascade');
            $table->foreign('almacen_id')->references('id')->on('tbl_almacen')->onDelete('cascade');
            $table->foreign('aprobado_por_id')->references('id')->on('tbl_empleado')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_incidencia_inventario');
    }
};
