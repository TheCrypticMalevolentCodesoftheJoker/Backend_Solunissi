<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_usuario', function (Blueprint $table) {
            $table->id('UsuarioID');
            $table->string('Nombre', 50);
            $table->string('Apellidos', 50);
            $table->string('Telefono', 20)->nullable();
            $table->string('Email', 100);
            $table->string('Contrasena', 255);
            $table->boolean('Estado')->default(true);
            $table->unsignedBigInteger('RolID');
            $table->timestamp('UltimoLogin')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('RolID')->references('RolID')->on('tbl_rol')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_usuario');
    }
};
