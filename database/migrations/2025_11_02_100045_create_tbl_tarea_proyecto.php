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
        Schema::create('tbl_tarea_proyecto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id');
            $table->text('descripcion');
            $table->unsignedBigInteger('responsable_id')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->integer('progreso')->default(0);
            $table->timestamps();

            $table->foreign('proyecto_id')->references('id')->on('tbl_proyecto')->onDelete('cascade');
            $table->foreign('responsable_id')->references('id')->on('tbl_empleado')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_tarea_proyecto');
    }
};
