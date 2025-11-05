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
        Schema::create('tbl_cuenta_contable', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50)->unique();
            $table->string('nombre', 150);
            $table->string('tipo', 50);
            $table->integer('nivel')->default(1);
            $table->unsignedBigInteger('cuenta_padre_id')->nullable();
            $table->timestamps();

            $table->foreign('cuenta_padre_id')->references('id')->on('tbl_cuenta_contable')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cuenta_contable');
    }
};
