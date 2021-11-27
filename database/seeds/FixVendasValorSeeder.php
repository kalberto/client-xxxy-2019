<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FixVendasValorSeeder extends Seeder
{
	private function fixValorVar(&$produto,$var){
		if(isset($produto->$var)){
			$dot_pos = strpos($produto->$var,'.');
			if($dot_pos === false){
				$produto->$var = $produto->$var.'.00';
			}else{
				if((strlen($produto->$var) - $dot_pos) == 2)
					$produto->$var = $produto->$var.'0';
				elseif((strlen($produto->$var) - $dot_pos) == 1)
					$produto->$var = $produto->$var.'00';
			}
		}else
			$produto->$var = '0.00';
	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $codigos_vendas = \Illuminate\Support\Facades\DB::table('vendas')->whereNotNull('codigo')->pluck('codigo');
	    foreach ($codigos_vendas as $codigo_venda){
		    $produtos = \App\Model\Fastpack\Relationship\VendaHasProduto::where("codigo_venda",$codigo_venda)->get();
		    foreach ($produtos as $produto){
			    $config = $produto->config;
			    $tipo = DB::table("tipos")->where("slug","=","pacotes")->limit(1)->first();
			    if($produto->tipo_id == $tipo->id){
				    foreach ($config as $item){
					    $this->fixValorVar($item,'valor');
					    if(!isset($item->is_percent) || !$item->is_percent){
						    $this->fixValorVar($item,'desconto');
					    }
				    }
			    }else{
				    $this->fixValorVar($config,'valor');
				    if(!isset($config->is_percent) || !$config->is_percent){
					    $this->fixValorVar($config,'desconto');
				    }
			    }
			    $produto->config = $config;
			    $produto->save();
		    }
	    }
    }
}
