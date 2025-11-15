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
        Schema::create('tbl_cliente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('tbl_lead')->onDelete('cascade');

            // Campos adicionales específicos de Cliente
            $table->string('ruc', 11)->unique()->nullable();
            $table->string('razon_social', 150)->nullable();
            $table->string('tipo_cliente', 50)->nullable();

            // Ubicación / Dirección
            $table->string('direccion', 255)->nullable();
            $table->string('pais', 50)->nullable();
            $table->string('departamento', 50)->nullable();
            $table->string('provincia', 50)->nullable();
            $table->string('distrito', 50)->nullable();

            // Información comercial / CRM
            $table->string('web', 100)->nullable();
            $table->string('sector', 100)->nullable();
            $table->string('referencia', 100)->nullable();
            $table->string('cargo_contacto', 100)->nullable();
            $table->string('area_contacto', 100)->nullable();

            // Redes sociales / contactos alternativos
            $table->string('linkedin', 150)->nullable();
            $table->string('facebook', 150)->nullable();
            $table->string('twitter', 150)->nullable();
            $table->string('instagram', 150)->nullable();


            $table->string('estado', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cliente');
    }
};
