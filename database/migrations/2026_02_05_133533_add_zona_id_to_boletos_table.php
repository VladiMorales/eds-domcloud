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
        Schema::table('boletos', function (Blueprint $table) {
            $table->foreignId('zona_id')            
            ->nullable()
            ->after('venta_id')
            ->constrained()
            ->onDelete('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('boletos', function (Blueprint $table) {
            $table->dropForeign('boletos_zona_id_foreign');
            $table->dropColumn('zona_id');            
        });
    }
};
