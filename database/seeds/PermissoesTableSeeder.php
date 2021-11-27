<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $permissoes = [
		    ["nome"=>"Visualização","required_id" => null],
		    ["nome"=>"Criação","required_id" => 1],
		    ["nome"=>"Edição","required_id" => 1],
		    ["nome"=>"Upload","required_id" => 1]
	    ];
	    foreach ($permissoes as $permissao){
		    if(DB::table("permissoes")->where("nome",$permissao['nome'])->count() == 0){
			    DB::table('permissoes')->insert(array(
				    "nome" => $permissao['nome'],
				    "required_id" => $permissao['required_id']
			    ));
		    }
	    }
    }
}
