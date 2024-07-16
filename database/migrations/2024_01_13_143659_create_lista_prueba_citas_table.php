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
            $table->unsignedBigInteger('appointment_id');
            $table->unsignedBigInteger('test_id');
            $table->foreign('appointment_id')->references('id')->on('lista_citas')->onDelete('cascade');
            $table->foreign('test_id')->references('id')->on('lista_pruebas')->onDelete('cascade');
            $table->string('pdf')->nullable();
            $table->text('formulario');
            $table->integer('estado')->default(0);
            $table->dateTime('fecha')->default(now());
            $table->integer('code')->default(1);
            $table->unsignedBigInteger('bio_id')->nullable();
            $table->foreign('bio_id')->references('id')->on('users')->onDelete('cascade');
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
