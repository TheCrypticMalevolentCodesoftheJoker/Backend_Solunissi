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
        Schema::create('tbl_almacen', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('ubicacion', 150)->nullable();
            $table->unsignedBigInteger('responsable_id')->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamps();
            $table->foreign('responsable_id')->references('id')->on('tbl_empleado')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_almacen');
    }
};
