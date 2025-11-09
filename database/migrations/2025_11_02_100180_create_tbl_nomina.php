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
        Schema::create('tbl_nomina', function (Blueprint $table) {
            $table->id();
            $table->string('periodo', 50);
            $table->unsignedBigInteger('empleado_id');
            $table->decimal('sueldo_base', 12, 2)->default(0);
            $table->decimal('horas_extra', 12, 2)->default(0);
            $table->decimal('bonificacion', 12, 2)->default(0);
            $table->decimal('descuentos', 12, 2)->default(0);
            $table->decimal('total_pagar', 12, 2)->default(0);
            $table->date('fecha_pago');
            $table->unsignedBigInteger('transaccion_id');
            $table->timestamps();

            $table->foreign('empleado_id')->references('id')->on('tbl_empleado')->onDelete('cascade');
            $table->foreign('transaccion_id')->references('id')->on('tbl_transaccion_contable')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_nomina');
    }
};
