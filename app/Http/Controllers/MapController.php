<?php

namespace App\Http\Controllers;

use App\Models\Parada;
use App\Models\Ruta;
use App\Models\Horario;
use App\Models\Tarifa;
use App\Models\NumeroContacto;

class MapController extends Controller
{
    public function index()
    {
        return view('map.index');
    }

    public function paradasJson()
    {
        return Parada::with('rutas:id,nombre')->get();
    }
    public function rutasJson()
    {
        return Ruta::all();
    }
    public function listParadas()
    {
        return view('pages.paradas', ['paradas' => Parada::all()]);
    }
    public function listRutas()
    {
        return view('pages.rutas', ['rutas' => Ruta::all()]);
    }
    public function horarios()
    {
        return view('pages.horarios', ['horarios' => Horario::all()]);
    }
    public function tarifas()
    {
        return view('pages.tarifas', ['tarifas' => Tarifa::all()]);
    }
    public function numeros()
    {
        return view('pages.numeros', ['numeros' => NumeroContacto::all()]);
    }
    public function ayuda()
    {
        return view('pages.ayuda');
    }
    public function verRuta($id)
    {
        $ruta = Ruta::findOrFail($id);
        return view('pages.ver-ruta', ['ruta' => $ruta]);
    }

    public function unaRutaJson($id)
    {
        return Ruta::findOrFail($id);
    }
}
