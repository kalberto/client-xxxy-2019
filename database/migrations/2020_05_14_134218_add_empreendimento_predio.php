<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmpreendimentoPredio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('predios', function (Blueprint $table) {
		    $table->boolean('is_empreendimento')->default(false)->nullable();
		    $table->string('cliente_documento',14)->nullable();
		    $table->foreign('cliente_documento')->references('documento')->on('clientes');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('predios', function (Blueprint $table) {
		    if (Schema::hasColumn('predios', 'cliente_documento')) {
			    $table->dropForeign(['cliente_documento']);
			    $table->dropColumn('cliente_documento');
		    }
		    $table->dropColumn('is_empreendimento');
	    });
    }
}
