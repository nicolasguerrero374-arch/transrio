<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        User::create([
            'name' => 'Admin TransRio',
            'email' => 'admini@transrio.com',
            'password' => Hash::make('TransRio2026'), // Cámbialo luego mi vida
        ]);
        // Proyecto vacío como pediste, no se crean paradas ni rutas de ejemplo
    }
}
