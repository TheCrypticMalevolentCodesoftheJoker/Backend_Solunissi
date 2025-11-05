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
        Schema::create('tbl_cuadrilla_detalle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cuadrilla_id');
            $table->unsignedBigInteger('empleado_id');
            $table->timestamps();

            $table->foreign('cuadrilla_id')->references('id')->on('tbl_cuadrilla')->onDelete('cascade');
            $table->foreign('empleado_id')->references('id')->on('tbl_empleado')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cuadrilla_detalle');
    }
};
