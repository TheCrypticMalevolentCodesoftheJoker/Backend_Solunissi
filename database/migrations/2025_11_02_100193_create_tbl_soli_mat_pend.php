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
        Schema::create('tbl_soli_mat_pend', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soli_mat_id')->constrained('tbl_soli_mat')->onDelete('cascade');
            $table->foreignId('proyecto_id')->constrained('tbl_proyecto')->onDelete('cascade');
            $table->string('tipo', 50);
            $table->string('estado', 50);
            $table->dateTime('fecha');
        });
        Schema::create('tbl_soli_mat_pend_det', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soli_mat_pend_id')->constrained('tbl_soli_mat_pend')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('tbl_material')->onDelete('cascade');
            $table->decimal('cantidad', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_soli_mat_pend_det');
        Schema::dropIfExists('tbl_soli_mat_pend');
    }
};
