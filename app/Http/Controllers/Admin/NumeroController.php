<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NumeroContacto;
use App\Models\Parada;
use Illuminate\Http\Request;

class NumeroController extends Controller
{
    public function index()
    {
        return view('admin.numeros.index', ['numeros' => NumeroContacto::all()]);
    }

    public function create()
    {
        return view('admin.numeros.create', ['paradas' => Parada::all()]);
    }

    public function store(Request $r)
    {
        NumeroContacto::create($r->validate([
            'nombre' => 'required',
            'numero' => 'required',
            'tipo' => 'required',
            'parada_id' => 'nullable'
        ]));
        return redirect()->route('admin.numeros.index');
    }

    public function edit(NumeroContacto $numero)
    {
        $paradas = Parada::all();
        return view('admin.numeros.edit', compact('numero', 'paradas'));
    }

    public function update(Request $request, NumeroContacto $numero)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'numero' => 'required',
            'tipo' => 'required',
            'parada_id' => 'nullable'
        ]);
        $numero->update($data);
        return redirect()->route('admin.numeros.index')->with('success', 'Número actualizado');
    }

    public function destroy(NumeroContacto $numero)
    {
        $numero->delete();
        return back();
    }
}
