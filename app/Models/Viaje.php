<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    protected $fillable = [
        'destino',
        'fecha',
        'horario',
        'tipo',
        'precio',
        'nombre_cliente',
        'venta_id',
        'zona_id'
    ];

    public function Venta()
    {
        return $this->hasOne(Venta::class);
    }
}
