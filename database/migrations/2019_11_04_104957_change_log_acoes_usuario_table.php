<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLogAcoesUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::table('log_acoes_usuario', function (Blueprint $table) {
			$table->json('alteracoes')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('log_acoes_usuario', function (Blueprint $table) {
			$table->dropColumn('alteracoes');
		});
	}
}
