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
        Schema::create('tbl_stock_almacen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('almacen_id');
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('proyecto_id')->nullable();
            $table->decimal('cantidad_disponible', 12, 2)->default(0);
            $table->decimal('cantidad_reservada', 12, 2)->default(0);
            $table->decimal('stock_minimo', 12, 2)->default(0);
            $table->decimal('stock_maximo', 12, 2)->nullable();
            $table->timestamp('ultima_actualizacion')->useCurrent();
            $table->boolean('estado')->default(true);
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
        Schema::dropIfExists('tbl_stock_almacen');
    }
};
