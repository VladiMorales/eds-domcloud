<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Corrida extends Model
{
    protected $fillable = [
        'destino',
        'fecha',
        'horario',
        'boletos_disponibles'
    ];


    // Definimos un atributo virtual 'salida_carbon'
    protected function salidaCarbon(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->fecha . ' ' . $this->horario),
        );
    }
    
    // Atributo booleano para saber si ya salió
    protected function yaSalio(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->salida_carbon->isPast(),
        );
    }

    public function boletos()
    {
        return $this->hasMany(Boleto::class);
    }
}
