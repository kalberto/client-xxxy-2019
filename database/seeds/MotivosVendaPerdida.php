<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotivosVendaPerdida extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $motivos = [
		    "Preço",
		    "Produto não atende a necessidade",
		    "Desconfiança da marca xxxx",
		    "Prazo de Instalação",
		    "Possui fidelização com Concorrente",
		    "Solução melhor do Concorrente",
		    "Outros",
	    ];
	    foreach ($motivos as $motivo){
		    if(DB::table("motivos_venda_perdida")->where("motivo",$motivo)->count() == 0){
			    DB::table('motivos_venda_perdida')->insert(array(
				    'motivo' => $motivo
			    ));
		    }
	    }
    }
}
