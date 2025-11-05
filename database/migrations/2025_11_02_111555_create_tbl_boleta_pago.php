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
        Schema::create('tbl_boleta_pago', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nomina_id');
            $table->string('numero', 50)->unique();
            $table->date('fecha_emision');
            $table->string('archivo_pdf', 255)->nullable();
            $table->timestamps();

            $table->foreign('nomina_id')->references('id')->on('tbl_nomina')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_boleta_pago');
    }
};
