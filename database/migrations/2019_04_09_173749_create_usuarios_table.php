<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('usuarios', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('usuario', 45)->unique();
		    $table->string('email', 190)->nullable();
		    $table->string('name', 100)->nullable();
		    $table->rememberToken();
		    $table->timestamp('ultimo_acesso')->nullable();
	    });
	    Schema::table('usuarios',function (Blueprint $table){
		    $table->integer('manager_id')->nullable()->unsigned();
		    $table->foreign('manager_id')->references('id')->on('usuarios');
        });
	    Schema::create('gerentes',function (Blueprint $table){
		    $table->increments('id');
		    $table->integer('usuario_id')->unsigned();
		    $table->foreign('usuario_id')->references('id')->on('usuarios');
	    });
    	Schema::create('consultores',function (Blueprint $table){
		    $table->increments('id');
		    $table->integer('usuario_id')->unsigned();
		    $table->foreign('usuario_id')->references('id')->on('usuarios');
	    });
	    Schema::create('usuario_has_funcao',function(Blueprint $table){
		    $table->integer('usuario_id')->unsigned();
		    $table->foreign('usuario_id')->references('id')->on('usuarios');
		    $table->integer('perfil_id')->unsigned();
		    $table->foreign('perfil_id')->references('id')->on('perfis');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('usuario_has_funcao');
	    Schema::dropIfExists('consultores');
	    Schema::dropIfExists('gerentes');
	    Schema::table('usuarios',function (Blueprint $table){
		    $table->dropForeign(['manager_id']);
	    });
        Schema::dropIfExists('usuarios');
    }
}
