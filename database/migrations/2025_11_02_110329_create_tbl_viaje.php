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
        Schema::create('tbl_viaje', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehiculo_id');
            $table->unsignedBigInteger('ruta_id');
            $table->dateTime('fecha_salida');
            $table->dateTime('fecha_llegada')->nullable();
            $table->unsignedBigInteger('conductor_id');
            $table->unsignedBigInteger('proyecto_id')->nullable();
            $table->timestamps();

            $table->foreign('vehiculo_id')->references('id')->on('tbl_vehiculo')->onDelete('cascade');
            $table->foreign('ruta_id')->references('id')->on('tbl_ruta_transporte')->onDelete('cascade');
            $table->foreign('conductor_id')->references('id')->on('tbl_empleado')->onDelete('cascade');
            $table->foreign('proyecto_id')->references('id')->on('tbl_proyecto')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_viaje');
    }
};
