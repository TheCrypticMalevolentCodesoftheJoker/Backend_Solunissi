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
        Schema::create('tbl_empleado', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cargo_id');
            $table->string('dni', 8) -> unique();
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('email', 100);
            $table->string('telefono', 20)->nullable();
            $table->text('direccion')->nullable();
            $table->date('fecha_ingreso');
            $table->boolean('estado')->default(true);
            $table->timestamps();

            $table->foreign('cargo_id')->references('id')->on('tbl_cargo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_empleado');
    }
};
