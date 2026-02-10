<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    public function scopeAplicarFiltros(Builder $query, array $filtros)
    {
        // 1. Filtro de Fechas
        // Usamos null coalescing operator (??) por si no viene el dato en el array
        if (($filtros['fecha_inicio'] ?? null) && ($filtros['fecha_fin'] ?? null)) {
            $query->whereBetween('fecha', [$filtros['fecha_inicio'], $filtros['fecha_fin']]);
        }

        // 2. Filtro de Tipo
        $tipo = $filtros['tipo'] ?? null;
        $query->when($tipo && $tipo !== 'todas', function ($q) use ($tipo) {
            if ($tipo == 'boletos') {
                $q->where('boletos_vendidos', '>', 0);
            } elseif ($tipo == 'viaje') { // O el valor que corresponda
                $q->where('boletos_vendidos', 0);
            }
        });

        // 3. Filtro de Usuario
        $usuario = $filtros['usuario'] ?? null;
        $query->when($usuario && $usuario !== 'todos', function ($q) use ($usuario) {
            $q->where('user_id', $usuario);
        });

        // 4. Filtro de Agencia
        $agencia = $filtros['agencia'] ?? null;
        $query->when($agencia && $agencia !== 'todas', function ($q) use ($agencia) {
            $q->where('agencia_id', $agencia);
        });
    }
   

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
