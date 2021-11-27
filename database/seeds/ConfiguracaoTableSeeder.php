<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfiguracaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$conf = \App\Model\Configuracao::first();
    	if(isset($conf)){
    		$conf->nome_app = "XXXX - xxx APP";
		    $conf->texto_legal = "";
    		$conf->save();
	    }else{
		    DB::table('configuracoes')->insert([
			    'nome_app'=>'XXXX - xxx APP',
			    'texto_legal' => ''
		    ]);
	    }
    }
}
