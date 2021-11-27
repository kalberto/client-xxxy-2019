<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeVendasTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('prospeccoes', function (Blueprint $table) {
		    $table->softDeletes();
	    });
	    Schema::table('vendas', function (Blueprint $table) {
		    $table->softDeletes();
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
		    $table->dropSoftDeletes();
	    });
	    Schema::table('prospeccoes', function (Blueprint $table) {
		    $table->dropSoftDeletes();
	    });
    }
}
