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
        Schema::create('lista_historials', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(0);
            $table->text('remarks');
            $table->dateTime('fecha')->default(now());
            $table->unsignedBigInteger('appointment_id');
            $table->foreign('appointment_id')->references('id')->on('lista_citas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_historials');
    }
};
