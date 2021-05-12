<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('componentes.menu','menu');
        Blade::component('componentes.estoquem','estoquem');
        Blade::component('componentes.compram','compram');
        Blade::component('componentes.detalheproduto','detalheproduto');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
