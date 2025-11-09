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
        Schema::create('tbl_equipo_operativo_detalle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipo_operativo_id');
            $table->unsignedBigInteger('empleado_id');
            $table->timestamps();

            $table->foreign('equipo_operativo_id')->references('id')->on('tbl_equipo_operativo')->onDelete('cascade');
            $table->foreign('empleado_id')->references('id')->on('tbl_empleado')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_equipo_operativo_detalle');
    }
};
