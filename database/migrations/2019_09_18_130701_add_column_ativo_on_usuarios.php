<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAtivoOnUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    if (!Schema::hasColumn('usuarios', 'ativo')) {
		    Schema::table('usuarios',function (Blueprint $table){
			    $table->boolean('ativo',true)->nullable();
		    });
	    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    if (Schema::hasColumn('usuarios', 'ativo')) {
		    Schema::table('usuarios',function (Blueprint $table){
		    	$table->dropColumn('ativo');
		    });
	    }

    }
}
