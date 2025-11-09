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
        Schema::create('tbl_proyecto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contrato_id')->nullable();
            $table->string('nombre', 150);
            $table->text('descripcion')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->unsignedBigInteger('almacen_id')->nullable();
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->string('estado', 50)->default('En progreso');
            $table->timestamps();

            $table->foreign('contrato_id')->references('id')->on('tbl_contrato')->onDelete('set null');
            $table->foreign('almacen_id')->references('id')->on('tbl_almacen')->onDelete('set null');
            $table->foreign('supervisor_id')->references('id')->on('tbl_empleado')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_proyecto');
    }
};
