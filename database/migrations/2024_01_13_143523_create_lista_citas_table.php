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
        Schema::create('lista_citas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hora_id')->nullable();
            $table->foreign('hora_id')->references('id')->on('horarios')->onDelete('cascade');
            $table->string('code', 100);
            $table->time('horario');
            $table->date('fecha')->default(now());
            $table->text('prescription')->nullable();
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('lista_clientes')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_citas');
    }
};
