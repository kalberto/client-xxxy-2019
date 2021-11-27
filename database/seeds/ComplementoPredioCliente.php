<?php

use App\Model\Fastpack\Relationship\PredioHasCliente;
use App\Model\Fastpack\Venda;
use Illuminate\Database\Seeder;

class ComplementoPredioCliente extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $vendas = Venda::whereNotNull('vendas.codigo')->get();
	    foreach ($vendas as $venda){
		    $predio_cliente = PredioHasCliente::where([['predio_id',$venda->predio_id],['cliente_documento',$venda->cliente_documento]])->first();
		    if(isset($predio_cliente))
		    	$venda->predio_cliente_complemento = $predio_cliente->complemento;
		    else
			    $venda->predio_cliente_complemento = '';
		    $venda->save();
	    }
    }
}
