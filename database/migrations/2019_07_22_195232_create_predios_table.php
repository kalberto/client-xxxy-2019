<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrediosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predios', function (Blueprint $table) {
	        $table->increments('id');
	        $table->string('nome',100);
	        $table->string('logradouro',255)->nullable();
	        $table->string('numero',10)->nullable();
	        $table->string('complemento',255)->nullable();
	        $table->integer('consultor_id')->unsigned()->nullable();
	        $table->integer('cep')->unsigned()->nullable();
	        $table->integer('cidade_id')->unsigned()->nullable();
	        $table->integer('bairro')->unsigned()->nullable();
	        $table->string('regional',45)->nullable();
	        $table->json('contato')->nullable();
	        $table->boolean('abordado')->nullable()->default(false);
	        $table->boolean('ativo')->nullable()->default(false);
            $table->timestamps();

	        $table->foreign('consultor_id')->references('id')->on('consultores');
	        $table->foreign('cep')->references('id')->on('ceps');
	        $table->foreign('cidade_id')->references('id')->on('cidades');
	        $table->foreign('bairro')->references('id')->on('bairros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('predios');
    }
}
