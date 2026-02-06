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
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->string('destino');
            $table->date('fecha');
            $table->time('horario');
            $table->string('tipo');
            $table->double('precio');
            $table->string('nombre_cliente');
            $table->foreignId('venta_id')->constrained()->onDelete('cascade');
            $table->foreignId('zona_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viajes');
    }
};
