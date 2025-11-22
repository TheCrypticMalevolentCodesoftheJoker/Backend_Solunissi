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
        Schema::create('tbl_cotizacion', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->unique()->nullable();
            $table->foreignId('solicitud_compra_id')->constrained('tbl_solicitud_compra')->onDelete('cascade');
            $table->foreignId('proveedor_id')->constrained('tbl_proveedor')->onDelete('cascade');
            $table->date('fecha_cotizacion');
            $table->decimal('tiempo_entrega_dias', 5, 2)->nullable();
            $table->decimal('costo_envio', 12, 2)->nullable();
            $table->decimal('descuento', 12, 2)->nullable();
            $table->decimal('total', 12, 2)->nullable();
            $table->string('estado', 50);
        });

        Schema::create('tbl_cotizacion_detalle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cotizacion_id')->constrained('tbl_cotizacion')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('tbl_material')->onDelete('cascade');
            $table->decimal('cantidad', 10, 2);
            $table->decimal('precio_unitario', 12, 2);
            $table->decimal('subtotal', 12, 2);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cotizacion_detalle');
        Schema::dropIfExists('tbl_cotizacion');
    }
};
