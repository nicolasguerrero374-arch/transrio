<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    protected $fillable = ['nombre', 'placa', 'color', 'coordenadas', 'descripcion'];

    protected $casts = [
        'coordenadas' => 'array'
    ];

    public function paradas()
    {
        return $this->belongsToMany(Parada::class, 'parada_ruta');
    }
}
