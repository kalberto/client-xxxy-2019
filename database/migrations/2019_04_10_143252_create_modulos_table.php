<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_acoes_usuario',function (Blueprint $table){
		    $table->increments('id');
		    $table->integer('usuario_id')->unsigned()->nullable();
		    $table->foreign('usuario_id')->references('id')->on('usuarios');
		    $table->ipAddress('ip')->nullable();
		    $table->string('tipo',40)->nullable();
		    $table->string('tabela',50)->nullable();
		    $table->string('registro_id')->nullable();
		    $table->timestamps();
        });
        Schema::create('log_acessos_usuario',function (Blueprint $table){
		    $table->increments('id');
	        $table->integer('usuario_id')->unsigned()->nullable();
	        $table->foreign('usuario_id')->references('id')->on('usuarios');
		    $table->timestamp('data')->nullable();
		    $table->ipAddress('ip')->nullable();
        });
        Schema::create('permissoes',function (Blueprint $table){
	    	$table->increments('id');
	    	$table->string('nome',100);
		    $table->softDeletes();
        });
        Schema::table('permissoes',function (Blueprint $table){
		    $table->integer('required_id')->unsigned()->nullable();
		    $table->foreign('required_id')->references('id')->on('permissoes');
        });
        Schema::create('modulos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',255);
		    $table->string('url',45);
	        $table->integer('order')->nullable();
		    $table->boolean('obrigatorio')->default(false);
			$table->boolean('menu')->default(true);
        });
	    Schema::create('mod_permissao',function (Blueprint $table){
	    	$table->increments('id');
		    $table->integer('mod_id')->unsigned();
		    $table->foreign('mod_id')->references('id')->on('modulos');
		    $table->integer('permissao_id')->unsigned();
		    $table->foreign('permissao_id')->references('id')->on('permissoes');
	    });
	    Schema::create('perfil_mod_permissao',function (Blueprint $table){
		    $table->integer('perfil_id')->unsigned();
		    $table->foreign('perfil_id')->references('id')->on('perfis');
		    $table->integer('mod_perm_id')->unsigned();
		    $table->foreign('mod_perm_id')->references('id')->on('mod_permissao');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfil_mod_permissao');
        Schema::dropIfExists('mod_permissao');
	    Schema::dropIfExists('modulos');
	    Schema::table('permissoes', function (Blueprint $table) {
		    $table->dropForeign(['required_id']);
		    $table->dropColumn('required_id');
	    });
	    Schema::dropIfExists('permissoes');
	    Schema::dropIfExists('log_acessos_usuario');
	    Schema::dropIfExists('log_acoes_usuario');
    }
}
