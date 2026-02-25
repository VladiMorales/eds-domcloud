<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )    
    ->withMiddleware(function (Middleware $middleware) {

        // Aquí interceptamos a los usuarios autenticados que intenten entrar a rutas de invitados (como /login)
        $middleware->redirectUsersTo(function (Request $request) {
            $user = Auth::user();            
            // Retornamos la URL como STRING (usamos route() en lugar de redirect()->route())
            return match($user->tipo) {
                'admin'       => route('dashboard'),
                'venta'    => route('dashboard'),
                'checador'  => route('corridas'),
                default => route('inicio'),
            };
        });

        $middleware->alias([
            'role' => CheckRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
