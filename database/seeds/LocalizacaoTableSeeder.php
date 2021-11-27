<?php

use Illuminate\Database\Seeder;

class LocalizacaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $ufs = ['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'];

	    foreach ($ufs as $uf){
	    	\App\Model\Uf::criar(['uf'=>$uf,'ativo'=>false],false);
	    }
    }
}
