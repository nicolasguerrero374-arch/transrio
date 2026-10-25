<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ruta;
use Illuminate\Http\Request;

class RutaController extends Controller
{
    public function index()
    {
        return view('admin.rutas.index', ['rutas' => Ruta::all()]);
    }
    public function create()
    {
        return view('admin.rutas.create');
    }

    public function store(Request $r)
    {
        $r->validate([
            'nombre' => 'required',
            'placa' => 'nullable',
            'color' => 'nullable',
            'coordenadas' => 'required',
            'descripcion' => 'nullable'
        ]);

        $datos = $r->only('nombre', 'placa', 'color', 'descripcion');
        // Esta línea quita las comillas dobles que te dañaban el mapa
        $datos['coordenadas'] = json_decode($r->coordenadas, true);

        Ruta::create($datos);
        return redirect()->route('admin.rutas.index')->with('ok', 'Ruta creada');
    }

    public function edit(Ruta $ruta)
    {
        return view('admin.rutas.edit', compact('ruta'));
    }

    public function update(Request $r, Ruta $ruta)
    {
        $r->validate([
            'nombre' => 'required',
            'placa' => 'nullable',
            'color' => 'nullable',
            'coordenadas' => 'nullable',
            'descripcion' => 'nullable'
        ]);

        $datos = $r->only('nombre', 'placa', 'color', 'descripcion');
        if ($r->coordenadas) {
            $datos['coordenadas'] = json_decode($r->coordenadas, true);
        }

        $ruta->update($datos);
        return redirect()->route('admin.rutas.index');
    }

    public function destroy(Ruta $ruta)
    {
        $ruta->delete();
        return back();
    }
}
