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
            $table->string('codigo', 10)->unique()->nullable();
            $table->unsignedBigInteger('nomina_id');
            $table->unsignedBigInteger('empleado_id');

            $table->decimal('salario_base', 10, 2);
            $table->decimal('horas_extra', 10, 2)->default(0);
            $table->decimal('bonos', 10, 2)->default(0);
            $table->decimal('descuentos', 10, 2)->default(0);
            $table->decimal('neto_pagar', 10, 2);

            $table->string('estado', 20)->default('Pendiente');

            $table->foreign('nomina_id')->references('id')->on('tbl_nomina')->onDelete('cascade');
            $table->foreign('empleado_id')->references('id')->on('tbl_empleado')->onDelete('cascade');
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
