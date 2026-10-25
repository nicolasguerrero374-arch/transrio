<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model {
    protected $fillable = ['ruta_id','parada_id','hora_apertura','hora_cierre','hora_salida','dias','tipo'];
    public function ruta(){ return $this->belongsTo(Ruta::class); }
    public function parada(){ return $this->belongsTo(\App\Models\Parada::class); }
}
