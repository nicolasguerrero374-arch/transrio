<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('paradas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Ej: Terminal, Parque San Sebastián
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->enum('tipo', ['bus', 'mototaxi', 'taxi', 'mixto'])->default('mixto');
            $table->string('foto')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('hora_primera')->nullable(); // 05:00
            $table->string('hora_ultima')->nullable(); // 20:00
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('paradas'); }
};
