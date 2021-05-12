<?php

namespace App\Providers;

use App\Auth\CustomUserProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Cliente;
use App\Pedido;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Auth::provider('custom-usuario', function($app, array $config){
            return new CustomUserProvider($app['hash'], $config['model']);
        });

        Gate::define('administrador_vendedor_producao', function($user){
            return $user->usu_dep_id == "1" || $user->usu_dep_id == "2" || $user->usu_dep_id == "3";
        });

        Gate::define('vendedor_administrador', function($user){
            return $user->usu_dep_id == "1" || $user->usu_dep_id == "3";
        });

        Gate::define('administrador_producao', function($user){
            return $user->usu_dep_id == "1" || $user->usu_dep_id == "2";
        });

        Gate::define('vendedor', function($user){
            return $user->usu_dep_id == "3";
        });

        Gate::define('administrador', function($user){
            return $user->usu_dep_id == "1";
        });

        Gate::define('producao', function($user){
            return $user->usu_dep_id == "2";
        });

        Gate::define('permite_cliente',function($user, $cliente){

            if( in_array($user->usu_dep_id,[1,2]) ){

                return true;

            }else{

                $objCliente = Cliente::findOrFail($cliente->cli_id);

                if($objCliente->cli_usu_id == $user->usu_id){

                    return true;

                }

                return false;

            }

        });

        Gate::define('permite_pedido',function($user,$pedido){

            if( in_array($user->usu_dep_id,[1,2]) ){

                return true;

            }else{


                if($pedido->ped_usu_id == $user->usu_id){

                    return true;
                }

                return false;

            }
        });

    }
}
