<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevelopmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert(array(
        	'usuario' => 'rafael.pianaro',
	        'name' => 'Rafael Pianaro',
	        'email' => 'rafael.pianaro@etools.com.br'
        ));
        DB::table('usuario_has_funcao')->insert(array(
        	'usuario_id' => 1,
	        'perfil_id' => 2
        ));
	    DB::table('usuarios')->insert(array(
		    'usuario' => 'alberto.guilherme',
		    'name' => 'Alberto Guilherme',
		    'email' => 'alberto.guilherme@etools.com.br'
	    ));
	    DB::table('usuario_has_funcao')->insert(array(
		    'usuario_id' => 2,
		    'perfil_id' => 3
	    ));
	    DB::table('usuarios')->insert(array(
		    'usuario' => 'administrador',
		    'name' => 'Administrador',
		    'email' => 'administrador@etools.com.br'
	    ));
	    DB::table('usuario_has_funcao')->insert(array(
		    'usuario_id' => 3,
		    'perfil_id' => 1
	    ));
	    DB::table('gerentes')->insert(array(
	    	'usuario_id' => 2,
		    'uf' => 'PR'
	    ));
	    DB::table('consultores')->insert(array(
		    'usuario_id' => 1,
		    'gerente' => 1
	    ));
    }
}
