<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->string('medio'); // Terminal, Mototaxi, Bus
            $table->string('hora_apertura'); // 5:00 AM
            $table->string('hora_cierre'); // 8:00 PM
            $table->string('dias'); // Lunes a Domingo
            $table->timestamps();
        });
        Schema::create('tarifas', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['taxi', 'mototaxi', 'bus']);
            $table->string('destino');
            $table->integer('precio');
            $table->timestamps();
        });
        Schema::create('numeros_contactos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['taxi', 'mototaxi']);
            $table->string('nombre');
            $table->string('numero'); // 3001234567
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('horarios');
        Schema::dropIfExists('tarifas');
        Schema::dropIfExists('numeros_contactos');
    }
};
