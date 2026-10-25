<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tarifa;
use App\Models\Ruta;
use Illuminate\Http\Request;

class TarifaController extends Controller
{
    public function index()
    {
        return view('admin.tarifas.index', ['tarifas' => Tarifa::all()]);
    }

    public function create()
    {
        return view('admin.tarifas.create', ['rutas' => Ruta::all()]);
    }

    public function store(Request $r)
    {
        Tarifa::create($r->validate([
            'destino' => 'required',
            'precio' => 'required|numeric',
            'tipo' => 'required',
            'ruta_id' => 'nullable'
        ]));
        return redirect()->route('admin.tarifas.index');
    }

    public function edit(Tarifa $tarifa)
    {
        $rutas = Ruta::all();
        return view('admin.tarifas.edit', compact('tarifa', 'rutas'));
    }

    public function update(Request $request, Tarifa $tarifa)
    {
        $data = $request->validate([
            'destino' => 'required',
            'precio' => 'required|numeric',
            'tipo' => 'required',
            'ruta_id' => 'nullable'
        ]);
        $tarifa->update($data);
        return redirect()->route('admin.tarifas.index')->with('success', 'Tarifa actualizada');
    }

    public function destroy(Tarifa $tarifa)
    {
        $tarifa->delete();
        return back();
    }
}
