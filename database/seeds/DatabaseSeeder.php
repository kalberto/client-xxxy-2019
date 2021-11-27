<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(PerfisTableSeeder::class);
        //$this->call(PermissoesTableSeeder::class);
	    $this->call(ModuloTableSeeder::class);
	    $this->call(ModPermissaoTableSeeder::class);
		//$this->call(ConfiguracaoTableSeeder::class);
		//$this->call(LocalizacaoTableSeeder::class);
	    //$this->call(ProdutosTableSeeder::class);
	    //$this->call(MotivosVendaPerdida::class);
	    //$this->call(VendasTablesSeeder::class);
	    //$this->call(ComplementoPredioCliente::class);
	    //$this->call(FixVendasValorSeeder::class);
	    $this->call(ChangeRelationPredioTableSeeder::class);
    }
}
