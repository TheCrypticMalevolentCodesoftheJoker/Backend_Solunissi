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
        Schema::create('tbl_presupuesto_proyecto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id');
            $table->string('categoria', 100);
            $table->decimal('monto_asignado', 12, 2)->default(0);
            $table->decimal('monto_ejecutado', 12, 2)->default(0);
            $table->timestamps();

            $table->foreign('proyecto_id')->references('id')->on('tbl_proyecto')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_presupuesto_proyecto');
    }
};
