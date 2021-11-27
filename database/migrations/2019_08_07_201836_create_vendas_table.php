<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('contratadas',function (Blueprint $table){
		    $table->increments('id');
		    $table->string('nome',100);
	    });

	    Schema::create('contratada_filial',function (Blueprint $table){
		    $table->increments('id');
		    $table->string('cnpj',14);
		    $table->string('nome',50);
		    $table->json('endereco');
		    $table->integer('contratada_id')->unsigned()->nullable();
		    $table->foreign('contratada_id')->references('id')->on('contratadas');
	    });

	    Schema::create('vendas', function (Blueprint $table) {
	        $table->string('codigo',26);
		    $table->primary('codigo');
	        $table->foreign('codigo')->references('codigo')->on('prospeccoes');
		    $table->string('campanha',190)->nullable();

		    $table->integer('contratada_filial_id')->unsigned()->nullable();
		    $table->foreign('contratada_filial_id')->references('id')->on('contratada_filial');

	        $table->json('contato_comercial')->nullable();
	        $table->integer('predio_id')->unsigned()->nullable();
	        $table->foreign('predio_id')->references('id')->on('predios');

	        $table->integer('endereco_predio')->unsigned()->nullable();
	        $table->foreign('endereco_predio')->references('id')->on('enderecos');
	        $table->integer('endereco_correspondencia')->unsigned()->nullable();
	        $table->foreign('endereco_correspondencia')->references('id')->on('enderecos');

		    $table->integer('usuario_id')->unsigned()->nullable();
		    $table->foreign('usuario_id')->references('id')->on('usuarios');
		    $table->text('observacoes')->nullable();

		    $table->char('vencimento',2)->nullable();
		    $table->string('email_fatura',190)->nullable();

		    /**
		     * F para Finalizada
		     * A para A corrigir
		     * E para Em configuração
		     * C para Cancelada
		     * V para Validação
		     * U para aUditoria
		     */
		    $table->char('status',1);
		    $table->char("service_id",16)->nullable();

            $table->timestamps();
        });

	    Schema::create('vendas_has_produto',function (Blueprint $table){
		    $table->string('codigo_venda',26);
		    $table->foreign('codigo_venda')->references('codigo')->on('vendas');
		    $table->integer('tipo_id')->unsigned();
		    $table->foreign('tipo_id')->references('id')->on('tipos');
		    $table->integer('produto_id')->unsigned();
		    $table->foreign('produto_id')->references('id')->on('produtos');
		    $table->json('config')->nullable();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('vendas_has_produto');
        Schema::dropIfExists('vendas');
	    Schema::dropIfExists('contratada_filial');
	    Schema::dropIfExists('contratadas');
    }
}
