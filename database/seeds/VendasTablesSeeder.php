<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendasTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $contratadas = [
		    "xxxx Telecomunicações e Tecnologia S.A." => [
		    	[
		    		'nome' => "Curitiba - PR",
				    "cnpj" => '11960585000108',
				    'endereco' => [
				    	'logradouro' => 'Treze de Maio',
					    'numero' => '1062',
					    'bairro' => 'São Francisco',
					    'cep' => '80510030',
					    'complemento' => ''
				    ]
			    ],
			    [
				    'nome' => "Osasco - SP",
				    "cnpj" => '11960585000370',
				    'endereco' => [
					    'logradouro' => 'Machado de Assis',
					    'numero' => '797',
					    'bairro' => 'Centro',
					    'cep' => '06018030',
					    'complemento' => 'Salas 901/903/905'
				    ]
			    ],
			    [
				    'nome' => "Mauá - SP",
				    "cnpj" => '11960585000299',
				    'endereco' => [
					    'logradouro' => 'Santos Dumond',
					    'numero' => '285',
					    'bairro' => 'Santa Bocaina',
					    'cep' => '09310130',
					    'complemento' => ''
				    ]
			    ],
			    [
				    'nome' => "São José dos Campos - SP",
				    "cnpj" => '11960585000450',
				    'endereco' => [
					    'logradouro' => 'Euclides Miragaia',
					    'numero' => '433',
					    'bairro' => 'Centro',
					    'cep' => '12245820',
					    'complemento' => 'Salas 103/104'
				    ]
			    ],
		    ]
	    ];
	    foreach ($contratadas as $contratada => $filiais){
		    if(DB::table("contratadas")->where("nome",$contratada)->count() == 0){
			    DB::table('contratadas')->insert(array(
				    'nome' => $contratada
			    ));
		    }
		    $contratada_id = DB::table("contratadas")->where("nome",$contratada)->pluck("id")->first();
		    foreach ($filiais as $filial){
			    if(DB::table("contratada_filial")->where([['nome',$filial['nome']],['cnpj',$filial['cnpj']]])->count() == 0){
				    DB::table('contratada_filial')->insert(array(
					    'nome' => $filial['nome'],
					    'cnpj' => $filial['cnpj'],
					    'contratada_id' => $contratada_id,
					    'endereco' => json_encode($filial['endereco'])
				    ));
			    }
		    }
	    }
    }
}
