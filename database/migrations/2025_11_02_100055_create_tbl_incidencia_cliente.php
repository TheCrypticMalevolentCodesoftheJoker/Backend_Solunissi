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
        Schema::create('tbl_cliente_incidencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('tbl_cliente')->onDelete('cascade');
            $table->dateTime('fecha');
            $table->string('tipo', 100);
            $table->string('asunto')->nullable();
            $table->text('detalle')->nullable();
            $table->string('prioridad', 50)->nullable();
            $table->string('estado', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cliente_incidencia');
    }
};
