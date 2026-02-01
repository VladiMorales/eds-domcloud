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
        Schema::create('corridas', function (Blueprint $table) {
            $table->id();
            $table->string('destino');
            $table->date('fecha');
            $table->time('horario');
            $table->double('precio_boleto');
            $table->integer('boletos_disponibles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corridas');
    }
};
