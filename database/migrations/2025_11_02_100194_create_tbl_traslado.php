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
        Schema::create('tbl_traslado', function (Blueprint $table) {
            $table->id();
            $table->foreignId('almacen_origen_id')->nullable()->constrained('tbl_almacen')->onDelete('set null');
            $table->foreignId('almacen_destino_id')->nullable()->constrained('tbl_almacen')->onDelete('set null');
            $table->foreignId('proyecto_id')->nullable()->constrained('tbl_proyecto')->onDelete('set null');
            $table->string('referencia', 20)->nullable();
            $table->string('origen_traslado', 100)->nullable();
            $table->dateTime('fecha_traslado')->nullable();
            $table->string('estado', 50)->nullable();

        });

        Schema::create('tbl_traslado_detalle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('traslado_id')->constrained('tbl_traslado')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('tbl_material')->onDelete('cascade');
            $table->decimal('cantidad', 12, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_traslado_detalle');
        Schema::dropIfExists('tbl_traslado');
    }
};
