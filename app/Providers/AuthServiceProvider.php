<?php

namespace App\Providers;

use Carbon\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

	    //Passport::routes();
	    Passport::personalAccessTokensExpireIn(Carbon::now()->addDays(1));
        //
	    Passport::tokensCan([
		    'admin'                 => 'Administrador do Sistema',
		    'vendedor'              => 'Vendedor do sistema',
		    'gerente'               => 'Gerente do sistema',
		    'inteligencia'          => 'Inteligência de Mercado',
		    'auditor'               => 'Auditor',
		    'produto'               => 'Administração do Produto',
		    'validador'             => 'Validação',
		    'diretor'               => 'Diretoria',
		    'crm'                   => 'CRM',
		    'list-clientes-vendedor'    => 'Listagem de clientes para o vendedor',
		    'list-clientes-gerente'     => 'Listagem de clientes para o gerente',
		    'list-clientes-all'         => 'Listagem de clientes para os demais perfis',
	    ]);
    }
}
