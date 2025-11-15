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
        Schema::create('tbl_proyecto_material', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained('tbl_proyecto')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('tbl_material')->onDelete('cascade');
            $table->decimal('cantidad', 12, 2);
            $table->date('fecha_asignacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_proyecto_material');
    }
};
