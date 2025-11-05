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
        Schema::create('tbl_avance_proyecto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id');
            $table->text('descripcion');
            $table->integer('porcentaje_avance')->default(0);
            $table->date('fecha_registro');
            $table->unsignedBigInteger('registrado_por');
            $table->timestamps();

            $table->foreign('proyecto_id')->references('id')->on('tbl_proyecto')->onDelete('cascade');
            $table->foreign('registrado_por')->references('id')->on('tbl_empleado')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_avance_proyecto');
    }
};
