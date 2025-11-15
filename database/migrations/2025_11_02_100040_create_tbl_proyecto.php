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
        Schema::create('tbl_proyecto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contrato_id')->constrained('tbl_contrato')->onDelete('cascade');
            $table->string('nombre', 20)->unique()->nullable();
            $table->text('descripcion')->nullable();
            $table->foreignId('almacen_id')->nullable()->constrained('tbl_almacen')->onDelete('set null');
            $table->foreignId('supervisor_id')->nullable()->constrained('tbl_empleado')->onDelete('set null');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->decimal('monto_asignado', 12, 2)->nullable();
            $table->decimal('monto_ejecutado', 12, 2)->nullable();
            $table->string('estado', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_proyecto');
    }
};
