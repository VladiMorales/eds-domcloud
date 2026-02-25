<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Creamos un "if" personalizado para Blade llamado 'role'
        Blade::if('role', function (...$roles) {
            // Verifica si está logueado Y si su tipo está en el arreglo de roles
            return auth()->check() && in_array(auth()->user()->tipo, $roles);
        });
    }
}
