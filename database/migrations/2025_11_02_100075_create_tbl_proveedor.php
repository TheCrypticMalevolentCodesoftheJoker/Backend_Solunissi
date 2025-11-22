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
        Schema::create('tbl_proveedor', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social', 180);
            $table->string('nombre_comercial', 150)->nullable();
            $table->string('ruc', 11)->unique();

            $table->string('direccion', 255)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('correo', 120)->nullable();
            $table->string('pagina_web', 150)->nullable();

            $table->string('contacto_nombre', 120)->nullable();
            $table->string('contacto_telefono', 20)->nullable();
            $table->string('contacto_correo', 120)->nullable();

            $table->string('estado', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_proveedor');
    }
};
