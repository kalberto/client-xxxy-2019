<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
	        $table->string('documento',14)->unique();
	        $table->primary('documento');
	        $table->string('nome',255);
	        $table->json('contato')->nullable();
	        $table->string('inscricao_estadual',45)->nullable();
	        $table->timestamp('data_verificacao')->nullable();
	        $table->char('status',1)->nullable()->default('N');//A(Aprovado),R(Reprovado),N(Não verificado),E(Expirado)

	        $table->integer('endereco')->unsigned()->nullable();
	        $table->foreign('endereco')->references('id')->on('enderecos');

            $table->timestamps();
        });

	    Schema::create('predios_has_clientes',function (Blueprint $table){
		    $table->integer('predio_id')->unsigned();
		    $table->foreign('predio_id')->references('id')->on('predios');
		    $table->string('cliente_documento',14);
		    $table->foreign('cliente_documento')->references('documento')->on('clientes');
		    $table->string('complemento',255)->nullable();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
