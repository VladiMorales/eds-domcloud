<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Corrida extends Model
{
    protected $fillable = [
        'destino',
        'fecha',
        'horario',
        'boletos_disponibles'
    ];

    public function boletos()
    {
        return $this->hasMany(Boleto::class);
    }
}
