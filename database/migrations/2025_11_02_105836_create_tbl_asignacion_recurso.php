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
        Schema::create('tbl_asignacion_recurso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id');
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedBigInteger('material_id')->nullable();
            $table->decimal('cantidad', 12, 2);
            $table->date('fecha_asignacion');
            $table->timestamps();

            $table->foreign('proyecto_id')->references('id')->on('tbl_proyecto')->onDelete('cascade');
            $table->foreign('empleado_id')->references('id')->on('tbl_empleado')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('tbl_material')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_asignacion_recurso');
    }
};
