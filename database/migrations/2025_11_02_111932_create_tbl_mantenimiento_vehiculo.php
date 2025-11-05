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
        Schema::create('tbl_mantenimiento_vehiculo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehiculo_id');
            $table->string('tipo', 100);
            $table->text('descripcion')->nullable();
            $table->date('fecha_mantenimiento');
            $table->decimal('costo', 12, 2)->default(0);
            $table->unsignedBigInteger('transaccion_id')->nullable();
            $table->timestamps();

            $table->foreign('vehiculo_id')->references('id')->on('tbl_vehiculo')->onDelete('cascade');
            $table->foreign('transaccion_id')->references('id')->on('tbl_transaccion_contable')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_mantenimiento_vehiculo');
    }
};
