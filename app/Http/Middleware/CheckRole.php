<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    // El "..." (rest operator) captura todos los roles que le pasemos separados por comas
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Verificamos si el usuario actual tiene alguno de los roles permitidos
        if (! auth()->check() || ! in_array(auth()->user()->tipo, $roles)) {
            // Si no coincide, lanzamos un error 403 (Prohibido)
            abort(403, 'No tienes permiso para acceder a esta área.');
        }

        return $next($request);
    }
}