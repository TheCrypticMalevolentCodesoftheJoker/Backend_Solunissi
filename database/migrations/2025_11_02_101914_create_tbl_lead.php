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
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('asignado_usuario_id')->nullable();
            $table->string('fuente', 100)->nullable();
            $table->string('estado', 50)->default('Nuevo');
            $table->text('notas')->nullable();
            $table->timestamps();
            $table->foreign('cliente_id')->references('id')->on('tbl_cliente')->onDelete('cascade');
            $table->foreign('asignado_usuario_id')->references('UsuarioID')->on('tbl_usuario')->onDelete('set null');
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
