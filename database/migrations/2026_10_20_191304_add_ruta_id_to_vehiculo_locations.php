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
        Schema::table('vehiculo_locations', function (Blueprint $table) {
            if (!Schema::hasColumn('vehiculo_locations', 'ruta_id')) {
                $table->unsignedBigInteger('ruta_id')->nullable()->after('lng');
            }
            if (!Schema::hasColumn('vehiculo_locations', 'tipo')) {
                $table->string('tipo')->default('bus')->nullable()->after('ruta_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehiculo_locations', function (Blueprint $table) {
            if (Schema::hasColumn('vehiculo_locations', 'ruta_id')) {
                $table->dropColumn('ruta_id');
            }
            if (Schema::hasColumn('vehiculo_locations', 'tipo')) {
                $table->dropColumn('tipo');
            }
        });
    }
};
