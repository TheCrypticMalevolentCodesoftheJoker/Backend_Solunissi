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
        Schema::create('tbl_movimiento_inventario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('almacen_id');
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('proyecto_id')->nullable();
            $table->string('tipo', 50);
            $table->decimal('cantidad', 12, 2);
            $table->string('referencia_tipo', 100)->nullable();
            $table->unsignedBigInteger('referencia_id')->nullable();
            $table->date('fecha_movimiento');
            $table->timestamps();

            $table->foreign('almacen_id')->references('id')->on('tbl_almacen')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('tbl_material')->onDelete('cascade');
            $table->foreign('proyecto_id')->references('id')->on('tbl_proyecto')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_movimiento_inventario');
    }
};
