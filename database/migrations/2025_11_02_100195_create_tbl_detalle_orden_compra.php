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
        Schema::create('tbl_detalle_orden_compra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orden_id');
            $table->unsignedBigInteger('material_id');
            $table->decimal('cantidad', 12, 2);
            $table->decimal('precio_unitario', 12, 2);
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();

            $table->foreign('orden_id')->references('id')->on('tbl_orden_compra')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('tbl_material')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_detalle_orden_compra');
    }
};
