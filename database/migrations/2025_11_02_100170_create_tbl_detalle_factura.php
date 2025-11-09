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
        Schema::create('tbl_detalle_factura', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('factura_id');
            $table->text('descripcion');
            $table->decimal('cantidad', 12, 2);
            $table->decimal('precio_unitario', 12, 2);
            $table->timestamps();

            $table->foreign('factura_id')->references('id')->on('tbl_factura')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_detalle_factura');
    }
};
