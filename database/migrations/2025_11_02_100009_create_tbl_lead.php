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
        Schema::create('tbl_lead', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellido', 100)->nullable();
            $table->string('empresa', 150)->nullable();
            $table->string('correo', 100)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('fuente', 100)->nullable();
            $table->string('estado', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_lead');
    }
};
