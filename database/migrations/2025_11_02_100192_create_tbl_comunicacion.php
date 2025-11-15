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
        Schema::create('tbl_lead_comunicacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendedor_id')->constrained('tbl_empleado')->onDelete('cascade');
            $table->foreignId('lead_id')->constrained('tbl_lead')->onDelete('cascade');
            $table->dateTime('fecha');
            $table->string('tipo', 50);
            $table->string('asunto')->nullable();
            $table->text('detalle')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_lead_comunicacion');
    }
};
