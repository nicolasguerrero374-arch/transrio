<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\VehiculoLocationController;

//  Login de usuarios normales opcional
Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])->name('user.login.post');
Route::get('/register', [UserAuthController::class, 'showRegister'])->name('user.register');
Route::post('/register', [UserAuthController::class, 'register'])->name('user.register.post');
Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');
Route::get('/perfil', [UserAuthController::class, 'perfil'])->middleware('auth')->name('user.perfil');

Route::get('/', [MapController::class, 'index'])->name('map.index');
Route::get('/api/paradas', [MapController::class, 'paradasJson']);
Route::get('/api/rutas', [MapController::class, 'rutasJson']);
Route::get('/paradas', [MapController::class, 'listParadas']);
Route::get('/rutas', [MapController::class, 'listRutas']);
Route::get('/rutas/{id}', [MapController::class, 'verRuta']);
Route::get('/api/rutas/{id}', [MapController::class, 'unaRutaJson']);
Route::get('/horarios', [MapController::class, 'horarios']);
Route::get('/tarifas', [MapController::class, 'tarifas']);
Route::get('/numeros', [MapController::class, 'numeros']);
Route::get('/ayuda', [MapController::class, 'ayuda']);
Route::get('/api/vehiculos', [VehiculoLocationController::class, 'index']);
Route::get('/vehiculos', [VehiculoLocationController::class, 'index']);
Route::post('/conductor/update', [VehiculoLocationController::class, 'update'])->middleware('auth');
Route::get('/conductor', function () {
    $rutas = \App\Models\Ruta::all();
    return view('conductor.index', compact('rutas'));
})->middleware('auth')->name('conductor.index');

// Admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.post');

    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard']);

    Route::resource('paradas', \App\Http\Controllers\Admin\ParadaController::class, ['as' => 'admin']);
    Route::resource('rutas', \App\Http\Controllers\Admin\RutaController::class, ['as' => 'admin']);
    Route::resource('horarios', \App\Http\Controllers\Admin\HorarioController::class, ['as' => 'admin']);
    Route::resource('tarifas', \App\Http\Controllers\Admin\TarifaController::class, ['as' => 'admin']);
    Route::resource('numeros', \App\Http\Controllers\Admin\NumeroController::class, ['as' => 'admin']);
    Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios.index');
    Route::post('/usuarios/{id}/role', [AdminController::class, 'updateRole'])->name('admin.usuarios.updateRole');

    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});
