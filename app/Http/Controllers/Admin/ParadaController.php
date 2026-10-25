<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parada;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Illuminate\Support\Facades\Storage;

class ParadaController extends Controller {

    public function index(){ return view('admin.paradas.index', ['paradas'=>Parada::all()]); }
    public function create(){ return view('admin.paradas.create'); }

    public function store(Request $r){
        $r->validate(['nombre'=>'required','lat'=>'required|numeric','lng'=>'required|numeric','foto'=>'nullable|image|max:2048']);
        $data = $r->only(['nombre','lat','lng','tipo','descripcion','hora_primera','hora_ultima']);
        
        if($r->hasFile('foto')){
            $manager = ImageManager::usingDriver(Driver::class);
            $img = $manager->decode($r->file('foto')->getRealPath());
            $img->cover(400, 300);
            $nombre = time().'_'.$r->file('foto')->getClientOriginalName();
            $encoded = $img->encodeUsingFormat(Format::JPEG, quality: 80);
            Storage::disk('public')->put($nombre, (string)$encoded);
            $data['foto'] = $nombre;
        }

        Parada::create($data);
        return redirect()->route('admin.paradas.index')->with('ok','Parada creada');
    }

    public function edit(Parada $parada){ return view('admin.paradas.edit', compact('parada')); }

    public function update(Request $r, Parada $parada){
        $data = $r->only(['nombre','lat','lng','tipo','descripcion','hora_primera','hora_ultima']);
        
        if($r->hasFile('foto')){
            $manager = ImageManager::usingDriver(Driver::class);
            $img = $manager->decode($r->file('foto')->getRealPath());
            $img->cover(400, 300);
            $nombre = time().'_'.$r->file('foto')->getClientOriginalName();
            $encoded = $img->encodeUsingFormat(Format::JPEG, quality: 80);
            Storage::disk('public')->put($nombre, (string)$encoded);
            $data['foto'] = $nombre;
        }

        $parada->update($data);
        return redirect()->route('admin.paradas.index')->with('ok','Actualizado');
    }
    public function destroy(\App\Models\Parada $parada)
{
    // Si tiene foto, la borramos del storage
    if ($parada->foto) {
        Storage::disk('public')->delete($parada->foto);
    }

    $parada->delete();

    return redirect()->route('admin.paradas.index')
        ->with('success', 'Parada eliminada correctamente');
}
}
