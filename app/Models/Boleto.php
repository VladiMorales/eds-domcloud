<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    //
    protected $fillable = [
        'pasajero_nombre',
        'status',
        'tipo',
        'precio',        
        'folio',
        'corrida_id',
        'venta_id'
    ];

    public function corrida()
    {
        return $this->belongsTo(Corrida::class);
    }

    public function venta(){
        return $this->belongsTo(Venta::class);
    }
}
