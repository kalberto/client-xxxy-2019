<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$tipos = [
    		"Pacotes" => [["nome"=>"Pacote FastPack 50","extra"=>"Internet 50Mbps"],["nome"=>"Pacote FastPack 100","extra"=>"Internet 100Mbps"],["nome"=>"Pacote FastPack 150","extra"=>"Internet 150Mbps"]],
		    "CloudBackup" => [["nome"=>"50 GB"], ["nome"=>"100 GB"],["nome"=>"200 GB"]],
		    "0800" => [["nome"=>"0800"]],
		    "SmartBox" => [["nome"=>"SmartBox"]]
	    ];
    	foreach ($tipos as $key => $produtos){
    		if(DB::table("tipos")->where("nome",$key)->count() == 0){
			    DB::table('tipos')->insert(array(
				    'nome' => $key,
				    'slug' => \Illuminate\Support\Str::slug($key)
			    ));
		    }
		    $tipo_id =DB::table("tipos")->where("nome",$key)->pluck("id")->first();
    		foreach ($produtos as $produto){
    			if(DB::table("produtos")->where([["nome",$produto["nome"]],['tipo_id',$tipo_id]])->count() == 0){
    				DB::table("produtos")->insert(array(
    					"nome" => $produto["nome"],
					    "extra" => isset($produto["extra"]) ? $produto["extra"] : '',
					    "tipo_id" => $tipo_id,
					    "ativo" => 1
				    ));
			    }else{
    				$produto_db = \App\Model\Fastpack\Produto::where([["nome",$produto["nome"]],['tipo_id',$tipo_id]])->first();
				    $produto_db->extra = isset($produto["extra"]) ? $produto["extra"] : '';
				    $produto_db->save();
			    }
		    }
	    }
    }
}
