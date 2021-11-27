<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PerfisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	    $perfis = [
		    ["nome"=>"VFP Administrador do Sistema","scope" => "admin"],
		    ["nome"=>"VFP Vendas","scope" => "vendedor"],
		    ["nome"=>"VFP Gerência","scope" => "gerente"],
		    ["nome"=>"VFP Inteligência de Mercado", "scope" => "inteligencia"],
		    ["nome"=>"VFP Auditoria", "scope" => "auditor"],
		    ["nome"=>"VFP Administração do Produto", "scope" => "produto"],
		    ["nome"=>"VFP Validação", "scope" => "validador"],
		    ["nome"=>"VFP Diretoria", "scope" => "diretor"],
		    ["nome"=>"VFP CRM", "scope" => "crm"]
	    ];
	    foreach ($perfis as $perfil){
		    \App\Model\Perfil::updateOrCreate(
			    array(
				    'nome' => $perfil['nome'],
				    'scope' => $perfil['scope']
			    ),
			    array()
		    );
	    }
    }
}
