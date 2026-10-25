<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehiculoLocation extends Model
{
    protected $table = 'vehiculo_locations';
    protected $fillable = ['user_id', 'ruta_id', 'tipo', 'lat', 'lng'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ruta()
    {
        return $this->belongsTo(Ruta::class);
    }
}
