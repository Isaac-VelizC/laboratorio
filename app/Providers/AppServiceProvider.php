<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
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
        Validator::extend('month', function ($attribute, $value, $parameters, $validator) {
            // Verificar si el valor coincide con el formato "YYYY-MM"
            return preg_match('/^\d{4}-\d{2}$/', $value);
        });
    }
}
