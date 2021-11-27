<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPredioComplementoOnVendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('vendas', function (Blueprint $table) {
		    $table->string('predio_cliente_complemento',255)->nullable()->after('service_id');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('vendas', function (Blueprint $table) {
		    $table->dropColumn('predio_cliente_complemento');
	    });
    }
}
