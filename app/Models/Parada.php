<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Parada extends Model {
    protected $fillable = ['nombre','lat','lng','tipo','foto','descripcion','hora_primera','hora_ultima'];
    public function rutas(){ return $this->belongsToMany(Ruta::class, 'parada_ruta'); }
}
