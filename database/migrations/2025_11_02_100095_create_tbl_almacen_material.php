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
        Schema::create('tbl_almacen_material', function (Blueprint $table) {
            $table->id();
            $table->foreignId('almacen_id')->constrained('tbl_almacen')->onDelete('cascade');
            $table->foreignId('proyecto_id')->nullable()->constrained('tbl_proyecto')->onDelete('set null');
            $table->foreignId('material_id')->constrained('tbl_material')->onDelete('cascade');
            $table->decimal('stock', 12, 2)->default(0);
            $table->decimal('stock_minimo', 12, 2)->default(0);
            $table->decimal('stock_maximo', 12, 2)->default(0);
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
