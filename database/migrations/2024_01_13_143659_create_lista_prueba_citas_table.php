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
        Schema::create('lista_prueba_citas', function (Blueprint $table) {
            $table->id();
            $table->string('informe')->nullable();
            $table->unsignedBigInteger('appointment_id');
            $table->unsignedBigInteger('test_id');
            $table->foreign('appointment_id')->references('id')->on('lista_citas')->onDelete('cascade');
            $table->foreign('test_id')->references('id')->on('lista_pruebas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_prueba_citas');
    }
};
