<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('rutas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('placa')->nullable(); // Ej: UVA-123
            $table->string('color')->default('#0D47A1'); // Color de la línea en el mapa
            $table->json('coordenadas'); // [[5.422, -75.702], [5.423, -75.703]]
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
        Schema::create('parada_ruta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parada_id')->constrained()->onDelete('cascade');
            $table->foreignId('ruta_id')->constrained()->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('parada_ruta');
        Schema::dropIfExists('rutas');
    }
};
