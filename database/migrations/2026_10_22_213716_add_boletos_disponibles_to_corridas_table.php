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
        Schema::table('corridas', function (Blueprint $table) {
            //
            $table->integer('boletos_disponibles')
            ->nullable()
            ->after('boletos_vendidos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('corridas', function (Blueprint $table) {
            //
            $table->dropColumn('boletos_disponibles');
        });
    }
};
