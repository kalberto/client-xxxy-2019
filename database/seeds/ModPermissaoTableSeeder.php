<?php

use App\Model\ModPermissao;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Model\Modulo;

class ModPermissaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $permissoes = [
		    "VFP Administrador do Sistema" => [
			    "Dashboard" => [1],
			    "Prédios" => [1,2,3,4],
			    "Clientes" => [1,2,3,4],
			    "Produtos" => [1],
			    "Prospecções" => [1,2,3],
			    "Vendas" => [1,2,3],
			    "Auditorias" => [1,2,3],
			    "Empreendimentos Comerciais" => [1,2,3,4],
		    ],
		    "VFP Vendas" => [
			    "Dashboard" => [1],
			    "Prédios" => [1,3],
			    "Clientes" => [1,2,3],
			    "Produtos" => [1],
			    "Prospecções" => [1,2,3],
			    "Vendas" => [1,2,3],
			    "Auditorias" => [1],
			    "Empreendimentos Comerciais" => [1,3],
		    ],
		    "VFP Gerência" => [
			    "Dashboard" => [1],
			    "Prédios" => [1,3],
			    "Clientes" => [1,2,3],
			    "Produtos" => [1],
			    "Prospecções" => [1,2,3],
			    "Vendas" => [1,2,3],
			    "Auditorias" => [1],
			    "Empreendimentos Comerciais" => [1,3],
		    ],
		    "VFP Inteligência de Mercado" => [
			    "Dashboard" => [1],
			    "Prédios" => [1,2,3,4],
			    "Clientes" => [1,2,3,4],
			    "Produtos" => [1],
			    "Prospecções" => [1,2,3],
			    "Vendas" => [1,2,3],
			    "Auditorias" => [1],
			    "Empreendimentos Comerciais" => [1,2,3,4],
		    ],
		    "VFP Auditoria" => [
			    "Dashboard" => [1],
			    "Prédios" => [1],
			    "Clientes" => [1],
			    "Produtos" => [1],
			    "Prospecções" => [1],
			    "Vendas" => [1],
			    "Auditorias" => [1,2,3],
			    "Empreendimentos Comerciais" => [1],
		    ],
		    "VFP Administração do Produto" => [
			    "Dashboard" => [1],
			    "Prédios" => [1],
			    "Clientes" => [1],
			    "Produtos" => [1],
			    "Prospecções" => [1],
			    "Vendas" => [1],
			    "Auditorias" => [1],
			    "Empreendimentos Comerciais" => [1],
		    ],
		    "VFP Validação" => [
			    "Dashboard" => [1],
			    "Prédios" => [1],
			    "Clientes" => [1],
			    "Produtos" => [1],
			    "Prospecções" => [1],
			    "Vendas" => [1],
			    "Auditorias" => [1],
			    "Empreendimentos Comerciais" => [1],
		    ],
		    "VFP Diretoria" => [
			    "Dashboard" => [1],
			    "Prédios" => [1],
			    "Clientes" => [1],
			    "Produtos" => [1],
			    "Prospecções" => [1],
			    "Vendas" => [1],
			    "Auditorias" => [1],
			    "Empreendimentos Comerciais" => [1],
		    ],
		    "VFP CRM" => [
			    "Dashboard" => [1],
			    "Prédios" => [1],
			    "Clientes" => [1],
			    "Produtos" => [1],
			    "Prospecções" => [1],
			    "Vendas" => [1],
			    "Auditorias" => [1],
			    "Empreendimentos Comerciais" => [1],
		    ],
	    ];
	    foreach ($permissoes as $key => $permissao){
	    	$perfil = \App\Model\Perfil::where('nome',$key)->first();
	    	foreach ($permissao as $name => $item){
	    		$modulo = \App\Model\Modulo::where('nome',$name)->first();
	    		foreach ($item as $value){
	    			$modPerm = ModPermissao::updateOrCreate(
	    				array(
	    				    'mod_id' => $modulo->id,
						    'permissao_id' => $value
				        ),
					    array()
				    );
				    if(!DB::table('perfil_mod_permissao')->where([['perfil_id','=',$perfil->id],['mod_perm_id','=',$modPerm->id]])->count()) {
					    DB::table('perfil_mod_permissao')->insert([
						    'perfil_id'=>$perfil->id,
						    'mod_perm_id'=>$modPerm->id
					    ]);
				    }
			    }
		    }
	    }
    }
}
