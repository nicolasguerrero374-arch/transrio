<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Horario;
use App\Models\Parada;
use App\Models\Ruta;
use Illuminate\Http\Request;

class HorarioController extends Controller {

    public function index(){
        return view('admin.horarios.index',['horarios'=>Horario::with(['ruta','parada'])->get()]);
    }

    public function create(){
        return view('admin.horarios.create',[
            'rutas'=>Ruta::all(),
            'paradas'=>Parada::all()
        ]);
    }

    public function store(Request $r){
        $r->validate([
            'ruta_id'=>'required',
            'hora_apertura'=>'required',
            'hora_cierre'=>'required',
            'dias'=>'required'
        ]);
        Horario::create($r->all());
        return redirect()->route('admin.horarios.index')->with('ok','Horario creado pro');
    }

    public function edit(Horario $horario){
        return view('admin.horarios.edit',[
            'horario'=>$horario,
            'rutas'=>Ruta::all(),
            'paradas'=>Parada::all()
        ]);
    }

    public function update(Request $r, Horario $horario){
        $horario->update($r->all());
        return redirect()->route('admin.horarios.index');
    }

    public function destroy(Horario $horario){
        $horario->delete();
        return back();
    }
}
