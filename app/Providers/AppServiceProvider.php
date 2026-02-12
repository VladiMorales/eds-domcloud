<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        // Definimos una "Puerta" llamada 'isAdmin'
        Gate::define('isAdmin', function (User $user) {
            return $user->tipo === 'admin';
        });

        // Definimos otra para vendedores
        Gate::define('isVendedor', function (User $user) {
            return $user->tipo === 'vendedor';
        });
    }
}
