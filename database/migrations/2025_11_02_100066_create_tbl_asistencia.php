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

            $table->unsignedBigInteger('empleado_id');
            $table->unsignedBigInteger('supervisor_id');
            $table->unsignedBigInteger('proyecto_id')->nullable();

            $table->date('fecha');
            $table->decimal('horas_extra', 5, 2)->nullable();
            $table->string('estado', 50);
            $table->text('observacion')->nullable();
            $table->timestamps();

            $table->foreign('empleado_id')->references('id')->on('tbl_empleado')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('id')->on('tbl_empleado')->onDelete('cascade');
            $table->foreign('proyecto_id')->references('id')->on('tbl_proyecto')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_asistencia');
    }
};
