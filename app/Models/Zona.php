<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $fillable = [
        'direccion'
    ];

    public function boletos()
    {
        return $this->hasMany(Boleto::class);
    }
}
