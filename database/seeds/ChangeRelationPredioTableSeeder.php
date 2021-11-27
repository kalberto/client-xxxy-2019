<?php

use Illuminate\Database\Seeder;

class ChangeRelationPredioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $predios = \Illuminate\Support\Facades\DB::table("predios")->where('consultor_id','!=',null)->get();
        foreach ($predios as $predio){
        	if(!(\Illuminate\Support\Facades\DB::table('consultores_has_predios')->where([['consultor_id','=',$predio->consultor_id],['predio_id','=',$predio->id]])->count())){
        		\Illuminate\Support\Facades\DB::table('consultores_has_predios')->insert(['consultor_id' => $predio->consultor_id, 'predio_id' => $predio->id]);
	        }
        }
    }
}
