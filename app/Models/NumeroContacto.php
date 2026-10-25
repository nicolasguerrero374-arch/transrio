<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class NumeroContacto extends Model {
    protected $table = 'numeros_contactos';
    protected $fillable = ['nombre','numero','tipo','parada_id'];
}
