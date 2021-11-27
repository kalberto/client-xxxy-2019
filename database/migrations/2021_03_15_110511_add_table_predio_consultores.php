<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTablePredioConsultores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('consultores_has_predios',function (Blueprint $table){
		    $table->integer('consultor_id')->unsigned()->nullable();
		    $table->foreign('consultor_id')->references('id')->on('consultores');
		    $table->integer('predio_id')->unsigned();
		    $table->foreign('predio_id')->references('id')->on('predios');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultores_has_predios');
    }
}
