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
        Schema::create('tbl_asistencia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipo_operativo_id');
            $table->unsignedBigInteger('proyecto_id');
            $table->unsignedBigInteger('supervisor_id');
            $table->date('fecha');

            $table->foreign('equipo_operativo_id')->references('id')->on('tbl_equipo_operativo')->onDelete('cascade');
            $table->foreign('proyecto_id')->references('id')->on('tbl_proyecto')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('id')->on('tbl_empleado')->onDelete('cascade');
        });

        Schema::create('tbl_asistencia_detalle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asistencia_id');
            $table->unsignedBigInteger('empleado_id');
            $table->string('estado', 50);
            $table->decimal('horas_extra', 5, 2)->nullable();
            $table->text('observacion')->nullable();

            $table->foreign('asistencia_id')->references('id')->on('tbl_asistencia')->onDelete('cascade');
            $table->foreign('empleado_id')->references('id')->on('tbl_empleado')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_asistencia_detalle');
        Schema::dropIfExists('tbl_asistencia');
    }
};
