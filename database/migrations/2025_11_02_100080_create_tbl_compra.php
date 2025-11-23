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
        Schema::create('tbl_compra', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->unique()->nullable();
            $table->foreignId('soli_mat_id')->constrained('tbl_soli_mat')->onDelete('cascade');
            $table->foreignId('proyecto_id')->constrained('tbl_proyecto')->onDelete('cascade');
            $table->date('fecha_solicitud');
            $table->string('estado', 50);
        });

        Schema::create('tbl_compra_detalle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compra_id')->constrained('tbl_compra')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('tbl_material')->onDelete('cascade');
            $table->decimal('cantidad', 12, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_compra_detalle');
        Schema::dropIfExists('tbl_compra');
    }
};
