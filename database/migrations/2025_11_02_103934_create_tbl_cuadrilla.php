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
        Schema::create('tbl_cuadrilla', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->unsignedBigInteger('proyecto_id')->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamps();

            $table->foreign('supervisor_id')->references('id')->on('tbl_empleado')->onDelete('set null');
            $table->foreign('proyecto_id')->references('id')->on('tbl_proyecto')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cuadrilla');
    }
};
