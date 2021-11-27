<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalizacaoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('ceps', function (Blueprint $table) {
		    $table->increments('id');
		    $table->char('cep',8);
	    });

        Schema::create('ufs', function (Blueprint $table) {
            $table->char('uf',2);
            $table->primary('uf');
            $table->boolean('ativo')->default(false)->nullable();
        });
	    Schema::create('cidades', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('nome',200);
		    $table->string('slug',203);
		    $table->char('uf',2);
		    $table->string('abr',5)->nullable();
		    $table->string('centro_operacao',5)->nullable();
		    $table->foreign('uf')->references('uf')->on('ufs');
	    });
	    Schema::create('bairros', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('nome',200);
		    $table->integer('cidade_id')->unsigned();
		    $table->foreign('cidade_id')->references('id')->on('cidades');
	    });
	    Schema::table('gerentes',function (Blueprint $table){
		    $table->char('uf',2)->nullable();
		    $table->foreign('uf')->references('uf')->on('ufs');
	    });

	    Schema::create('enderecos',function (Blueprint $table){
		    $table->increments('id');
		    $table->integer('cep')->unsigned()->nullable();
		    $table->string('logradouro',255)->nullable();
		    $table->string('numero',10)->nullable();
		    $table->string('complemento',255)->nullable();
		    $table->integer('bairro')->unsigned()->nullable();
		    $table->foreign('bairro')->references('id')->on('bairros');
		    $table->integer('cidade_id')->unsigned()->nullable();
		    $table->foreign('cidade_id')->references('id')->on('cidades');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('enderecos');
	    Schema::table('gerentes', function (Blueprint $table) {
		    $table->dropColumn('uf');
	    });
	    Schema::dropIfExists('bairros');
	    Schema::dropIfExists('cidades');
        Schema::dropIfExists('ufs');
	    Schema::dropIfExists('ceps');
    }
}
