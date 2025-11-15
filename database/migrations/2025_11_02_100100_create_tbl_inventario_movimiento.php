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
        Schema::create('tbl_inventario_movimiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('almacen_origen_id')->nullable()->constrained('tbl_almacen')->onDelete('set null');
            $table->foreignId('almacen_destino_id')->nullable()->constrained('tbl_almacen')->onDelete('set null');
            $table->foreignId('proyecto_id')->nullable()->constrained('tbl_proyecto')->onDelete('set null');
            $table->string('tipo', 50);
            $table->dateTime('fecha_movimiento')->default(now());
        });
        Schema::create('tbl_inventario_movimiento_detalle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventario_movimiento_id')->constrained('tbl_inventario_movimiento')->onDelete('cascade')->name('fk_inv_mov_detalle_mov');
            $table->foreignId('material_id')->constrained('tbl_material')->onDelete('cascade');
            $table->decimal('cantidad', 12, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_inventario_movimiento_detalle');
        Schema::dropIfExists('tbl_inventario_movimiento');
    }
};
