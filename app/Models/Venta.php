<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'total',
        'boletos_vendidos',
        'fecha',
        'metodo_pago',
        'user_id',
        'agencia_id'
    ];

    public function boletos()
    {
        return $this->hasMany(Boleto::class);
    }

    public function viaje()
    {
        return $this->belongsTo(Viaje::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agencia()
    {
        return $this->belongsTo(Agencia::class);
    }
}
