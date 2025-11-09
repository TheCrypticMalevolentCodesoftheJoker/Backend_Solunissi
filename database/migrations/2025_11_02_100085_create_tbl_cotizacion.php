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
            $table->unsignedBigInteger('solicitud_id');
            $table->unsignedBigInteger('proveedor_id');
            $table->unsignedBigInteger('proyecto_id');
            $table->date('fecha_cotizacion');
            $table->string('estado', 50)->default('Pendiente');
            $table->text('observacion')->nullable();
            $table->timestamps();

            $table->foreign('solicitud_id')->references('id')->on('tbl_solicitud_compra')->onDelete('cascade');
            $table->foreign('proveedor_id')->references('id')->on('tbl_proveedor')->onDelete('cascade');
            $table->foreign('proyecto_id')->references('id')->on('tbl_proyecto')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cotizacion');
    }
};
