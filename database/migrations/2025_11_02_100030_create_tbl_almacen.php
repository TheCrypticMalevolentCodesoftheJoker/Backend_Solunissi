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
            $table->string('codigo', 20)->unique()->nullable();
            $table->string('nombre', 100);
            $table->string('ubicacion', 150)->nullable();
            $table->string('estado', 50);
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
