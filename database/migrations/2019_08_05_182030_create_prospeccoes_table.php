<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProspeccoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospeccoes', function (Blueprint $table) {
	        $table->string('codigo',26)->unique();
	        $table->primary('codigo');
	        $table->string('cliente_documento',14);
	        $table->foreign('cliente_documento')->references('documento')->on('clientes');
	        $table->timestamp('data_contato')->nullable();
	        $table->text('observacoes')->nullable();
            $table->timestamps();

	        /**
	         * C para Contato
	         * N para Negociação
	         * V para Venda concluída
	         * P para venda Perdida
	         */
	        $table->char('status',1);

	        /**
	         * P para Prospecção
	         * A para Análise
	         * F para Fechamento até 60 dias
	         * C para Fechamento mês corrente
	         */
	        $table->char('status_negociacao',1)->nullable();

	        $table->integer('predio_id')->unsigned()->nullable();
	        $table->foreign('predio_id')->references('id')->on('predios');

	        $table->integer('usuario_id')->unsigned()->nullable();
	        $table->foreign('usuario_id')->references('id')->on('usuarios');
        });

	    Schema::create('prospeccao_has_produto',function (Blueprint $table){
		    $table->string('codigo_prospec',26);
		    $table->foreign('codigo_prospec')->references('codigo')->on('prospeccoes');
		    $table->integer('tipo_id')->unsigned();
		    $table->foreign('tipo_id')->references('id')->on('tipos');
		    $table->integer('produto_id')->unsigned();
		    $table->foreign('produto_id')->references('id')->on('produtos');
		    $table->json('config')->nullable();
	    });

	    Schema::create('prospeccao_change_status',function (Blueprint $table){
		    $table->increments('id');
		    $table->string('codigo_prospec',26);
		    $table->foreign('codigo_prospec')->references('codigo')->on('prospeccoes');
		    $table->timestamp('data_mudanca');
		    $table->integer('usuario_id')->unsigned()->nullable();
		    $table->foreign('usuario_id')->references('id')->on('usuarios');
		    $table->char('change_from',1);
	    });

	    Schema::create('motivos_venda_perdida',function (Blueprint $table){
		    $table->increments('id');
		    $table->string('motivo',60);
	    });

	    Schema::create('prospeccao_venda_perdida',function (Blueprint $table){
		    $table->string('codigo_prospec',26);
		    $table->foreign('codigo_prospec')->references('codigo')->on('prospeccoes');
		    $table->integer('motivo_id')->unsigned()->nullable();
		    $table->foreign('motivo_id')->references('id')->on('motivos_venda_perdida');
		    $table->text('comentario')->nullable();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('prospeccao_venda_perdida');
	    Schema::dropIfExists('motivos_venda_perdida');
        Schema::dropIfExists('prospeccao_change_status');
        Schema::dropIfExists('prospeccao_has_produto');
        Schema::dropIfExists('prospeccoes');
    }
}
