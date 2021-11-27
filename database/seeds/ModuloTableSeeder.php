<?php

use Illuminate\Database\Seeder;
use App\Model\Modulo;

class ModuloTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$modulos = [
			["nome"=>"Dashboard","url"=>"/","obrigatorio"=>true,"order"=>0],
			["nome"=>"Prédios","url"=>"/predios","obrigatorio"=>false,"order"=>1],
			["nome"=>"Clientes","url"=>"/clientes","obrigatorio"=>false,"order"=>2],
			["nome"=>"Produtos","url"=>"/produtos","obrigatorio"=>false,"order"=>3],
			["nome"=>"Prospecções","url"=>"/prospeccoes","obrigatorio"=>false,"order"=>4],
			["nome"=>"Vendas","url"=>"/vendas","obrigatorio"=>false,"order"=>5],
			["nome"=>"Auditorias","url"=>"/auditorias","obrigatorio"=>false,"order"=>6],
			["nome"=>"Empreendimentos Comerciais","url"=>"/empreendimentos","obrigatorio"=>false,"order"=>7],
		];
		foreach ($modulos as $modulo){
			Modulo::updateOrCreate(
				array(
					'nome' => $modulo['nome']
				),
				array(
					//'icone' => $modulo['icone'],
					'url' => $modulo['url'],
					'obrigatorio' => $modulo['obrigatorio'],
					'order' => $modulo['order']
				)
			);
		}
    }
}
