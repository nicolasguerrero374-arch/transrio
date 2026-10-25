<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehiculoLocation;
use Illuminate\Support\Facades\Auth;

class VehiculoLocationController extends Controller
{
    /**
     * Todos pueden ver los vehículos en el mapa
     */
    public function index()
    {

         return VehiculoLocation::with(['user', 'ruta'])
         ->where('updated_at', '>', now()->subMinutes(1))
        ->get();
    }

    /**
     * Solo conductor APROBADO por mi puede enviar ubicación
     */
   public function update(Request $request)
{
    $user = Auth::user();

    if (!$user) {
        return response()->json(['error' => 'No logueado'], 401);
    }

    if ($user->role !== 'conductor' || !$user->is_approved) {
        return response()->json(['error' => 'No eres conductor aprobado'], 403);
    }

    $request->validate([
        'lat' => 'required|numeric|between:-90,90',
        'lng' => 'required|numeric|between:-180,180',
        'ruta_id' => 'nullable|exists:rutas,id',
    ]);

    $vehiculo = VehiculoLocation::updateOrCreate(
        ['user_id' => $user->id],
        [
            'lat' => $request->lat,
            'lng' => $request->lng,
            'ruta_id' => $request->ruta_id ?? $user->ruta_id ?? 6,
            'tipo' => $user->tipo_vehiculo ?? $user->tipo ?? 'bus',
        ]
    );

    return response()->json(['ok' => true, 'vehiculo' => $vehiculo]);
}

}
