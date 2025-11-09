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
        Schema::create('tbl_vehiculo', function (Blueprint $table) {
            $table->id();
            $table->string('placa', 20)->unique();
            $table->string('marca', 50);
            $table->string('modelo', 50);
            $table->year('anio');
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_vehiculo');
    }
};
