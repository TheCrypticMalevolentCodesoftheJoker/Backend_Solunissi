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
        Schema::create('tbl_proyecto_avance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained('tbl_proyecto')->onDelete('cascade');
            $table->string('titulo', 150);
            $table->text('descripcion');
            $table->date('fecha_registro');
            $table->integer('porcentaje_avance');
            $table->string('estado', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_proyecto_avance');
    }
};
