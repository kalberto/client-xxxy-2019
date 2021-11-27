<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditorias', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('codigo',26);
	        $table->foreign('codigo')->references('codigo')->on('vendas');
	        $table->integer('usuario_id')->unsigned()->nullable();
	        $table->foreign('usuario_id')->references('id')->on('usuarios');
	        $table->text('observacoes')->nullable();

	        /**
	         * E para Em auditoria
	         * R para Recusada
	         * A para Aprovada
	         *
	         */
	        $table->char('status',1);

	        /**
	         * V para Validação
	         * W para Welcome call
	         * A para Auditoria de dados
	         */
	        $table->char('tipo',1);

            $table->timestamps();
            $table->timestamp('closed')->nullable();
        });
        Schema::table('auditorias',function (Blueprint $table){
	        $table->integer('auditoria_anterior')->unsigned()->nullable();
	        $table->foreign('auditoria_anterior')->references('id')->on('auditorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auditorias');
    }
}
