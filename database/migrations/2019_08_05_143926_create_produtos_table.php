<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('tipos', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('nome',45);
		    $table->string('slug',45);
	    });
        Schema::create('produtos', function (Blueprint $table) {
	        $table->increments('id');
	        $table->string('nome',45);
	        $table->integer('tipo_id')->unsigned();
	        $table->foreign('tipo_id')->references('id')->on('tipos');
	        $table->boolean('ativo')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
	    Schema::dropIfExists('tipos');
    }
}
